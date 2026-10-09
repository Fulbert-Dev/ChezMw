<x-app-layout>
    <x-app-sidebar />

    <style>

        * {
            box-sizing: border-box;
        }

        /* =====================================================
           PAGE
        ===================================================== */

        .locataire-page {

            min-height: calc(100vh - 65px);

            padding: 35px 20px;

            background:
                radial-gradient(
                    circle at 10% 20%,
                    rgba(13, 110, 253, .08),
                    transparent 30%
                ),
                radial-gradient(
                    circle at 90% 80%,
                    rgba(25, 135, 84, .08),
                    transparent 30%
                ),
                linear-gradient(
                    135deg,
                    #f0f8ff,
                    #f0fff6
                );

        }


        .locataire-container {

            max-width: 1400px;

            margin: auto;

        }


        /* =====================================================
           HEADER
        ===================================================== */

        .dashboard-header {

            background:
                linear-gradient(
                    135deg,
                    #0d6efd,
                    #198754
                );

            border-radius: 25px;

            padding: 32px;

            color: white;

            box-shadow:
                0 18px 45px
                rgba(13, 110, 253, .20);

            position: relative;

            overflow: hidden;

            animation:
                slideDown .7s ease;

        }


        .dashboard-header::before {

            content: "";

            position: absolute;

            width: 280px;
            height: 280px;

            border-radius: 50%;

            background:
                rgba(255,255,255,.08);

            right: -90px;
            top: -140px;

        }


        .dashboard-header::after {

            content: "";

            position: absolute;

            width: 170px;
            height: 170px;

            border-radius: 50%;

            background:
                rgba(255,255,255,.06);

            left: 45%;
            bottom: -120px;

        }


        .dashboard-header h1 {

            font-size: 30px;

            font-weight: 800;

            margin: 0;

            position: relative;

            z-index: 2;

        }


        .dashboard-header p {

            margin: 8px 0 0;

            opacity: .9;

            position: relative;

            z-index: 2;

        }


        .status-badge {

            display: inline-flex;

            align-items: center;

            gap: 7px;

            margin-top: 16px;

            padding: 8px 15px;

            border-radius: 50px;

            background:
                rgba(255,255,255,.14);

            border:
                1px solid
                rgba(255,255,255,.25);

            font-size: 13px;

            position: relative;

            z-index: 2;

        }


        .search-btn {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 8px;

            background: white;

            color: #0d6efd;

            padding: 13px 20px;

            border-radius: 13px;

            text-decoration: none;

            font-weight: 700;

            transition: .3s;

            position: relative;

            z-index: 5;

        }


        .search-btn:hover {

            transform:
                translateY(-4px);

            color: #198754;

            box-shadow:
                0 12px 25px
                rgba(0,0,0,.18);

        }


        /* =====================================================
           LOGEMENTS À LA UNE
        ===================================================== */

        .featured-section {

            margin-top: 30px;

            padding: 28px;

            background:
                rgba(255,255,255,.95);

            border-radius: 25px;

            border:
                1px solid
                rgba(0,0,0,.04);

            box-shadow:
                0 10px 30px
                rgba(0,0,0,.06);

            animation:
                slideUp .8s ease;

        }


        .featured-header {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 20px;

            margin-bottom: 25px;

        }


        .featured-title-area {

            min-width: 0;

        }


        .featured-badge {

            display: inline-flex;

            align-items: center;

            gap: 5px;

            padding: 7px 12px;

            border-radius: 50px;

            background:
                linear-gradient(
                    135deg,
                    #fff3cd,
                    #ffe69c
                );

            color: #9a6700;

            font-size: 12px;

            font-weight: 800;

            margin-bottom: 10px;

        }


        .featured-header h2 {

            margin: 0;

            color: #212529;

            font-size: 24px;

            font-weight: 800;

        }


        .featured-header p {

            margin: 7px 0 0;

            color: #6c757d;

            font-size: 14px;

        }


        .featured-link {

            flex-shrink: 0;

            color: #0d6efd;

            text-decoration: none;

            font-size: 14px;

            font-weight: 700;

            transition: .3s;

        }


        .featured-link:hover {

            color: #198754;

        }


        /* =====================================================
           FEATURED GRID
        ===================================================== */

        .featured-grid {

            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 20px;

        }


        /* =====================================================
           FEATURED CARD
        ===================================================== */

        .featured-card {

            position: relative;

            background: white;

            border-radius: 19px;

            overflow: hidden;

            border:
                1px solid
                rgba(0,0,0,.06);

            box-shadow:
                0 7px 22px
                rgba(0,0,0,.07);

            transition:
                transform .3s,
                box-shadow .3s;

        }


        .featured-card:hover {

            transform:
                translateY(-7px);

            box-shadow:
                0 18px 38px
                rgba(0,0,0,.13);

        }


        /* =====================================================
           IMAGE
        ===================================================== */

        .featured-image {

            width: 100%;

            height: 210px;

            object-fit: cover;

            display: block;

            transition:
                transform .4s ease;

        }


        .featured-card:hover
        .featured-image {

            transform:
                scale(1.05);

        }


        .featured-image-wrapper {

            position: relative;

            height: 210px;

            overflow: hidden;

            background:
                linear-gradient(
                    135deg,
                    #edf5ff,
                    #ecfff5
                );

        }


        .featured-no-image {

            height: 210px;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 55px;

            background:
                linear-gradient(
                    135deg,
                    #edf5ff,
                    #ecfff5
                );

        }


        /* =====================================================
           LABEL VISIBILITÉ
        ===================================================== */

        .featured-visibility {

            position: absolute;

            left: 12px;

            top: 12px;

            z-index: 3;

            padding: 7px 11px;

            border-radius: 50px;

            color: white;

            font-size: 10px;

            font-weight: 800;

            letter-spacing: .2px;

            box-shadow:
                0 5px 15px
                rgba(0,0,0,.18);

        }


        .visibility-top {

            background:
                linear-gradient(
                    135deg,
                    #ff7a00,
                    #dc3545
                );

        }


        .visibility-boost {

            background:
                linear-gradient(
                    135deg,
                    #ffb000,
                    #ff7a00
                );

        }


        .visibility-premium {

            background:
                linear-gradient(
                    135deg,
                    #7b2cbf,
                    #5a189a
                );

        }


        /* =====================================================
           BODY CARD
        ===================================================== */

        .featured-body {

            padding: 18px;

        }


        .featured-body h3 {

            margin: 0;

            font-size: 17px;

            font-weight: 800;

            color: #212529;

            white-space: nowrap;

            overflow: hidden;

            text-overflow: ellipsis;

        }


        .featured-location {

            margin-top: 8px;

            color: #6c757d;

            font-size: 13px;

        }


        .featured-type {

            display: inline-block;

            margin-top: 10px;

            padding: 5px 10px;

            border-radius: 50px;

            background:
                rgba(13,110,253,.08);

            color: #0d6efd;

            font-size: 11px;

            font-weight: 700;

        }


        .featured-price {

            margin-top: 15px;

            color: #198754;

            font-size: 19px;

            font-weight: 800;

        }


        .featured-price small {

            font-size: 11px;

            color: #6c757d;

            font-weight: 500;

        }


        .featured-button {

            display: flex;

            align-items: center;

            justify-content: center;

            margin-top: 15px;

            padding: 10px;

            border-radius: 11px;

            color: white;

            text-decoration: none;

            font-size: 13px;

            font-weight: 700;

            background:
                linear-gradient(
                    135deg,
                    #0d6efd,
                    #198754
                );

            transition: .3s;

        }


        .featured-button:hover {

            color: white;

            transform:
                translateY(-2px);

            box-shadow:
                0 8px 18px
                rgba(13,110,253,.20);

        }


        /* =====================================================
           MENU
        ===================================================== */

        .dashboard-menu {

            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 20px;

            margin-top: 30px;

        }


        .dashboard-card {

            height: 100%;

            background: white;

            border-radius: 20px;

            padding: 28px;

            border:
                1px solid
                rgba(0,0,0,.04);

            box-shadow:
                0 8px 25px
                rgba(0,0,0,.06);

            text-decoration: none;

            color: #212529;

            display: block;

            transition:
                transform .3s,
                box-shadow .3s;

            animation:
                cardAnimation .8s ease;

        }

        .conversation-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 26px;
            height: 26px;
            margin-left: 8px;
            padding: 0 8px;
            border-radius: 999px;
            background: #dc3545;
            color: white;
            font-size: 12px;
            font-weight: 800;
        }

        .message-notifications {
            margin: 28px 0;
            padding: 22px;
            border: 1px solid #dbeafe;
            border-radius: 22px;
            background: #fff;
            box-shadow: 0 8px 25px rgba(13, 110, 253, .07);
        }

        .notification-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 0;
            color: #1f2937;
            text-decoration: none;
            border-top: 1px solid #eef2f7;
        }

        .notification-item:first-of-type { border-top: 0; }


        .dashboard-card:hover {

            transform:
                translateY(-8px);

            box-shadow:
                0 18px 40px
                rgba(0,0,0,.12);

            color: #212529;

        }


        /* =====================================================
           ICONES
        ===================================================== */

        .card-icon {

            width: 60px;

            height: 60px;

            border-radius: 18px;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 28px;

            margin-bottom: 20px;

        }


        .icon-blue {

            background:
                rgba(13,110,253,.10);

        }


        .icon-red {

            background:
                rgba(220,53,69,.10);

        }


        .icon-green {

            background:
                rgba(25,135,84,.10);

        }


        .dashboard-card h3 {

            font-size: 20px;

            font-weight: 800;

            margin-bottom: 10px;

        }


        .dashboard-card p {

            color: #6c757d;

            line-height: 1.6;

            margin: 0;

        }


        .coming-soon {

            display: inline-block;

            margin-top: 15px;

            font-size: 13px;

            color: #198754;

            background:
                rgba(25,135,84,.08);

            padding: 6px 12px;

            border-radius: 50px;

            font-weight: 600;

        }


        /* =====================================================
           ACTION RAPIDE
        ===================================================== */

        .quick-search {

            margin-top: 30px;

            padding: 35px;

            border-radius: 25px;

            color: white;

            background:
                linear-gradient(
                    135deg,
                    #0d6efd,
                    #198754
                );

            position: relative;

            overflow: hidden;

            box-shadow:
                0 15px 40px
                rgba(13,110,253,.20);

            animation:
                slideUp .8s ease;

        }


        .quick-search::before {

            content: "";

            position: absolute;

            width: 220px;

            height: 220px;

            border-radius: 50%;

            background:
                rgba(255,255,255,.08);

            right: -60px;

            bottom: -100px;

        }


        .quick-search h2 {

            font-weight: 800;

            font-size: 26px;

            position: relative;

            z-index: 2;

        }


        .quick-search p {

            opacity: .9;

            position: relative;

            z-index: 2;

        }


        .quick-search-btn {

            display: inline-flex;

            align-items: center;

            gap: 8px;

            margin-top: 15px;

            background: white;

            color: #0d6efd;

            padding: 12px 22px;

            border-radius: 12px;

            text-decoration: none;

            font-weight: 700;

            transition: .3s;

            position: relative;

            z-index: 2;

        }


        .quick-search-btn:hover {

            transform:
                translateY(-3px);

            color: #198754;

            box-shadow:
                0 10px 20px
                rgba(0,0,0,.15);

        }


        /* =====================================================
           ANIMATIONS
        ===================================================== */

        @keyframes slideDown {

            from {

                opacity: 0;

                transform:
                    translateY(-30px);

            }

            to {

                opacity: 1;

                transform:
                    translateY(0);

            }

        }


        @keyframes slideUp {

            from {

                opacity: 0;

                transform:
                    translateY(30px);

            }

            to {

                opacity: 1;

                transform:
                    translateY(0);

            }

        }


        @keyframes cardAnimation {

            from {

                opacity: 0;

                transform:
                    translateY(30px);

            }

            to {

                opacity: 1;

                transform:
                    translateY(0);

            }

        }


        /* =====================================================
           TABLETTE
        ===================================================== */

        @media(max-width: 1050px) {

            .featured-grid {

                grid-template-columns:
                    repeat(2, 1fr);

            }


            .dashboard-menu {

                grid-template-columns:
                    repeat(2, 1fr);

            }

        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media(max-width: 768px) {

            .locataire-page {

                padding:
                    22px 14px;

            }


            .dashboard-header {

                padding: 25px 20px;

            }


            .dashboard-header h1 {

                font-size: 24px;

            }


            .search-btn {

                margin-top: 20px;

                width: 100%;

            }


            .featured-section {

                padding: 20px;

            }


            .featured-header {

                flex-direction: column;

                align-items: flex-start;

            }


            .featured-grid {

                grid-template-columns: 1fr;

            }


            .dashboard-menu {

                grid-template-columns: 1fr;

            }


            .quick-search {

                padding: 25px 20px;

            }


            .quick-search h2 {

                font-size: 22px;

            }

        }


        /* =====================================================
           PETIT MOBILE
        ===================================================== */

        @media(max-width: 500px) {

            .featured-image-wrapper {

                height: 190px;

            }


            .featured-image {

                height: 190px;

            }


            .featured-no-image {

                height: 190px;

            }


            .featured-header h2 {

                font-size: 21px;

            }


            .dashboard-card {

                padding: 22px;

            }

        }


        /* =====================================================
           ACCESSIBILITÉ
        ===================================================== */

        @media(prefers-reduced-motion: reduce) {

            * {

                animation-duration:
                    .01ms !important;

                animation-iteration-count:
                    1 !important;

                transition-duration:
                    .01ms !important;

            }

        }

    </style>


    <!-- =====================================================
         PAGE
    ===================================================== -->

    <div class="locataire-page">

        <div class="locataire-container">


            <!-- =================================================
                 HEADER
            ================================================== -->

            <div class="dashboard-header">

                <div class="row align-items-center">

                    <div class="col-md-8">

                        <h1>

                            Bienvenue
                            {{ Auth::user()->name }} 👋

                        </h1>

                        <p>

                            Votre espace personnel CHEZMW.

                        </p>

                        <span class="status-badge">

                            🏠 Compte locataire

                        </span>

                    </div>
                    <br>


                    <div class="col-md-4 text-md-end">

                        <a
                            href="{{ route('locataire.logements.index') }}"
                            class="search-btn"
                        >

                            🔎

                            Rechercher un logement

                        </a>

                    </div>

                </div>

            </div>


            <!-- =================================================
                 LOGEMENTS À LA UNE
            ================================================== -->

            @if($logementsEnAvant->count())

                <div class="featured-section">

                    <div class="featured-header">

                        <div class="featured-title-area">

                            <span class="featured-badge">

                                ⭐ À LA UNE

                            </span>

                            <h2>

                                Logements mis en avant

                            </h2>

                            <p>

                                Découvrez les logements actuellement
                                mis en avant par nos bailleurs.

                            </p>

                        </div>


                        <a
                            href="{{ route('locataire.logements.index') }}"
                            class="featured-link"
                        >

                            Voir tous les logements →

                        </a>

                    </div>


                    <div class="featured-grid">

                        @foreach($logementsEnAvant as $logement)

                            @php

                                $photo = $logement->photos
                                    ->where('principale', true)
                                    ->first()
                                    ?? $logement->photos->first();

                            @endphp


                            <div class="featured-card">


                                <!-- IMAGE -->

                                <div class="featured-image-wrapper">

                                    @if($photo)

                                        <img
                                            src="{{ asset('storage/' . $photo->chemin) }}"
                                            alt="{{ $logement->titre }}"
                                            class="featured-image"
                                        >

                                    @else

                                        <div class="featured-no-image">

                                            🏠

                                        </div>

                                    @endif


                                    <!-- NIVEAU -->

                                    @if($logement->niveau_visibilite == 2)

                                        <span class="
                                            featured-visibility
                                            visibility-boost
                                        ">
                                    
                                            🚀 TÊTE DES RÉSULTATS
                                    
                                        </span>
                                    
                                    @elseif($logement->niveau_visibilite == 1)
                                    
                                        <span class="
                                            featured-visibility
                                            visibility-premium
                                        ">
                                    
                                            🔥 MISE EN AVANT
                                    
                                        </span>
                                    
                                    @endif

                                </div>


                                <!-- INFORMATIONS -->

                                <div class="featured-body">

                                    <h3>

                                        {{ $logement->titre }}

                                    </h3>


                                    <div class="featured-location">

                                        📍

                                        {{ $logement->quartier }},
                                        {{ $logement->ville }}

                                    </div>


                                    <span class="featured-type">

                                        {{ str_replace(
                                            '_',
                                            '-',
                                            ucfirst($logement->type_logement)
                                        ) }}

                                    </span>


                                    <div class="featured-price">

                                        {{ number_format(
                                            $logement->prix,
                                            0,
                                            ',',
                                            ' '
                                        ) }}

                                        <small>

                                            FCFA / mois

                                        </small>

                                    </div>


                                    <a
                                        href="{{ route(
                                            'locataire.logements.show',
                                            $logement
                                        ) }}"
                                        class="featured-button"
                                    >

                                        👁️ Voir le logement

                                    </a>

                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>

            @endif


            @if($messagesNonLus > 0)
                <section class="message-notifications" aria-label="Nouveaux messages">
                    <div class="d-flex align-items-center justify-content-between gap-3 mb-2">
                        <div>
                            <strong>💬 Nouveaux messages</strong>
                            <span class="conversation-badge">{{ $messagesNonLus }}</span>
                        </div>
                        <a href="{{ route('locataire.messages.index') }}" class="text-decoration-none fw-semibold">Voir tout →</a>
                    </div>

                    @foreach($dernieresNotifications as $notification)
                        <a href="{{ route('locataire.messages.show', $notification) }}#repondre" class="notification-item">
                            <span class="fs-4">✉️</span>
                            <span class="flex-grow-1">
                                <strong>{{ $notification->expediteur->name ?? 'Un bailleur' }}</strong>
                                <span class="d-block text-muted small">{{ $notification->logement?->titre ?? 'Logement' }} · {{ \Illuminate\Support\Str::limit($notification->contenu, 90) }}</span>
                            </span>
                            <span class="text-primary small fw-semibold">Répondre</span>
                        </a>
                    @endforeach
                </section>
            @endif

            <!-- =================================================
                 MENU PRINCIPAL
            ================================================== -->

            <div class="dashboard-menu">


                <!-- RECHERCHE -->

                <a
                    href="{{ route('locataire.logements.index') }}"
                    class="dashboard-card"
                >

                    <div class="card-icon icon-blue">

                        🔎

                    </div>


                    <h3>

                        Rechercher un logement

                    </h3>


                    <p>

                        Trouvez facilement un appartement,
                        une maison, une villa, un studio
                        ou une chambre.

                    </p>


                    <div class="mt-4">

                        <span class="
                            text-blue-600
                            font-semibold
                        ">

                            Commencer →

                        </span>

                    </div>

                </a>


                <!-- FAVORIS -->

                <a
                    href="{{ route('favoris.index') }}"
                    class="dashboard-card"
                >

                    <div class="card-icon icon-red">

                        ❤️

                    </div>


                    <h3>

                        Mes favoris

                    </h3>


                    <p>

                        Retrouvez tous les logements
                        que vous avez enregistrés.

                    </p>


                    <div class="mt-4">

                        <span class="
                            text-red-500
                            font-semibold
                        ">

                            Voir mes favoris →

                        </span>

                    </div>

                </a>


                <!-- CONVERSATIONS -->

                <a
                    href="{{ route('locataire.messages.index') }}"
                    class="dashboard-card"
                >

                    <div class="card-icon icon-green">

                        💬

                    </div>


                    <h3>

                        Mes conversations

                        @if($messagesNonLus > 0)
                            <span class="conversation-badge">{{ $messagesNonLus }}</span>
                        @endif

                    </h3>


                    <p>

                        @if($messagesNonLus > 0)
                            Vous avez {{ $messagesNonLus }} nouveau{{ $messagesNonLus > 1 ? 'x' : '' }} message{{ $messagesNonLus > 1 ? 's' : '' }} à lire.
                        @else
                            Contactez les bailleurs des logements qui vous intéressent.
                        @endif

                    </p>


                    <span class="coming-soon">

                        Voir mes conversations →

                    </span>

                </a>

            </div>


            <!-- =================================================
                 ACTION RAPIDE
            ================================================== -->

            <div class="quick-search">

                <h2>

                    Trouvez votre prochain logement 🏠

                </h2>


                <p>

                    Utilisez nos filtres pour trouver le logement
                    qui correspond à votre budget et à vos besoins.

                </p>


                <a
                    href="{{ route('locataire.logements.index') }}"
                    class="quick-search-btn"
                >

                    🔎

                    Commencer la recherche

                </a>

            </div>


        </div>

    </div>

</x-app-layout>
