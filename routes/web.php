<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDashboardController;
// Controllers
use App\Http\Controllers\BailleurController;
use App\Http\Controllers\BailleurLogementController;
use App\Http\Controllers\FavoriController;
use App\Http\Controllers\LocataireLogementController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\ProfileController;
use App\Models\Logement;
use App\Models\Message;
// Models
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post(
    '/paygate/callback',
    [PaiementController::class, 'paygateCallback']
)->name('paygate.callback');

Route::get('/manifest.webmanifest', function () {
    return response()->file(public_path('manifest.webmanifest'), [
        'Content-Type' => 'application/manifest+json',
    ]);
})->name('pwa.manifest');

Route::get('/sw.js', function () {
    return response()->file(public_path('sw.js'), [
        'Content-Type' => 'application/javascript',
        'Service-Worker-Allowed' => '/',
        'Cache-Control' => 'no-cache',
    ]);
})->name('pwa.service-worker');

Route::get('/offline.html', function () {
    return response()->file(public_path('offline.html'));
})->name('pwa.offline');

/*
|--------------------------------------------------------------------------
| ACCUEIL
|--------------------------------------------------------------------------
|
| Page d'accueil publique de ChezMoi.
|
*/

Route::get('/', function () {

    $logementsPopulaires = Logement::with('photos')
        ->visibleToPublic()
        ->latest()
        ->take(3)
        ->get();

    $statistiques = [
        'logements' => Logement::visibleToPublic()->count(),
        'bailleurs' => User::where('role', 'bailleur')->count(),
        'locataires' => User::where('role', 'locataire')->count(),
    ];

    return view('welcome', compact('logementsPopulaires', 'statistiques'));

})->name('home');

Route::view('/politique-de-confidentialite', 'legal', [
    'title' => 'Politique de confidentialité',
    'type' => 'privacy',
])->name('legal.privacy');

Route::view('/conditions-utilisation', 'legal', [
    'title' => 'Conditions d’utilisation',
    'type' => 'terms',
])->name('legal.terms');

Route::get('/logements/{logement}/connexion', function (Logement $logement) {

    if (! auth()->check()) {
        session()->put('url.intended', route('locataire.logements.show', $logement));

        return redirect()->route('login');
    }

    return redirect()->route('locataire.logements.show', $logement);

})->name('logement.login');

Route::get('/recherche-logements', function (Request $request) {

    if (! auth()->check()) {
        session()->put('url.intended', route('locataire.logements.index', $request->query()));

        return redirect()->route('login');
    }

    return redirect()->route('locataire.logements.index', $request->query());

})->name('recherche.login');

Route::get(
    '/logements/{logement}',
    [LocataireLogementController::class, 'show']
)->middleware('auth')->name('locataire.logements.show');

Route::get(
    '/logements',
    [LocataireLogementController::class, 'index']
)->middleware(['auth', 'role:locataire,bailleur'])
    ->name('locataire.logements.index');

/*
|--------------------------------------------------------------------------
| DASHBOARD PRINCIPAL
|--------------------------------------------------------------------------
|
| Redirige automatiquement l'utilisateur connecté
| vers son espace selon son rôle.
|
*/

Route::get('/dashboard', function () {

    $user = auth()->user();

    return match ($user->role) {

        'admin' => redirect()->route('admin.dashboard'),

        'bailleur' => redirect()->route('bailleur.dashboard'),

        'locataire' => redirect()->route('locataire.dashboard'),

        default => redirect()->route('home'),

    };

})->middleware('auth')->name('dashboard');

/*
|--------------------------------------------------------------------------
| ESPACE LOCATAIRE
|--------------------------------------------------------------------------
|
| Toutes les routes accessibles uniquement aux locataires.
|
*/

