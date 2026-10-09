<?php

namespace App\Http\Controllers;

use App\Models\Logement;
use App\Models\Paiement;
use App\Models\User;
use App\Services\PayGateService;
use App\Support\OffreAgence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PaiementController extends Controller
{
    public function demarrerPaygate(
        Request $request,
        Paiement $paiement,
        PayGateService $payGate
    ) {
        abort_if($paiement->user_id !== auth()->id(), 403);
        abort_if($paiement->statut !== 'en_attente', 404);

        $data = $request->validate([
            'network' => ['nullable', 'in:flooz,tmoney'],
            'phone' => ['required', 'regex:/^(\+228)?[0-9]{8}$/'],
        ]);

        $phone = str_replace(' ', '', $data['phone']);
        $detectedNetwork = $payGate->networkForPhone($phone);
        $network = $detectedNetwork ?: ($data['network'] ?? null);

        if (! $network || ($detectedNetwork && $data['network'] && $data['network'] !== $detectedNetwork)) {
            $message = $detectedNetwork && $data['network']
                ? ($data['network'] === 'flooz'
                    ? 'Ce numéro ne correspond pas à un numéro Flooz.'
                    : 'Ce numéro ne correspond pas à un numéro Mixx/T-Money.')
                : 'Le réseau de ce numéro n’a pas pu être détecté automatiquement.';

            return back()
                ->withErrors([
                    'phone' => $message,
                ])
                ->withInput();
        }

        abort_if(
            ! $payGate->isConfigured(),
            503,
            'Le paiement PayGate est temporairement indisponible. Configurez PAYGATE_API_TOKEN.'
        );

        $montantActuel = $this->montantActuelPourPaiement($paiement);

        if ((int) $paiement->montant !== $montantActuel) {
            $paiement->update(['montant' => $montantActuel]);
            $paiement->refresh();
        }

        $paygateData = $paiement->paygate_data ?? [];

        // PayGate refuse qu'un identifier soit réutilisé après une tentative.
        // Le paiement ChezMoi reste unique, mais chaque nouvelle tentative
        // reçoit automatiquement son propre identifier PayGate.
        if (! $paiement->identifier || data_get($paygateData, 'paygate_attempted') || data_get($paygateData, 'paygate_in_progress')) {
            $previousIdentifier = $paiement->identifier;
            $paiement->identifier = 'CM-'.$paiement->id.'-'.strtoupper(Str::random(10));
            $paiement->payment_reference = $previousIdentifier;
        }

        $paygateData['paygate_attempted'] = true;
        $paygateData['paygate_in_progress'] = true;
        $paygateData['paygate_attempted_at'] = now()->toIso8601String();

        if (! $paiement->identifier) {
            $paiement->update([
                'identifier' => 'CM-'.$paiement->id.'-'.strtoupper(Str::random(10)),
            ]);
        }

        $paiement->update([
            'identifier' => $paiement->identifier,
            'payment_reference' => $paiement->payment_reference,
            'phone_number' => $phone,
            'network' => $network,
            'paygate_data' => $paygateData,
        ]);

        // La page PayGate est atteinte via une URL contenant le token API en
        // paramètre de requête (limitation de leur intégration). On évite au
        // minimum que cette URL soit mise en cache par un proxy ou le navigateur,
        // pour limiter sa persistance en dehors de cette redirection ponctuelle.
        return redirect()->away($payGate->paymentUrl(
            (int) $paiement->montant,
            $paiement->identifier,
            'Paiement ChezMoi - '.$paiement->reference,
            $network,
            $phone
        ))->withHeaders([
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma' => 'no-cache',
        ]);
    }

    public function paygateReturn(Request $request, PayGateService $payGate)
    {
        $identifier = $request->string('identifier')->toString();
        $paiement = Paiement::where('identifier', $identifier)->firstOrFail();

        abort_if($paiement->user_id !== auth()->id(), 403);

        if ($paiement->statut !== 'paye') {
            $this->verifierEtActiverPaygate($paiement, $payGate);
        }

        $paiement = $paiement->fresh();

        if ($paiement->statut !== 'paye') {
            $paygateData = $paiement->paygate_data ?? [];
            $paygateData['paygate_in_progress'] = false;
            $paygateData['paygate_returned_at'] = now()->toIso8601String();
            $paiement->update(['paygate_data' => $paygateData]);

            return redirect($this->routeRetourPaiement($paiement))->with(
                'error',
                'Le paiement n’a pas été confirmé (annulation ou solde insuffisant). Vous pouvez réessayer.'
            );
        }

        return redirect()->route('bailleur.paiements.index')->with(
            $paiement->fresh()->statut === 'paye' ? 'success' : 'error',
            $paiement->fresh()->statut === 'paye'
                ? 'Paiement confirmé.'
                : 'Le paiement n’a pas encore été confirmé par PayGate.'
        );
    }

    private function routeRetourPaiement(Paiement $paiement): string
    {
        if ($paiement->type === 'visibilite') {
            return route('paiement.visibilite', ['paiement' => $paiement->id]);
        }

        if ($paiement->type === 'annonce_supplementaire') {
            return route('paiement.annonce.supplementaire');
        }

        if (str_starts_with($paiement->type, 'offre_agence_')) {
            return route('paiement.offre.agence', [
                'offre' => str_replace('offre_agence_', '', $paiement->type),
            ]);
        }

        return route('bailleur.paiements.index');
    }

    private function montantActuelPourPaiement(Paiement $paiement): int
    {
        if ($paiement->type === 'annonce_supplementaire') {
            return 2500;
        }

        if ($paiement->type === 'visibilite') {
            $niveau = (int) data_get($paiement->paygate_data, 'niveau', 1);

            return $niveau === 2 ? 5000 : 2500;
        }

        if (str_starts_with($paiement->type, 'offre_agence_')) {
            return match (str_replace('offre_agence_', '', $paiement->type)) {
                'pro' => 50000,
                'premium' => 200000,
                'illimite' => 500000,
                default => (int) $paiement->montant,
            };
        }

        return (int) $paiement->montant;
    }

    private function libererTentativePaygateEnCours(Paiement $paiement): void
    {
        $paygateData = $paiement->paygate_data ?? [];

        if (! data_get($paygateData, 'paygate_in_progress')) {
            return;
        }

        $paygateData['paygate_in_progress'] = false;
        $paygateData['paygate_cancelled_at'] = now()->toIso8601String();
        $paygateData['paygate_cancelled_automatically'] = true;

        $paiement->update(['paygate_data' => $paygateData]);
    }

    public function paygateCallback(Request $request, PayGateService $payGate)
    {
        $identifier = $request->string('identifier')->trim()->toString();

        if ($identifier === '') {
            return response()->json(['message' => 'Identifiant manquant'], 422);
        }

        $paiement = Paiement::where('identifier', $identifier)->first();

        if (! $paiement) {
            return response()->json(['message' => 'Paiement introuvable'], 404);
        }

        $this->verifierEtActiverPaygate($paiement, $payGate);

        return response()->json(['received' => true]);
    }

    public function annulerTentativePaygate(Paiement $paiement)
    {
        abort_if($paiement->user_id !== auth()->id(), 403);
        abort_if($paiement->statut !== 'en_attente', 404);

        $this->libererTentativePaygateEnCours($paiement);

        return redirect($this->routeRetourPaiement($paiement))->with(
            'info',
            'La tentative en cours a été annulée. Vous pouvez effectuer une nouvelle tentative.'
        );
    }

    private function verifierEtActiverPaygate(
        Paiement $paiement,
        PayGateService $payGate
    ): void {
        if ($paiement->fresh()->statut === 'paye') {
            return;
        }

        $response = $payGate->statusByIdentifier($paiement->identifier);

        if (! $payGate->isSuccessful($response)
            || ! $payGate->responseMatchesPayment(
                $response,
                (int) $paiement->montant,
                $paiement->identifier
            )) {
            return;
        }

        DB::transaction(function () use ($paiement, $payGate, $response) {
            $paiement = Paiement::lockForUpdate()->findOrFail($paiement->id);

            if ($paiement->statut === 'paye') {
                return;
            }

            $paiement->update([
                'statut' => 'paye',
                'methode' => 'paygate',
                'tx_reference' => $payGate->transactionReference($response),
                'paye_le' => now(),
            ]);

            $this->activerPaiement($paiement->fresh());
        });
    }

    private function activerPaiement(Paiement $paiement): void
    {
        if ($paiement->type === 'annonce_supplementaire') {
            User::whereKey($paiement->user_id)->increment('annonces_credits');
        }

        if (str_starts_with($paiement->type, 'offre_agence_')) {
            $offre = str_replace('offre_agence_', '', $paiement->type);
            $user = User::lockForUpdate()->findOrFail($paiement->user_id);
            $creditsAchetes = ['pro' => 20, 'premium' => 100, 'illimite' => 0][$offre];

            $user->update([
                'offre' => $offre,
                'abonnement_debut' => now(),
                'abonnement_fin' => now()->addDays(30),
                'annonces_credits' => (int) $user->annonces_credits + $creditsAchetes,
                'agency_credits_initialized' => true,
            ]);
        }

        if ($paiement->type === 'visibilite' && $paiement->logement) {
            $niveau = (int) data_get($paiement->paygate_data, 'niveau', 1);
            $duree = (int) data_get(
                $paiement->paygate_data,
                'duree',
                $niveau === 2 ? 15 : 7
            );

            $paiement->logement->update([
                'niveau_visibilite' => $niveau,
                'date_debut_visibilite' => now(),
                'date_fin_visibilite' => now()->addDays($duree),
            ]);
        }
    }

    /**
     * Afficher les options de visibilité d'un logement.
     */
    public function index(Logement $logement)
    {
        abort_if(
            $logement->user_id !== auth()->id(),
            403
        );

        return view(
            'bailleur.visibilite.index',
            compact('logement')
        );
    }

    /**
     * Créer un paiement de visibilité.
     */
    public function acheter(
        Request $request,
        Logement $logement
    ) {
        abort_if(
            $logement->user_id !== auth()->id(),
            403
        );

        $validated = $request->validate([
            'niveau' => [
                'required',
                'in:1,2',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Déterminer l'offre
        |--------------------------------------------------------------------------
        */

        if ((int) $validated['niveau'] === 1) {

            $montant = 2500;
            $duree = 7;
            $nom = 'Mise en avant';

        } else {

            $montant = 5000;
            $duree = 15;
            $nom = 'Tête des résultats';

        }

        /*
        |--------------------------------------------------------------------------
        | Créer le paiement
        |--------------------------------------------------------------------------
        */

        // Pour une même option de visibilité, réutiliser le paiement encore
        // en attente et donc son identifier PayGate après un retour annulé.
        $paiement = Paiement::query()
            ->where('user_id', auth()->id())
            ->where('logement_id', $logement->id)
            ->where('type', 'visibilite')
            ->where('statut', 'en_attente')
            ->latest()
            ->get()
            ->first(fn (Paiement $payment) => (int) data_get($payment->paygate_data, 'niveau') === (int) $validated['niveau']);

        if (! $paiement) {
            $paiement = Paiement::create([

                'user_id' => auth()->id(),

                'logement_id' => $logement->id,

                'type' => 'visibilite',

                'montant' => $montant,

                'statut' => 'en_attente',

                'methode' => null,

                'reference' => 'VIS-'.strtoupper(
                    Str::random(12)
                ),

                'identifier' => 'CM-VIS-'.strtoupper(Str::random(12)),

                'paye_le' => null,

                'paygate_data' => [
                    'niveau' => (int) $validated['niveau'],
                    'duree' => $duree,
                ],

            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Conserver les informations nécessaires
        |--------------------------------------------------------------------------
        */

        session([
            'visibilite_niveau' => (int) $validated['niveau'],
            'visibilite_duree' => $duree,
            'visibilite_nom' => $nom,
        ]);

        return redirect()
            ->route(
                'paiement.visibilite',
                [
                    'paiement' => $paiement->id,
                ]
            )
            ->with(
                'info',
                "Votre paiement de {$montant} FCFA pour « {$nom} » a été créé."
            );
    }

    /**
     * Afficher le paiement de visibilité à confirmer.
     */
    public function visibilite()
    {
        $paiementId = request('paiement');

        abort_if(
            ! $paiementId,
            404
        );

        $paiement = Paiement::with('logement')
            ->where('id', $paiementId)
            ->where('user_id', auth()->id())
            ->where('type', 'visibilite')
            ->firstOrFail();

        $this->libererTentativePaygateEnCours($paiement);

        return view(
            'bailleur.paiements.visibilite',
            compact('paiement')
        );
    }

    /**
     * Confirmer le paiement de visibilité.
     *
     * Pour le moment cette méthode simule la confirmation
     * du paiement.
     */
    public function confirmerVisibilite(
        Request $request,
        Paiement $paiement
    ) {
        abort_unless(config('services.paygate.simulation'), 404);

        /*
        |--------------------------------------------------------------------------
        | Sécurité
        |--------------------------------------------------------------------------
        */

        abort_if(
            $paiement->user_id !== auth()->id(),
            403
        );

        /*
        |--------------------------------------------------------------------------
        | Vérifier le type du paiement
        |--------------------------------------------------------------------------
        */

        abort_if(
            $paiement->type !== 'visibilite',
            404
        );

        /*
        |--------------------------------------------------------------------------
        | Empêcher un double paiement
        |--------------------------------------------------------------------------
        */

        if ($paiement->statut === 'paye') {

            return redirect()
                ->route('bailleur.paiements.index')
                ->with(
                    'info',
                    'Ce paiement a déjà été confirmé.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Vérifier le logement
        |--------------------------------------------------------------------------
        */

        $logement = $paiement->logement;

        abort_if(
            ! $logement,
            404
        );

        /*
        |--------------------------------------------------------------------------
        | Récupérer le niveau choisi
        |--------------------------------------------------------------------------
        */

        $niveau = (int) data_get($paiement->paygate_data, 'niveau', 1);

        /*
        |--------------------------------------------------------------------------
        | Déterminer la durée
        |--------------------------------------------------------------------------
        */

        $duree = (int) data_get(
            $paiement->paygate_data,
            'duree',
            $niveau === 2 ? 15 : 7
        );

        /*
        |--------------------------------------------------------------------------
        | Confirmation du paiement + activation
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $paiement,
            $logement,
            $niveau,
            $duree
        ) {
            $paiement = Paiement::lockForUpdate()->findOrFail($paiement->id);

            if ($paiement->statut === 'paye') {
                return;
            }

            /*
            | Paiement
            */

            $paiement->update([

                'statut' => 'paye',

                'methode' => 'simulation',

                'paye_le' => now(),

            ]);

            /*
            | Visibilité du logement
            */

            $logement->update([

                'niveau_visibilite' => $niveau,

                'date_debut_visibilite' => now(),

                'date_fin_visibilite' => now()->addDays($duree),

            ]);

        });

        /*
        |--------------------------------------------------------------------------
        | Nettoyer la session
        |--------------------------------------------------------------------------
        */

        session()->forget([
            'visibilite_niveau',
            'visibilite_duree',
            'visibilite_nom',
        ]);

        return redirect()
            ->route(
                'bailleur.logements.show',
                $logement
            )
            ->with(
                'success',
                "Paiement confirmé. La visibilité de votre logement est maintenant active pour {$duree} jours."
            );
    }

    /**
     * Historique des paiements du bailleur.
     */
    public function historique()
    {
        $paiements = Paiement::with('logement')
            ->where('user_id', auth()->id())
            ->where('statut', 'paye')
            ->latest()
            ->paginate(10);

        return view(
            'bailleur.paiements.index',
            compact('paiements')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | ANNONCE SUPPLÉMENTAIRE
    |--------------------------------------------------------------------------
    */

    public function annonceSupplementaire()
    {
        $user = auth()->user();

        abort_if($user->account_type === 'agence', 403);

        $paiement = Paiement::where('user_id', $user->id)
            ->where('type', 'annonce_supplementaire')
            ->where('statut', 'en_attente')
            ->latest()
            ->first();

        if (! $paiement) {
            $paiement = Paiement::create([
                'user_id' => $user->id,
                'type' => 'annonce_supplementaire',
                'montant' => 2500,
                'statut' => 'en_attente',
                'reference' => 'ANN-'.strtoupper(Str::random(12)),
                'identifier' => 'CM-ANN-'.strtoupper(Str::random(12)),
            ]);
        } elseif ((int) $paiement->montant !== 2500) {
            $paiement->update([
                'montant' => 2500,
            ]);
        }

        $this->libererTentativePaygateEnCours($paiement);

        return view('bailleur.paiement', compact('paiement'));
    }

    public function confirmerAnnonceSupplementaire(
        Request $request,
        Paiement $paiement
    ) {
        abort_unless(config('services.paygate.simulation'), 404);

        abort_if($paiement->user_id !== auth()->id(), 403);
        abort_if($paiement->type !== 'annonce_supplementaire', 404);

        $retourCreation = session()->has('annonce_en_attente');
        $routeRetour = $retourCreation
            ? 'bailleur.logements.create'
            : 'bailleur.dashboard';

        if ($paiement->statut === 'paye') {
            return redirect()
                ->route($routeRetour)
                ->with('info', 'Ce paiement a déjà été confirmé.');
        }

        DB::transaction(function () use ($paiement) {
            $paiement = Paiement::lockForUpdate()->findOrFail($paiement->id);

            if ($paiement->statut === 'paye') {
                return;
            }

            $paiement->update([
                'statut' => 'paye',
                'methode' => 'simulation',
                'paye_le' => now(),
            ]);

            User::whereKey(auth()->id())->increment('annonces_credits');
        });

        return redirect()
            ->route($routeRetour)
            ->with(
                'success',
                $retourCreation
                    ? 'Paiement confirmé. Votre annonce est prête : vous pouvez maintenant terminer sa publication.'
                    : 'Paiement confirmé. Vous disposez maintenant d’un crédit pour publier une annonce supplémentaire.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | OFFRE AGENCE
    |--------------------------------------------------------------------------
    */

    public function offreAgence($offre)
    {
        $user = auth()->user();

        abort_unless($user->account_type === 'agence', 403);

        $offres = [
            'pro' => [
                'nom' => 'Agence Pro',
                'montant' => 50000,
                'annonces' => 20,
            ],
            'premium' => [
                'nom' => 'Agence Premium',
                'montant' => 200000,
                'annonces' => 100,
            ],
            'illimite' => [
                'nom' => 'Agence Illimitée',
                'montant' => 500000,
                'annonces' => null,
            ],
        ];

        abort_unless(array_key_exists($offre, $offres), 404);

        $type = 'offre_agence_'.$offre;

        $paiement = Paiement::where('user_id', $user->id)
            ->where('type', $type)
            ->where('statut', 'en_attente')
            ->latest()
            ->first();

        if (! $paiement) {
            $paiement = Paiement::create([
                'user_id' => $user->id,
                'type' => $type,
                'montant' => $offres[$offre]['montant'],
                'statut' => 'en_attente',
                'reference' => 'OFF-'.strtoupper($offre).'-'.strtoupper(Str::random(8)),
                'identifier' => 'CM-OFF-'.strtoupper(Str::random(12)),
            ]);
        }

        $this->libererTentativePaygateEnCours($paiement);

        $offreChoisie = $offres[$offre];

        return view(
            'bailleur.paiement-offre',
            compact('paiement', 'offreChoisie')
        );
    }

    public function confirmerOffreAgence(
        Request $request,
        Paiement $paiement
    ) {
        abort_unless(config('services.paygate.simulation'), 404);

        abort_if($paiement->user_id !== auth()->id(), 403);
        abort_unless(str_starts_with($paiement->type, 'offre_agence_'), 404);

        $offre = str_replace('offre_agence_', '', $paiement->type);

        abort_unless(
            in_array($offre, ['pro', 'premium', 'illimite'], true),
            404
        );

        if ($paiement->statut === 'paye') {
            return redirect()
                ->route('bailleur.dashboard')
                ->with('info', 'Cette offre est déjà active.');
        }

        DB::transaction(function () use ($paiement, $offre) {
            $paiement = Paiement::lockForUpdate()->findOrFail($paiement->id);

            if ($paiement->statut === 'paye') {
                return;
            }

            $user = User::lockForUpdate()->findOrFail(auth()->id());

            $paiement->update([
                'statut' => 'paye',
                'methode' => 'simulation',
                'paye_le' => now(),
            ]);

            $creditsExistants = (int) $user->annonces_credits;

            // Lors du premier achat, on transforme le solde restant de
            // l'ancienne offre en crédits avant d'ajouter le nouveau pack.
            if (! $user->agency_credits_initialized) {
                $limiteActuelle = OffreAgence::details($user)['limite'];
                $annoncesUtilisees = Logement::where('user_id', $user->id)->count();
                $creditsExistants = $limiteActuelle === null
                    ? 0
                    : max(0, $limiteActuelle - $annoncesUtilisees);
            }

            $creditsAchetes = [
                'pro' => 20,
                'premium' => 100,
                'illimite' => 0,
            ][$offre];

            $user->update([
                'offre' => $offre,
                'abonnement_debut' => now(),
                'abonnement_fin' => now()->addDays(30),
                'annonces_credits' => $creditsExistants + $creditsAchetes,
                'agency_credits_initialized' => true,
            ]);
        });

        return redirect()
            ->route('bailleur.dashboard')
            ->with(
                'success',
                'Paiement confirmé. Votre offre agence est active pendant 30 jours.'
            );
    }

    /**
     * Afficher les logements du bailleur avant l'achat d'une visibilité.
     */
    public function choisirLogement(int $niveau)
    {
        abort_unless(in_array($niveau, [1, 2], true), 404);

        return redirect()->route(
            'bailleur.logements.index',
            ['promotion' => $niveau]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | MISE EN AVANT
    |--------------------------------------------------------------------------
    */

    public function miseEnAvant(Logement $logement)
    {
        abort_if(
            $logement->user_id !== auth()->id(),
            403
        );

        $paiement = Paiement::firstOrCreate(
            [
                'user_id' => auth()->id(),
                'logement_id' => $logement->id,
                'type' => 'visibilite',
                'statut' => 'en_attente',
            ],
            [
                'montant' => 2500,
                'reference' => 'VIS-'.strtoupper(Str::random(12)),
                'identifier' => 'CM-VIS-'.strtoupper(Str::random(12)),
                'paygate_data' => ['niveau' => 1, 'duree' => 7],
            ]
        );

        return redirect()->route('paiement.visibilite', ['paiement' => $paiement->id]);
    }

    public function confirmerMiseEnAvant(
        Request $request,
        Logement $logement
    ) {
        abort_if(
            $logement->user_id !== auth()->id(),
            403
        );

        // Cette partie sera raccordée au système
        // de paiement réel ensuite.
    }
}
