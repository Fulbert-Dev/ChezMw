<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <x-pwa-head />

    <title>Mes favoris - CHEZMW</title>

    <link
        rel="icon"
        type="image/png"
        href="{{ asset('images/logo-chezmoi.svg') }}"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
    >


<x-app-sidebar />

<style>

/* =====================================================
   GLOBAL
===================================================== */

* {
    box-sizing: border-box;
}

body {
    margin: 0;

    min-height: 100vh;

    font-family:
        Arial,
        sans-serif;

    background:
        radial-gradient(
            circle at 10% 15%,
            rgba(13,110,253,.10),
            transparent 30%
        ),
        radial-gradient(
            circle at 90% 85%,
            rgba(25,135,84,.10),
            transparent 30%
        ),
        linear-gradient(
            135deg,
            #f0f8ff,
            #f0fff6
        );

    color: #212529;
}


/* =====================================================
   PAGE
===================================================== */

.favorites-page {
    min-height: 100vh;

    padding:
        35px 20px;
}

.favorites-container {
    max-width: 1200px;

    margin: auto;
}


/* =====================================================
   HEADER
===================================================== */

.favorites-header {
    position: relative;

    overflow: hidden;

    padding:
        30px 32px;

    margin-bottom: 25px;

    border-radius: 25px;

    color: white;

    background:
        linear-gradient(
            135deg,
            #0d6efd,
            #198754
        );

    box-shadow:
        0 18px 45px
        rgba(13,110,253,.20);

    animation:
        slideDown .7s ease;
}

.favorites-header::before {
    content: "";

    position: absolute;

    width: 260px;
    height: 260px;

    border-radius: 50%;

    right: -80px;
    top: -140px;

    background:
        rgba(255,255,255,.08);

    animation:
        floating 6s ease-in-out infinite;
}

.favorites-header::after {
    content: "";

    position: absolute;

    width: 160px;
    height: 160px;

    border-radius: 50%;

    left: 40%;
    bottom: -120px;

    background:
        rgba(255,255,255,.06);
}

.header-content {
    position: relative;

    z-index: 2;

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 20px;
}


/* =====================================================
   TITRE
===================================================== */

.header-left {
    display: flex;

    align-items: center;

    gap: 16px;
}

.header-icon {
    width: 60px;
    height: 60px;

    flex-shrink: 0;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 18px;

    background:
        rgba(255,255,255,.16);

    backdrop-filter:
        blur(5px);

    font-size: 27px;
}

.header-title {
    margin: 0;

    font-size: 28px;

    font-weight: 800;
}

.header-subtitle {
    margin:
        6px 0 0;

    font-size: 14px;

    opacity: .9;
}


/* =====================================================
   BOUTON RECHERCHER
===================================================== */

.search-button {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    gap: 8px;

    padding:
        12px 18px;

    border-radius: 13px;

    background: white;

    color: #0d6efd;

    text-decoration: none;

    font-size: 14px;

    font-weight: 700;

    white-space: nowrap;

    transition: .3s;
}

.search-button:hover {
    color: #198754;

    transform:
        translateY(-3px);

    box-shadow:
        0 10px 25px
        rgba(0,0,0,.15);
}


/* =====================================================
   SUCCESS
===================================================== */

.success-message {
    display: flex;

    align-items: center;

    gap: 12px;

    margin-bottom: 22px;

    padding:
        16px 20px;

    border-radius: 16px;

    border:
        1px solid #b7e4c7;

    background:
        linear-gradient(
            135deg,
            #f0fff6,
            #e9f8f1
        );

    color: #198754;

    font-size: 14px;

    font-weight: 700;

    box-shadow:
        0 8px 20px
        rgba(25,135,84,.06);

    animation:
        slideUp .5s ease;
}

.success-icon {
    width: 35px;
    height: 35px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 10px;

    background: #198754;

    color: white;
}


/* =====================================================
   GRID
===================================================== */

.favorites-grid {
    display: grid;

    grid-template-columns:
        repeat(3, 1fr);

    gap: 22px;
}


/* =====================================================
   CARD
===================================================== */

.favorite-card {
    position: relative;

    overflow: hidden;

    display: flex;

    flex-direction: column;

    background:
        rgba(255,255,255,.96);

    border-radius: 22px;

    border:
        1px solid
        rgba(0,0,0,.04);

    box-shadow:
        0 10px 30px
        rgba(0,0,0,.06);

    transition:
        transform .3s,
        box-shadow .3s;

    animation:
        slideUp .7s ease both;
}

.favorite-card:hover {
    transform:
        translateY(-7px);

    box-shadow:
        0 20px 45px
        rgba(13,110,253,.12);
}


/* =====================================================
   IMAGE
===================================================== */

.favorite-image-wrapper {
    position: relative;

    height: 220px;

    overflow: hidden;

    background:
        linear-gradient(
            135deg,
            #e8f1ff,
            #e9f8f1
        );
}

.favorite-image {
    width: 100%;
    height: 100%;

    object-fit: cover;

    transition:
        transform .5s ease;
}

.favorite-card:hover
.favorite-image {
    transform:
        scale(1.06);
}


