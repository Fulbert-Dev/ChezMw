<?php

namespace App\Http\Controllers;

use App\Models\Logement;
use App\Models\LogementPhoto;
use App\Support\OffreAgence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BailleurLogementController extends Controller
{
    /**
     * Afficher la liste des logements du bailleur
     */
    public function index(Request $request)
    {
        $user = auth()->user();

        $promotion = $request->integer('promotion');

        abort_unless(
            in_array($promotion, [0, 1, 2], true),
            404
        );

        $logements = Logement::where(
            'user_id',
            $user->id
        )
            ->when(
                $promotion > 0,
                fn ($query) => $query->where('statut', 'actif')
            )
            ->with('photos')
            ->withCount('favoris')
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view(
            'bailleur.logements.index',
            compact('logements', 'promotion')
        );
    }

    /**
     * Afficher le formulaire d'ajout
     */
    public function create()
    {
        $user = auth()->user();

        $nombreLogements = Logement::where(
            'user_id',
            $user->id
        )->count();

        $limite = $this->limiteAnnonces($user);

        // =====================================================
        // ANNONCE EN ATTENTE APRÈS PAIEMENT
        // =====================================================

        $annonceEnAttente = session(
            'annonce_en_attente'
        );

        $photosEnAttente = session(
            'photos_annonce_en_attente',
            []
        );

        // =====================================================
        // AFFICHER LE FORMULAIRE
        // =====================================================

        return view(
            'bailleur.logements.create',
            compact(
                'nombreLogements',
                'limite',
                'annonceEnAttente',
                'photosEnAttente'
            )
        );
    }

    /**
     * Déterminer la limite d'annonces
     */
    private function limiteAnnonces($user)
    {
        /*
        |--------------------------------------------------------------------------
        | AGENCE
        |--------------------------------------------------------------------------
        */

        if ($user->account_type === 'agence') {
            return OffreAgence::details($user)['limite'];
        }

        /*
        |--------------------------------------------------------------------------
        | PARTICULIER / BAILLEUR
        |--------------------------------------------------------------------------
        */

        // Première annonce gratuite
        return 1;
    }

    /**
     * Retourne le solde de crédits d'une agence. Les comptes existants
     * conservent leur calcul historique jusqu'au premier achat d'offre.
     */
    private function creditsAgenceDisponibles($user): ?int
    {
        $limite = $this->limiteAnnonces($user);

        if ($limite === null) {
            return null;
        }

        if ($user->agency_credits_initialized) {
            return (int) $user->annonces_credits;
        }

        $nombreLogements = Logement::where('user_id', $user->id)->count();

        return max(0, $limite - $nombreLogements);
    }

    /**
     * Vérifier si l'utilisateur peut publier gratuitement
     */
    private function peutPublier(): bool
    {
        $user = auth()->user();

        $nombreLogements = Logement::where(
            'user_id',
            $user->id
        )->count();

        /*
        |--------------------------------------------------------------------------
        | PARTICULIER / BAILLEUR
        |--------------------------------------------------------------------------
        */

        if (
            in_array(
                $user->account_type,
                ['bailleur', 'particulier']
            )
        ) {

            // Une seule annonce gratuite
            return $nombreLogements < 1;
        }

        /*
        |--------------------------------------------------------------------------
        | AGENCE
        |--------------------------------------------------------------------------
        */

        if ($user->account_type === 'agence') {
            $creditsDisponibles = $this->creditsAgenceDisponibles($user);

            return $creditsDisponibles === null || $creditsDisponibles > 0;
        }

        return false;
    }

    /**
     * Enregistrer le logement
     */
    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'titre' => [
                'required',
                'string',
                'max:255',
            ],

            'type_logement' => [
                'required',
                'in:appartement,maison,villa,studio,chambre,chambre_salon',
            ],

            'wc_douche_interne' => [
                'required',
                'boolean',
            ],

            'cuisine' => [
                'required',
                'boolean',
            ],

            'nombre_chambres' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'nombre_salles_bain' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'ville' => [
                'required',
                'string',
                'max:100',
            ],

            'quartier' => [
                'required',
                'string',
                'max:150',
            ],

            'adresse' => [
                'nullable',
                'string',
                'max:255',
            ],

            'prix' => [
                'required',
                'numeric',
                'min:0',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'photos' => [
                'nullable',
                'array',
                'max:10',
            ],

            'photos.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],
        ]);

        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | NOMBRE D'ANNONCES
        |--------------------------------------------------------------------------
        */

        $nombreLogements = Logement::where(
            'user_id',
            $user->id
        )->count();

        /*
        |--------------------------------------------------------------------------
        | PARTICULIER / BAILLEUR
        |--------------------------------------------------------------------------
        */

        if (
            in_array(
                $user->account_type,
                ['bailleur', 'particulier']
            )
        ) {

            /*
            |--------------------------------------------------------------------------
            | PREMIÈRE ANNONCE GRATUITE
            |--------------------------------------------------------------------------
            */

            if ($nombreLogements === 0) {

                return $this->creerLogement(
                    $validated,
                    $request,
                    $user,
                    'Votre première annonce a été publiée gratuitement avec succès.',
                    false
                );
            }

            /*
            |--------------------------------------------------------------------------
            | CRÉDIT DISPONIBLE
            |--------------------------------------------------------------------------
            */

            if ((int) $user->annonces_credits > 0) {

                return $this->creerLogement(
                    $validated,
                    $request,
                    $user,
                    'Votre annonce supplémentaire a été publiée avec succès.',
                    true
                );
            }

            /*
            |--------------------------------------------------------------------------
            | AUCUN CRÉDIT
            |--------------------------------------------------------------------------
            |
            | L'annonce est conservée temporairement.
            |
            */

            $donneesAnnonce = $validated;

            unset(
                $donneesAnnonce['photos']
            );

            session([
                'annonce_en_attente' => $donneesAnnonce,
            ]);

            /*
            |--------------------------------------------------------------------------
            | SAUVEGARDER LES PHOTOS TEMPORAIRES
            |--------------------------------------------------------------------------
            */

            $photos = [];

            if ($request->hasFile('photos')) {

                foreach ($request->file('photos') as $photo) {

                    $chemin = $photo->store(
                        'annonces-en-attente/'.$user->id,
                        'public'
                    );

                    $photos[] = $chemin;
                }
            }

            /*
            |--------------------------------------------------------------------------
            | SAUVEGARDER LES PHOTOS EN SESSION
            |--------------------------------------------------------------------------
            */

            session([
                'photos_annonce_en_attente' => $photos,
            ]);

            /*
            |--------------------------------------------------------------------------
            | REDIRECTION VERS PAIEMENT
            |--------------------------------------------------------------------------
            */

            return redirect()
                ->route(
                    'paiement.annonce.supplementaire'
                )
                ->with(
                    'info',
                    'Vous avez utilisé votre annonce gratuite. Cette annonce supplémentaire coûte 2 500 FCFA.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | AGENCE
        |--------------------------------------------------------------------------
        */

        if ($user->account_type === 'agence') {

            if (! $this->peutPublier()) {

                $limite = $this->limiteAnnonces(
                    $user
                );

                if ($limite === null) {

                    return back()->with(
                        'error',
                        'Une erreur est survenue avec votre abonnement.'
                    );
                }

                $detailsOffre = OffreAgence::details($user);

                return redirect()
                    ->route(
                        'bailleur.offres'
                    )
                    ->with(
                        'error',
                        "Vous avez atteint la limite de {$limite} annonces de votre offre {$detailsOffre['nom']}."
                    );
            }

            /*
            |--------------------------------------------------------------------------
            | PUBLICATION AGENCE
            |--------------------------------------------------------------------------
            */

            return $this->creerLogement(
                $validated,
                $request,
                $user,
                'Votre logement a été publié avec succès.',
                $user->agency_credits_initialized
                    && $this->limiteAnnonces($user) !== null
            );
        }

        /*
        |--------------------------------------------------------------------------
        | TYPE DE COMPTE INVALIDE
        |--------------------------------------------------------------------------
        */

        return back()->with(
            'error',
            'Type de compte invalide.'
        );
    }

    /**
     * Créer réellement le logement
     */
    private function creerLogement(
        array $validated,
        Request $request,
        $user,
        string $message,
        bool $consommerCredit = false
    ) {
        return DB::transaction(function () use (
            $validated,
            $request,
            $user,
            $message,
            $consommerCredit
        ) {

            /*
            |--------------------------------------------------------------------------
            | PHOTOS TEMPORAIRES
            |--------------------------------------------------------------------------
            */

            $photosTemporaires = session(
                'photos_annonce_en_attente',
                []
            );

            /*
            |--------------------------------------------------------------------------
            | DONNÉES DU LOGEMENT
            |--------------------------------------------------------------------------
            */

            $validated['user_id'] = $user->id;

            $validated['statut'] = 'actif';

            $validated['vues'] = 0;

            unset(
                $validated['photos']
            );

            /*
            |--------------------------------------------------------------------------
            | CRÉER LE LOGEMENT
            |--------------------------------------------------------------------------
            */

            $logement = Logement::create(
                $validated
            );

            /*
            |--------------------------------------------------------------------------
            | PHOTOS TEMPORAIRES
            |--------------------------------------------------------------------------
            */

            foreach (
                $photosTemporaires as $index => $chemin
            ) {

                if (
                    Storage::disk('public')
                        ->exists($chemin)
                ) {

                    $nouveauChemin =
                        'logements/'.
                        $logement->id.
                        '/'.
                        basename($chemin);

                    Storage::disk('public')->move(
                        $chemin,
                        $nouveauChemin
                    );

                    LogementPhoto::create([

                        'logement_id' => $logement->id,

                        'chemin' => $nouveauChemin,

                        'principale' => $index === 0,
                    ]);
                }
            }

            /*
            |--------------------------------------------------------------------------
            | NOUVELLES PHOTOS
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('photos')) {

                foreach (
                    $request->file('photos') as $index => $photo
                ) {

                    $chemin = $photo->store(
                        'logements/'.
                        $logement->id,
                        'public'
                    );

                    LogementPhoto::create([

                        'logement_id' => $logement->id,

                        'chemin' => $chemin,

                        'principale' => empty($photosTemporaires)
                            && $index === 0,
                    ]);
                }
            }

            /*
            |--------------------------------------------------------------------------
            | CONSOMMER LE CRÉDIT
            |--------------------------------------------------------------------------
            */

            if ($consommerCredit) {

                if (
                    (int) $user->annonces_credits <= 0
                ) {

                    throw new \Exception(
                        'Vous ne disposez plus de crédit d’annonce.'
                    );
                }

                $user->decrement(
                    'annonces_credits'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | NETTOYER LA SESSION
            |--------------------------------------------------------------------------
            */

            session()->forget([

                'annonce_en_attente',

                'photos_annonce_en_attente',

            ]);

            /*
            |--------------------------------------------------------------------------
            | REDIRECTION
            |--------------------------------------------------------------------------
            */

            return redirect()
                ->route(
                    'bailleur.dashboard'
                )
                ->with(
                    'success',
                    $message
                );
        });
    }

    /**
     * Afficher un logement
     */
    public function show(Logement $logement)
    {
        abort_if(
            $logement->user_id !== auth()->id(),
            403
        );

        $logement->load('photos');

        return view(
            'bailleur.logements.show',
            compact('logement')
        );
    }

    /**
     * Modifier
     */
    public function edit(Logement $logement)
    {
        abort_if(
            $logement->user_id !== auth()->id(),
            403
        );

        return view(
            'bailleur.logements.edit',
            compact('logement')
        );
    }

    /**
     * Mettre à jour
     */
    public function update(
        Request $request,
        Logement $logement
    ) {
        abort_if(
            $logement->user_id !== auth()->id(),
            403
        );

        $validated = $request->validate([

            'titre' => [
                'required',
                'string',
                'max:255',
            ],

            'type_logement' => [
                'required',
                'in:appartement,maison,villa,studio,chambre,chambre_salon',
            ],

            'wc_douche_interne' => [
                'required',
                'boolean',
            ],

            'cuisine' => [
                'required',
                'boolean',
            ],

            'nombre_chambres' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'nombre_salles_bain' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'ville' => [
                'required',
                'string',
                'max:100',
            ],

            'quartier' => [
                'required',
                'string',
                'max:150',
            ],

            'adresse' => [
                'nullable',
                'string',
                'max:255',
            ],

            'prix' => [
                'required',
                'numeric',
                'min:0',
            ],

            'description' => [
                'nullable',
                'string',
            ],
        ]);

        $logement->update(
            $validated
        );

        return redirect()
            ->route(
                'bailleur.logements.show',
                $logement
            )
            ->with(
                'success',
                'Le logement a été modifié avec succès.'
            );
    }

    /**
     * Supprimer
     */
    public function destroy(
        Logement $logement
    ) {
        abort_if(
            $logement->user_id !== auth()->id(),
            403
        );

        $logement->delete();

        return redirect()
            ->route(
                'bailleur.logements.index'
            )
            ->with(
                'success',
                'Le logement a été supprimé avec succès.'
            );
    }
}