Route::middleware(['auth', 'role:locataire'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD LOCATAIRE
    |--------------------------------------------------------------------------
    |
    | Affiche les logements mis en avant sur le tableau de bord.
    |
    */

    Route::get('/locataire/dashboard', function () {

        $logementsEnAvant = Logement::with('photos')
            ->visibleToPublic()

            // Uniquement les logements ayant une visibilité payante
            ->where('niveau_visibilite', '>', 0)

            // Vérification de la date de début de visibilité
            ->where(function ($query) {

                $query
                    ->whereNull('date_debut_visibilite')
                    ->orWhere(
                        'date_debut_visibilite',
                        '<=',
                        now()
                    );

            })

            // Vérification de la date de fin de visibilité
            ->where(function ($query) {

                $query
                    ->whereNull('date_fin_visibilite')
                    ->orWhere(
                        'date_fin_visibilite',
                        '>=',
                        now()
                    );

            })

            // Les logements avec le meilleur niveau de visibilité
            // apparaissent en premier
            ->orderByDesc('niveau_visibilite')

            // Puis les plus récents
            ->latest()

            // Maximum 6 logements sur le dashboard
            ->take(6)

            ->get();

        $messagesNonLus = Message::nonLusPour(auth()->id())
            ->count();

        $dernieresNotifications = Message::with(['expediteur', 'logement'])
            ->nonLusPour(auth()->id())
            ->latest()
            ->take(3)
            ->get();

        return view(
            'locataire.dashboard',
            compact('logementsEnAvant', 'messagesNonLus', 'dernieresNotifications')
        );

    })->name('locataire.dashboard');

    /*
    |--------------------------------------------------------------------------
    | LOGEMENTS
    |--------------------------------------------------------------------------
    |
    | Recherche et consultation des logements.
    |
    */

    /*
    |--------------------------------------------------------------------------
    | FAVORIS
    |--------------------------------------------------------------------------
    |
    | Gestion des logements favoris du locataire.
    |
    */

    // Ajouter un logement aux favoris
    Route::post(
        '/logements/{logement}/favori',
        [FavoriController::class, 'store']
    )->name('favoris.store');

    // Retirer un logement des favoris
    Route::delete(
        '/logements/{logement}/favori',
        [FavoriController::class, 'destroy']
    )->name('favoris.destroy');

    // Liste des favoris
    Route::get(
        '/mes-favoris',
        [FavoriController::class, 'index']
    )->name('favoris.index');

    /*
    |--------------------------------------------------------------------------
    | MESSAGES / CONTACT BAILLEUR
    |--------------------------------------------------------------------------
    |
    | Permet au locataire de contacter le propriétaire
    | d'un logement.
    |
    */

    // Formulaire de contact
    Route::get(
        '/logements/{logement}/contacter',
        [MessageController::class, 'create']
    )->name('messages.create');

    // Envoyer un message au bailleur
    Route::post(
        '/logements/{logement}/contacter',
        [MessageController::class, 'store']
    )->name('messages.store');

    // Liste des conversations du locataire
    Route::get(
        '/locataire/messages',
        [MessageController::class, 'locataireIndex']
    )->name('locataire.messages.index');

    // Afficher une conversation du locataire
    Route::get(
        '/locataire/messages/{message}',
        [MessageController::class, 'locataireShow']
    )->name('locataire.messages.show');

    // Répondre à un bailleur
    Route::post(
        '/locataire/messages/{message}/repondre',
        [MessageController::class, 'locataireReply']
    )->name('locataire.messages.reply');

    // Afficher la page de confirmation de suppression d'un message envoyé par le locataire
    Route::get(
        '/locataire/messages/{message}/supprimer',
        [MessageController::class, 'locataireConfirmDestroy']
    )->name('locataire.messages.destroy');

    // Supprimer un message pour le locataire
    Route::delete(
        '/locataire/messages/{message}/supprimer',
        [MessageController::class, 'supprimerPourMoi']
    )->name('locataire.messages.supprimer');

    Route::get(
        '/locataire/messages/{message}/repondre',
        function (Message $message) {
            return redirect()->route('locataire.messages.show', $message)->withFragment('repondre');
        }
    );

});

/*
|--------------------------------------------------------------------------
| ESPACE BAILLEUR
|--------------------------------------------------------------------------
|
| Toutes les routes accessibles uniquement aux bailleurs.
|
*/