/* =====================================================
   FAVORI BADGE
===================================================== */

.favorite-badge {
    position: absolute;

    top: 15px;
    right: 15px;

    width: 42px;
    height: 42px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 13px;

    background:
        rgba(255,255,255,.94);

    color: #dc3545;

    font-size: 19px;

    box-shadow:
        0 7px 18px
        rgba(0,0,0,.12);

    backdrop-filter:
        blur(5px);
}


/* =====================================================
   IMAGE VIDE
===================================================== */

.no-photo {
    height: 220px;

    display: flex;

    align-items: center;
    justify-content: center;

    background:
        linear-gradient(
            135deg,
            #edf5ff,
            #ecfff5
        );
}

.no-photo i {
    font-size: 55px;

    color: #0d6efd;

    opacity: .65;
}


/* =====================================================
   CARD BODY
===================================================== */

.favorite-body {
    display: flex;

    flex-direction: column;

    flex: 1;

    padding:
        22px;
}

.favorite-title {
    margin: 0;

    color: #212529;

    font-size: 18px;

    font-weight: 800;

    line-height: 1.3;

    display: -webkit-box;

    -webkit-line-clamp: 2;

    -webkit-box-orient: vertical;

    overflow: hidden;
}


/* =====================================================
   LOCALISATION
===================================================== */

.favorite-location {
    display: flex;

    align-items: center;

    gap: 7px;

    margin-top: 9px;

    color: #6c757d;

    font-size: 13px;

    line-height: 1.4;
}

.favorite-location i {
    color: #198754;

    font-size: 16px;
}


/* =====================================================
   PRIX
===================================================== */

.favorite-price {
    margin-top: 15px;

    color: #198754;

    font-size: 21px;

    font-weight: 800;
}

.favorite-price span {
    color: #6c757d;

    font-size: 12px;

    font-weight: 600;
}


/* =====================================================
   ACTIONS
===================================================== */

.favorite-actions {
    display: flex;

    gap: 10px;

    margin-top: auto;

    padding-top: 18px;
}

.view-button {
    flex: 1;

    display: inline-flex;

    align-items: center;
    justify-content: center;

    gap: 7px;

    min-height: 43px;

    border-radius: 11px;

    color: white;

    background:
        linear-gradient(
            135deg,
            #0d6efd,
            #198754
        );

    text-decoration: none;

    font-size: 13px;

    font-weight: 700;

    transition: .3s;
}

.view-button:hover {
    color: white;

    transform:
        translateY(-2px);

    box-shadow:
        0 8px 18px
        rgba(13,110,253,.20);
}

.delete-button {
    width: 45px;

    height: 43px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 11px;

    border:
        1px solid
        rgba(220,53,69,.2);

    background:
        #fff5f5;

    color: #dc3545;

    transition: .3s;
}

.delete-button:hover {
    color: white;

    background: #dc3545;

    transform:
        translateY(-2px);

    box-shadow:
        0 8px 18px
        rgba(220,53,69,.18);
}


/* =====================================================
   EMPTY STATE
===================================================== */

.empty-card {
    padding:
        70px 25px;

    text-align: center;

    background:
        rgba(255,255,255,.96);

    border-radius: 25px;

    box-shadow:
        0 12px 35px
        rgba(0,0,0,.06);

    border:
        1px solid
        rgba(0,0,0,.04);

    animation:
        slideUp .7s ease;
}

.empty-icon {
    width: 90px;
    height: 90px;

    margin: auto;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 28px;

    background:
        linear-gradient(
            135deg,
            #edf5ff,
            #ecfff5
        );

    color: #adb5bd;

    font-size: 42px;
}

.empty-title {
    margin-top: 20px;

    color: #212529;

    font-size: 22px;

    font-weight: 800;
}

.empty-text {
    margin-top: 8px;

    color: #6c757d;

    font-size: 14px;
}

.empty-button {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    gap: 8px;

    margin-top: 20px;

    padding:
        12px 20px;

    border-radius: 12px;

    color: white;

    background:
        linear-gradient(
            135deg,
            #0d6efd,
            #198754
        );

    text-decoration: none;

    font-size: 14px;

    font-weight: 700;

    transition: .3s;
}

.empty-button:hover {
    color: white;

    transform:
        translateY(-3px);

    box-shadow:
        0 10px 25px
        rgba(13,110,253,.20);
}


/* =====================================================
   PAGINATION
===================================================== */

.pagination-wrapper {
    margin-top: 30px;

    display: flex;

    justify-content: center;
}

.pagination-wrapper nav {
    display: inline-flex;
}


/* =====================================================
   RESPONSIVE
===================================================== */

@media(max-width: 1000px) {

    .favorites-grid {
        grid-template-columns:
            repeat(2, 1fr);
    }
}


@media(max-width: 700px) {

    .favorites-page {
        padding:
            20px 14px;
    }

    .favorites-header {
        padding:
            23px 20px;
    }

    .header-content {
        flex-direction: column;

        align-items: stretch;
    }

    .search-button {
        width: 100%;
    }

    .favorites-grid {
        grid-template-columns: 1fr;
    }
}


