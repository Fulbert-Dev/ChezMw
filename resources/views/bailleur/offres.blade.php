<x-app-layout>

    <x-app-sidebar />

<style>

    .offers-page {
        min-height: calc(100vh - 65px);
        padding: 40px 20px 60px;
        background:
            linear-gradient(135deg, #f0f8ff, #f0fff6);
    }

    .offers-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .offers-header h1 {
        font-size: 32px;
        font-weight: 800;
        color: #172033;
        margin-bottom: 10px;
    }

    .offers-header p {
        color: #6c757d;
        font-size: 16px;
    }

    .account-type {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        border-radius: 50px;
        background: white;
        color: #198754;
        font-weight: 700;
        box-shadow: 0 5px 20px rgba(0,0,0,.06);
        margin-bottom: 15px;
    }

    .offers-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
        max-width: 1200px;
        margin: auto;
    }

    .offer-card {
        background: white;
        border-radius: 24px;
        padding: 30px 25px;
        box-shadow: 0 10px 30px rgba(0,0,0,.07);
        border: 2px solid transparent;
        position: relative;
        transition: .3s;
    }

    .offer-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 18px 40px rgba(0,0,0,.12);
    }

    .offer-card.featured {
        border-color: #0d6efd;
        transform: translateY(-8px);
    }

    .offer-card.featured:hover {
        transform: translateY(-13px);
    }

    .popular {
        position: absolute;
        top: -13px;
        left: 50%;
        transform: translateX(-50%);
        background: linear-gradient(135deg, #0d6efd, #198754);
        color: white;
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 800;
        white-space: nowrap;
    }

    .offer-icon {
        width: 60px;
        height: 60px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        background: #eef5ff;
        margin-bottom: 20px;
    }

    .offer-card h3 {
        font-size: 21px;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .offer-description {
        color: #6c757d;
        min-height: 45px;
    }

    .offer-price {
        margin: 25px 0;
        font-size: 28px;
        font-weight: 900;
        color: #198754;
    }

    .offer-price small {
        font-size: 13px;
        color: #6c757d;
        font-weight: 500;
    }

    .offer-list {
        list-style: none;
        padding: 0;
        margin: 0 0 25px;
    }

    .offer-list li {
        padding: 9px 0;
        color: #495057;
    }

    .offer-button {
        display: block;
        width: 100%;
        padding: 12px;
        border-radius: 12px;
        text-align: center;
        text-decoration: none;
        font-weight: 700;
        background: #0d6efd;
        color: white;
        transition: .3s;
    }

    .offer-button:hover {
        background: #198754;
        color: white;
        transform: translateY(-2px);
    }

    .free-button {
        background: #198754;
    }

    .section-title {
        max-width: 1200px;
        margin: 55px auto 25px;
        font-size: 24px;
        font-weight: 800;
        color: #172033;
    }

    .current-offer {
        max-width: 1200px;
        margin: 0 auto 35px;
        background: white;
        border-radius: 18px;
        padding: 20px 25px;
        box-shadow: 0 7px 25px rgba(0,0,0,.06);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .current-offer strong {
        color: #198754;
    }

    @media(max-width: 1000px) {

        .offers-grid {
            grid-template-columns: repeat(2, 1fr);
        }

    }

    @media(max-width: 600px) {

        .offers-page {
            padding: 25px 15px 45px;
        }

        .offers-header h1 {
            font-size: 26px;
        }

        .offers-grid {
            grid-template-columns: 1fr;
        }

        .offer-card.featured {
            transform: none;
        }

        .current-offer {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

    }

</style>


@if(session('error'))

    <div class="alert alert-warning">
        <i class="bi bi-exclamation-triangle"></i>

        {{ session('error') }}
    </div>

@endif


@if(session('success'))

    <div class="alert alert-success">
        <i class="bi bi-check-circle"></i>

        {{ session('success') }}
    </div>

@endif


<div class="offers-page">

    <div class="offers-header">

        <div class="account-type">

            @if(auth()->user()->account_type === 'agence')

                🏢 Compte agence

            @else

                👤 Compte bailleur

            @endif

        </div>

        <h1>
            Mes offres et tarifs
        </h1>

        <p>
            Développez la visibilité de vos logements
            avec CHEZMW.
        </p>

    </div>


    <!-- OFFRE ACTUELLE -->

    <div class="current-offer">

        <div>

            Offre actuelle :

            <strong>
                {{ ucfirst(auth()->user()->offre ?? 'gratuit') }}
            </strong>

        </div>

        <div>

            Annonces publiées :

            <strong>
                {{ auth()->user()->logements()->count() }}
            </strong>

        </div>

    </div>


    @if(auth()->user()->account_type === 'agence')

        <!-- =================================================
             AGENCES
        ================================================== -->

        <h2 class="section-title">
            🏢 Offres pour agences immobilières
        </h2>

        <div class="offers-grid">


            <!-- GRATUIT -->

            <div class="offer-card">

                <div class="offer-icon">
                    🆓
                </div>

                <h3>
                    Gratuit
                </h3>

                <p class="offer-description">
                    Pour commencer gratuitement.
                </p>

                <div class="offer-price">
                    0 F
                    <small>
                        / gratuit
                    </small>
                </div>

                <ul class="offer-list">

                    <li>✅ 3 annonces</li>
                    <li>✅ Profil agence</li>
                    <li>✅ Recherche de locataires</li>

                </ul>

                <a href="#" class="offer-button free-button">
                    Offre actuelle
                </a>

            </div>


            <!-- PRO -->

            <div class="offer-card">

                <div class="offer-icon">
                    💼
                </div>

                <h3>
                    Pro
                </h3>

                <p class="offer-description">
                    Pour les petites agences.
                </p>

                <div class="offer-price">
                    50 000 F
                    <small>
                        / offre
                    </small>
                </div>

                <ul class="offer-list">

                    <li>✅ Jusqu'à 20 annonces</li>
                    <li>✅ Profil professionnel</li>
                    <li>✅ Plus de visibilité</li>

                </ul>

                <a href="{{ route('paiement.offre.agence', 'pro') }}" class="offer-button">
                    Choisir Pro
                </a>

            </div>


            <!-- PREMIUM -->

            <div class="offer-card featured">

                <span class="popular">
                    ⭐ POPULAIRE
                </span>

                <div class="offer-icon">
                    ⭐
                </div>

                <h3>
                    Premium
                </h3>

                <p class="offer-description">
                    Pour les agences en croissance.
                </p>

                <div class="offer-price">
                    200 000 F
                    <small>
                        / offre
                    </small>
                </div>

                <ul class="offer-list">

                    <li>✅ Jusqu'à 100 annonces</li>
                    <li>✅ Profil professionnel</li>
                    <li>✅ Grande visibilité</li>

                </ul>

                <a href="{{ route('paiement.offre.agence', 'premium') }}" class="offer-button">
                    Choisir Premium
                </a>

            </div>


            <!-- ILLIMITE -->

            <div class="offer-card">

                <div class="offer-icon">
                    🚀
                </div>

                <h3>
                    Illimité
                </h3>

                <p class="offer-description">
                    Pour les grandes agences.
                </p>

                <div class="offer-price">
                    500 000 F
                    <small>
                        / offre
                    </small>
                </div>

                <ul class="offer-list">

                    <li>✅ Annonces illimitées</li>
                    <li>✅ Profil professionnel</li>
                    <li>✅ Visibilité maximale</li>

                </ul>

                <a href="{{ route('paiement.offre.agence', 'illimite') }}" class="offer-button">
                    Choisir Illimité
                </a>

            </div>

        </div>


    @else

        <!-- =================================================
             BAILLEUR
        ================================================== -->

        <h2 class="section-title">
            👤 Offres pour bailleurs
        </h2>

        <div class="offers-grid">


            <!-- ANNONCE GRATUITE -->

            <div class="offer-card">

                <div class="offer-icon">
                    🆓
                </div>

                <h3>
                    Première annonce
                </h3>

                <p class="offer-description">
                    Publiez votre premier logement gratuitement.
                </p>

                <div class="offer-price">
                    0 F
                </div>

                <ul class="offer-list">

                    <li>✅ 1 annonce gratuite</li>
                    <li>✅ Publication normale</li>
                    <li>✅ Visible dans les recherches</li>

                </ul>

                <a href="{{ route('bailleur.logements.create') }}"
                   class="offer-button free-button">

                    Publier

                </a>

            </div>


            <!-- ANNONCE SUPPLEMENTAIRE -->

            <div class="offer-card">

                <div class="offer-icon">
                    💰
                </div>

                <h3>
                    Annonce supplémentaire
                </h3>

                <p class="offer-description">
                    Publiez un logement supplémentaire.
                </p>

                <div class="offer-price">
                    2 500 F
                    <small>
                        / annonce
                    </small>
                </div>

                <ul class="offer-list">

                    <li>✅ 1 annonce supplémentaire</li>
                    <li>✅ Publication normale</li>
                    <li>✅ Visible dans les recherches</li>

                </ul>

                <a href="{{ route('paiement.annonce.supplementaire') }}" class="offer-button">
                    Acheter
                </a>

            </div>


            <!-- MISE EN AVANT -->

            <div class="offer-card featured">

                <span class="popular">
                    ⭐ RECOMMANDÉ
                </span>

                <div class="offer-icon">
                    🔥
                </div>

                <h3>
                    Mise en avant
                </h3>

                <p class="offer-description">
                    Donnez plus de visibilité à votre logement.
                </p>

                <div class="offer-price">
                    2 500 F
                    <small>
                        / annonce
                    </small>
                </div>

                <ul class="offer-list">

                    <li>🔥 Logement mis en avant</li>
                    <li>⬆️ Priorité dans les résultats</li>
                    <li>👁️ Plus de visibilité</li>

                </ul>

                <a href="#" class="offer-button">
                    Mettre en avant
                </a>

            </div>


            <!-- TETE DES RESULTATS -->

            <div class="offer-card">

                <div class="offer-icon">
                    🚀
                </div>

                <h3>
                    Tête des résultats
                </h3>

                <p class="offer-description">
                    Placez votre logement en tête des résultats.
                </p>

                <div class="offer-price">
                    5 000 F
                    <small>
                        / 7 jours
                    </small>
                </div>

                <ul class="offer-list">

                    <li>🚀 Tête des résultats</li>
                    <li>🔥 Forte visibilité</li>
                    <li>📅 Pendant 7 jours</li>

                </ul>

                <a href="#" class="offer-button">
                    Acheter
                </a>

            </div>

        </div>

    @endif

</div>

</x-app-layout>