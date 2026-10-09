<?php

namespace App\Http\Controllers;

use App\Models\Favori;
use App\Models\Logement;
use App\Models\Message;
use App\Support\OffreAgence;
use Illuminate\Support\Facades\Auth;

class BailleurController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        // =====================================================
        // TYPE DE COMPTE
        // =====================================================

        $typeCompte = $user->account_type ?? 'particulier';

        $estAgence = $typeCompte === 'agence';

        // =====================================================
        // NOMBRE D'ANNONCES
        // =====================================================

        $totalLogements = Logement::where(
            'user_id',
            $user->id
        )->count();

        $annoncesUtilisees = $totalLogements;

        // =====================================================
        // OFFRE / LIMITE
        // =====================================================

        $offreExpiree = false;
        $abonnementFin = null;
        $joursRestants = null;

        if ($estAgence) {

            $detailsOffre = OffreAgence::details($user);

            $offre = $detailsOffre['code'];
            $nomOffre = $detailsOffre['nom'];
            $limiteAnnonces = $detailsOffre['limite'];
            $prixOffre = $detailsOffre['prix'];

            $offreExpiree = OffreAgence::estExpiree($user);
            $abonnementFin = $user->abonnement_fin;

            if ($abonnementFin) {
                $secondesRestantes = $abonnementFin->getTimestamp() - now()->getTimestamp();

                if ($secondesRestantes <= 0) {
                    $secondesRestantes = 0;
                }

                $joursRestants = (int) ceil($secondesRestantes / 86400);
            }

        } else {

            // =================================================
            // BAILLEUR PARTICULIER
            // =================================================

            $offre = 'gratuit';

            $nomOffre = 'Première annonce gratuite';

            // 1 seule annonce est gratuite.
            // Les suivantes sont payantes.
            $limiteAnnonces = null;

            $prixOffre = 0;
        }

        // =====================================================
        // ANNONCES RESTANTES
        // =====================================================

        if ($estAgence) {

            if ($limiteAnnonces === null) {

                // Agence illimitée
                $annoncesRestantes = null;

            } else {

                // Après le premier achat d'offre, le solde est persistant :
                // chaque nouveau pack s'ajoute aux crédits non utilisés.
                $annoncesRestantes = $user->agency_credits_initialized
                    ? (int) $user->annonces_credits
                    : max(0, $limiteAnnonces - $annoncesUtilisees);
            }

        } else {

            // Bailleur :
            // seule la première annonce est gratuite

            $annoncesRestantes = max(
                0,
                1 - $annoncesUtilisees
            );
        }

        // =====================================================
        // LOGEMENTS ACTIFS
        // =====================================================

        $logementsActifs = Logement::where(
            'user_id',
            $user->id
        )
            ->where('statut', 'actif')
            ->count();

        // =====================================================
        // LOGEMENTS DISPONIBLES
        // =====================================================

        $logementsDisponibles = Logement::where(
            'user_id',
            $user->id
        )
            ->where('statut', 'actif')
            ->count();

        // =====================================================
        // VUES
        // =====================================================

        $totalVues = Logement::where(
            'user_id',
            $user->id
        )->sum('vues');

        // =====================================================
        // MESSAGES
        // =====================================================

        $totalMessages = Message::where(
            'destinataire_id',
            $user->id
        )
            ->where('supprime_par_destinataire', false)
            ->count();

        $messagesNonLus = Message::nonLusPour($user->id)->count();

        // =====================================================
        // FAVORIS REÇUS
        // =====================================================

        $totalFavoris = Favori::whereHas(
            'logement',
            function ($query) use ($user) {

                $query->where(
                    'user_id',
                    $user->id
                );

            }
        )->count();

        // =====================================================
        // DERNIERS LOGEMENTS
        // =====================================================

        $logements = Logement::where(
            'user_id',
            $user->id
        )
            ->withCount('favoris')
            ->latest()
            ->take(5)
            ->get();

        // =====================================================
        // DERNIERS MESSAGES
        // =====================================================

        $messages = Message::with([
            'expediteur',
            'logement',
        ])
            ->where(
                'destinataire_id',
                $user->id
            )
            ->where('supprime_par_destinataire', false)
            ->latest()
            ->take(5)
            ->get();

        // =====================================================
        // OFFRES BAILLEUR
        // =====================================================

        $offresBailleur = [

            [
                'nom' => 'Première annonce',
                'prix' => 0,
                'description' => 'Votre première annonce est gratuite.',
            ],

            [
                'nom' => 'Annonce supplémentaire',
                'prix' => 1000,
                'description' => 'Publier une annonce supplémentaire.',
            ],

            [
                'nom' => 'Mise en avant',
                'prix' => 2500,
                'description' => 'Donner plus de visibilité à votre logement.',
            ],

            [
                'nom' => 'Tête des résultats',
                'prix' => 5000,
                'description' => 'Votre logement en tête pendant 7 jours.',
            ],

        ];

        // =====================================================
        // OFFRES AGENCE
        // =====================================================

        $offresAgence = [

            [
                'nom' => 'Découverte',
                'offre' => 'gratuit',
                'prix' => 0,
                'annonces' => 3,
            ],

            [
                'nom' => 'Pro',
                'offre' => 'pro',
                'prix' => 50000,
                'annonces' => 20,
            ],

            [
                'nom' => 'Premium',
                'offre' => 'premium',
                'prix' => 200000,
                'annonces' => 100,
            ],

            [
                'nom' => 'Business',
                'offre' => 'illimite',
                'prix' => 500000,
                'annonces' => null,
            ],

        ];

        // =====================================================
        // RETOUR DASHBOARD
        // =====================================================

        return view(
            'bailleur.dashboard',
            compact(
                'totalLogements',
                'logementsActifs',
                'logementsDisponibles',
                'totalVues',
                'totalFavoris',
                'totalMessages',
                'messagesNonLus',
                'logements',
                'messages',

                'typeCompte',
                'estAgence',
                'offre',
                'nomOffre',
                'limiteAnnonces',
                'annoncesUtilisees',
                'annoncesRestantes',
                'prixOffre',
                'offreExpiree',
                'abonnementFin',
                'joursRestants',

                'offresBailleur',
                'offresAgence'
            )
        );
    }
}