Route::middleware(['auth', 'role:bailleur'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD BAILLEUR
    |--------------------------------------------------------------------------
    |
    | Tableau de bord principal du bailleur.
    |
    */

    Route::get(
        '/bailleur/dashboard',
        [BailleurController::class, 'dashboard']
    )->name('bailleur.dashboard');

    /*
    |--------------------------------------------------------------------------
    | OFFRES
    |--------------------------------------------------------------------------
    |
    | Gestion de l'offre / abonnement du bailleur.
    |
    */

    Route::get(
        '/mes-offres',
        [OffreController::class, 'index']
    )->name('bailleur.offres');

    /*
    |--------------------------------------------------------------------------
    | LOGEMENTS
    |--------------------------------------------------------------------------
    |
    | CRUD complet des logements du bailleur.
    |
    */

    // Liste des logements
    Route::get(
        '/bailleur/logements',
        [BailleurLogementController::class, 'index']
    )->name('bailleur.logements.index');

    // Formulaire d'ajout
    Route::get(
        '/bailleur/logements/create',
        [BailleurLogementController::class, 'create']
    )->name('bailleur.logements.create');

    // Enregistrer un logement
    Route::post(
        '/bailleur/logements',
        [BailleurLogementController::class, 'store']
    )->name('bailleur.logements.store');

    // Afficher les détails d'un logement
    Route::get(
        '/bailleur/logements/{logement}',
        [BailleurLogementController::class, 'show']
    )->name('bailleur.logements.show');

    // Formulaire de modification
    Route::get(
        '/bailleur/logements/{logement}/edit',
        [BailleurLogementController::class, 'edit']
    )->name('bailleur.logements.edit');

    // Mettre à jour un logement
    Route::put(
        '/bailleur/logements/{logement}',
        [BailleurLogementController::class, 'update']
    )->name('bailleur.logements.update');

    // Supprimer un logement
    Route::delete(
        '/bailleur/logements/{logement}',
        [BailleurLogementController::class, 'destroy']
    )->name('bailleur.logements.destroy');

    /*
    |--------------------------------------------------------------------------
    | MESSAGES BAILLEUR
    |--------------------------------------------------------------------------
    |
    | Réception et gestion des messages envoyés par les locataires.
    |
    */

    // Liste des messages reçus
    Route::get(
        '/bailleur/messages',
        [MessageController::class, 'received']
    )->name('bailleur.messages.index');

    // Afficher un message
    Route::get(
        '/bailleur/messages/{message}',
        [MessageController::class, 'show']
    )->name('bailleur.messages.show');

    // Confirmer la suppression d'un message envoyé ou reçu par le bailleur
    Route::get(
        '/bailleur/messages/{message}/supprimer',
        [MessageController::class, 'bailleurConfirmDestroy']
    )->name('bailleur.messages.destroy');

    // Supprimer un message pour le bailleur
    Route::delete(
        '/bailleur/messages/{message}/supprimer',
        [MessageController::class, 'supprimerPourMoi']
    )->name('bailleur.messages.supprimer');

    // Afficher le formulaire de réponse
    Route::get(
        '/bailleur/messages/{message}/reply',
        [MessageController::class, 'reply']
    )->name('bailleur.messages.reply');

    // Envoyer la réponse
    Route::post(
        '/bailleur/messages/{message}/reply',
        [MessageController::class, 'sendReply']
    )->name('bailleur.messages.sendReply');

    /*
    |--------------------------------------------------------------------------
    | PAIEMENT - ANNONCE SUPPLÉMENTAIRE
    |--------------------------------------------------------------------------
    |
    | Permet au bailleur d'acheter des annonces supplémentaires.
    |
    */

    // Page de paiement d'une annonce supplémentaire
    Route::get(
        '/bailleur/paiement/annonce-supplementaire',
        [PaiementController::class, 'annonceSupplementaire']
    )->name('paiement.annonce.supplementaire');

    // Confirmer le paiement
    Route::post(
        '/paiement/annonce-supplementaire/{paiement}/confirmer',
        [PaiementController::class, 'confirmerAnnonceSupplementaire']
    )->name('paiement.annonce.supplementaire.confirmer');

    /*
    |--------------------------------------------------------------------------
    | PAIEMENT - OFFRE AGENCE
    |--------------------------------------------------------------------------
    |
    | Paiement d'une offre destinée aux agences.
    |
    */

    // Page de paiement de l'offre agence
    Route::get(
        '/paiement/offre-agence/{offre}',
        [PaiementController::class, 'offreAgence']
    )->name('paiement.offre.agence');

    // Confirmer le paiement de l'offre agence
    Route::post(
        '/paiement/offre-agence/{paiement}/confirmer',
        [PaiementController::class, 'confirmerOffreAgence']
    )->name('paiement.offre.agence.confirmer');

    /*
    |--------------------------------------------------------------------------
    | CHOIX DU LOGEMENT POUR LA VISIBILITÉ
    |--------------------------------------------------------------------------
    |
    | Après avoir choisi une offre de visibilité,
    | le bailleur sélectionne le logement concerné.
    |
    */

    Route::get(
        '/bailleur/paiement/choisir-logement/{niveau}',
        [PaiementController::class, 'choisirLogement']
    )->name('paiement.choisir.logement');

    /*
    |--------------------------------------------------------------------------
    | VISIBILITÉ DES LOGEMENTS
    |--------------------------------------------------------------------------
    |
    | Gestion des niveaux de visibilité payants.
    |
    */

    // Afficher les options de visibilité d'un logement
    Route::get(
        '/bailleur/logements/{logement}/visibilite',
        [PaiementController::class, 'index']
    )->name('bailleur.visibilite.index');

    // Créer le paiement pour la visibilité choisie
    Route::post(
        '/bailleur/logements/{logement}/visibilite',
        [PaiementController::class, 'acheter']
    )->name('bailleur.visibilite.acheter');

    // Page de paiement de la visibilité
    Route::get(
        '/bailleur/paiement/visibilite',
        [PaiementController::class, 'visibilite']
    )->name('paiement.visibilite');

    // Confirmer le paiement de la visibilité
    Route::post(
        '/bailleur/paiement/visibilite/{paiement}/confirmer',
        [PaiementController::class, 'confirmerVisibilite']
    )->name('paiement.visibilite.confirmer');

    /*
    |--------------------------------------------------------------------------
    | MISE EN AVANT
    |--------------------------------------------------------------------------
    |
    | Gestion de la mise en avant spécifique d'un logement.
    |
    */

    // Page de mise en avant
    Route::get(
        '/bailleur/logements/{logement}/mise-en-avant',
        [PaiementController::class, 'miseEnAvant']
    )->name('paiement.mise.en.avant');

    // Confirmer la mise en avant
    Route::post(
        '/bailleur/logements/{logement}/mise-en-avant/confirmer',
        [PaiementController::class, 'confirmerMiseEnAvant']
    )->name('paiement.mise.en.avant.confirmer');

    /*
    |--------------------------------------------------------------------------
    | HISTORIQUE DES PAIEMENTS
    |--------------------------------------------------------------------------
    |
    | Affiche tous les paiements effectués par le bailleur.
    |
    */

    Route::get(
        '/bailleur/paiements',
        [PaiementController::class, 'historique']
    )->name('bailleur.paiements.index');

    /*
    |--------------------------------------------------------------------------
    | PAYGATE
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/paygate/retour',
        [PaiementController::class, 'paygateReturn']
    )->name('paygate.return');

    Route::post(
        '/paygate/payer/{paiement}',
        [PaiementController::class, 'demarrerPaygate']
    )->name('paygate.start');

    Route::post(
        '/paygate/annuler/{paiement}',
        [PaiementController::class, 'annulerTentativePaygate']
    )->name('paygate.cancel');

});

/*
|--------------------------------------------------------------------------
| ESPACE ADMIN
|--------------------------------------------------------------------------
|
| Routes accessibles uniquement aux administrateurs.
|
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD ADMIN
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');
    Route::get('/admin/utilisateurs', [AdminController::class, 'users'])->name('admin.users');
    Route::patch('/admin/utilisateurs/{user}/suspension', [AdminController::class, 'toggleSuspension'])->name('admin.users.suspension');
    Route::get('/admin/logements', [AdminController::class, 'logements'])->name('admin.logements');
    Route::patch('/admin/logements/{logement}', [AdminController::class, 'updateLogement'])->name('admin.logements.update');
    Route::get('/admin/paiements', [AdminController::class, 'payments'])->name('admin.payments');

});

/*
|--------------------------------------------------------------------------
| PROFIL UTILISATEUR
|--------------------------------------------------------------------------
|
| Gestion du profil de l'utilisateur connecté.
|
*/

Route::middleware('auth')->group(function () {

    // Afficher le formulaire de profil
    Route::get(
        '/profile',
        [ProfileController::class, 'edit']
    )->name('profile.edit');

    // Mettre à jour le profil
    Route::patch(
        '/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');

    // Supprimer le compte
    Route::delete(
        '/profile',
        [ProfileController::class, 'destroy']
    )->name('profile.destroy');

});

/*
|--------------------------------------------------------------------------
| AUTHENTIFICATION BREEZE
|--------------------------------------------------------------------------
|
| Routes de connexion, inscription, mot de passe, etc.
|
*/

require __DIR__.'/auth.php';