@media(max-width: 500px) {

    .header-left {
        align-items: flex-start;
    }

    .header-icon {
        width: 50px;
        height: 50px;

        font-size: 23px;
    }

    .header-title {
        font-size: 22px;
    }

    .header-subtitle {
        font-size: 13px;
    }

    .favorite-image-wrapper,
    .no-photo {
        height: 210px;
    }

    .favorite-body {
        padding:
            20px;
    }
}


/* =====================================================
   ANIMATIONS
===================================================== */

@keyframes slideDown {

    from {
        opacity: 0;

        transform:
            translateY(-25px);
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


@keyframes floating {

    0%,
    100% {
        transform:
            translateY(0);
    }

    50% {
        transform:
            translateY(22px);
    }
}


@media(prefers-reduced-motion: reduce) {

    *,
    *::before,
    *::after {
        animation-duration:
            .01ms !important;

        animation-iteration-count:
            1 !important;

        transition-duration:
            .01ms !important;
    }
}

</style>

</head>


<body>


<div class="favorites-page">

    <div class="favorites-container">


        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <div class="favorites-header">

            <div class="header-content">

                <div class="header-left">

                    <div class="header-icon">

                        <i class="bi bi-heart-fill"></i>

                    </div>

                    <div>

                        <h1 class="header-title">
                            Mes favoris
                        </h1>

                        <p class="header-subtitle">
                            Les logements que vous avez sauvegardés.
                        </p>

                    </div>

                </div>


                <a
                    href="{{ route('locataire.dashboard') }}"
                    class="search-button"
                >

                     ← Tableau de bord

                </a>

            </div>

        </div>


        {{-- =====================================================
             SUCCESS
        ====================================================== --}}

        @if(session('success'))

            <div class="success-message">

                <div class="success-icon">
                    ✓
                </div>

                <span>
                    {{ session('success') }}
                </span>

            </div>

        @endif


        {{-- =====================================================
             FAVORIS
        ====================================================== --}}

        @if($favoris->count())


            <div class="favorites-grid">


                @foreach($favoris as $favori)


                    @php

                        $logement =
                            $favori->logement;

                        $photo =
                            $logement->photos
                                ->where('principale', true)
                                ->first()
                                ?? $logement->photos->first();

                    @endphp


                    <div class="favorite-card">


                        {{-- =================================================
                             IMAGE
                        ================================================== --}}

                        @if($photo)

                            <div class="favorite-image-wrapper">

                                <img
                                    src="{{ asset(
                                        'storage/' . $photo->chemin
                                    ) }}"
                                    class="favorite-image"
                                    alt="{{ $logement->titre }}"
                                >


                                <div class="favorite-badge">

                                    <i class="bi bi-heart-fill"></i>

                                </div>

                            </div>

                        @else

                            <div class="no-photo">

                                <i class="bi bi-house-door"></i>

                            </div>

                        @endif


                        {{-- =================================================
                             BODY
                        ================================================== --}}

                        <div class="favorite-body">


                            <h5 class="favorite-title">

                                {{ $logement->titre }}

                            </h5>


                            <div class="favorite-location">

                                <i class="bi bi-geo-alt-fill"></i>

                                <span>

                                    {{ $logement->quartier }},
                                    {{ $logement->ville }}

                                </span>

                            </div>


                            <div class="favorite-price">

                                {{ number_format(
                                    $logement->prix,
                                    0,
                                    ',',
                                    ' '
                                ) }}

                                FCFA

                                <span>
                                    / mois
                                </span>

                            </div>


                            {{-- ACTIONS --}}

                            <div class="favorite-actions">


                                <a
                                    href="{{ route(
                                        'locataire.logements.show',
                                        $logement
                                    ) }}"
                                    class="view-button"
                                >

                                    <i class="bi bi-eye"></i>

                                    Voir le logement

                                </a>


                                <form
                                    method="POST"
                                    action="{{ route(
                                        'favoris.destroy',
                                        $logement
                                    ) }}"
                                >

                                    @csrf

                                    @method('DELETE')


                                    <button
                                        type="submit"
                                        class="delete-button"
                                        title="Retirer des favoris"
                                    >

                                        <i class="bi bi-heart-fill"></i>

                                    </button>

                                </form>


                            </div>


                        </div>

                    </div>


                @endforeach


            </div>


            {{-- =================================================
                 PAGINATION
            ================================================== --}}

            <div class="pagination-wrapper">

                {{ $favoris->links() }}

            </div>


        @else


            {{-- =================================================
                 EMPTY
            ================================================== --}}

            <div class="empty-card">

                <div class="empty-icon">

                    <i class="bi bi-heart"></i>

                </div>


                <h4 class="empty-title">

                    Aucun favori

                </h4>


                <p class="empty-text">

                    Vous n'avez pas encore enregistré de logement.

                </p>


                <a
                    href="{{ route(
                        'locataire.logements.index'
                    ) }}"
                    class="empty-button"
                >

                    <i class="bi bi-search"></i>

                    Trouver un logement

                </a>

            </div>


        @endif


    </div>

</div>


</body>

</html>
