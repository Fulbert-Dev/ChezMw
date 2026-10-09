<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-pwa-head />

    <title>Rechercher un logement - CHEZMW</title>
    <title>CHEZMW - Trouvez votre chez-vous</title>
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

    <style>

        body {
            background: #f5f8fc;
            color: #212529;
        }

        /* ===============================
           HEADER
        =============================== */

        .search-header {
            background: linear-gradient(
                135deg,
                #0d6efd,
                #198754
            );

            color: white;
            padding: 55px 20px 75px;
        }

        .search-header h1 {
            font-size: 38px;
        }

        /* ===============================
           SEARCH BOX
        =============================== */

        .search-box {
            max-width: 1100px;
            margin: -35px auto 45px;
            background: white;
            padding: 28px;
            border-radius: 20px;

            box-shadow:
                0 10px 35px rgba(0, 0, 0, .08);
        }

        .form-control,
        .form-select {
            min-height: 48px;
            border-radius: 10px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #0d6efd;

            box-shadow:
                0 0 0 .2rem rgba(13, 110, 253, .12);
        }

        /* ===============================
           PROPERTY CARD
        =============================== */

        .property-card {
            background: white;
            border: none;
            border-radius: 18px;
            overflow: hidden;
            height: 100%;
            position: relative;

            box-shadow:
                0 5px 20px rgba(0, 0, 0, .06);

            transition:
                transform .25s ease,
                box-shadow .25s ease;
        }

        .property-card:hover {
            transform: translateY(-6px);

            box-shadow:
                0 15px 35px rgba(0, 0, 0, .12);
        }

        /* ===============================
           VISIBILITY
        =============================== */

        .property-card.featured {
            border: 2px solid #ffc107;

            box-shadow:
                0 8px 30px rgba(255, 193, 7, .18);
        }

        .property-card.top-result {
            border: 2px solid #198754;

            box-shadow:
                0 8px 30px rgba(25, 135, 84, .18);
        }

        .visibility-badge {
            position: absolute;

            top: 12px;
            left: 12px;

            z-index: 5;

            padding: 8px 13px;

            border-radius: 50px;

            font-size: 11px;

            font-weight: 800;

            box-shadow:
                0 4px 12px rgba(0, 0, 0, .15);
        }

        .badge-top {
            background: #198754;
            color: white;
        }

        .badge-featured {
            background: #ffc107;
            color: #212529;
        }

        .badge-premium {
            background: #0d6efd;
            color: white;
        }

        /* ===============================
           IMAGE
        =============================== */

        .property-image {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .no-image {
            height: 220px;

            background: linear-gradient(
                135deg,
                #eef5ff,
                #e8f7ef
            );

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 55px;

            color: #0d6efd;
        }

        /* ===============================
           CONTENT
        =============================== */

        .property-body {
            padding: 20px;
        }

        .property-title {
            font-size: 18px;
            font-weight: 800;

            margin-bottom: 8px;
        }

        .location {
            color: #6c757d;
            font-size: 14px;
        }

        .price {
            color: #198754;
            font-weight: 800;
            font-size: 20px;
        }

        .sponsored-text {
            margin-top: 8px;

            font-size: 12px;

            color: #6c757d;
        }

        /* ===============================
           RESULT TITLE
        =============================== */

        .result-title {
            font-size: 24px;
            font-weight: 800;
        }

        /* ===============================
           EMPTY
        =============================== */

        .empty-state {
            background: white;
            border-radius: 18px;
            padding: 60px 20px;

            box-shadow:
                0 5px 20px rgba(0, 0, 0, .05);
        }

        /* ===============================
           RESPONSIVE
        =============================== */

        @media(max-width: 768px) {

            .search-header {
                padding: 40px 15px 65px;
            }

            .search-header h1 {
                font-size: 28px;
            }

            .search-box {
                margin-top: -30px;
                padding: 20px;
            }

            .property-image,
            .no-image {
                height: 210px;
            }

        }

        /* ===============================
           PAGINATION
        =============================== */
        
        .pagination-container {
            margin-bottom: 40px;
        }
        
        .pagination-container .pagination {
            gap: 6px;
            margin: 0;
        }
        
        .pagination-container .page-link {
            border: none;
            border-radius: 10px !important;
        
            min-width: 42px;
            height: 42px;
        
            display: flex;
            align-items: center;
            justify-content: center;
        
            color: #0d6efd;
        
            background: white;
        
            font-weight: 700;
        
            box-shadow:
                0 4px 12px rgba(0, 0, 0, .06);
        
            transition: .25s ease;
        }
        
        .pagination-container .page-link:hover {
            color: white;
            background: linear-gradient(
                135deg,
                #0d6efd,
                #198754
            );
        
            transform: translateY(-2px);
        }
        
        .pagination-container .page-item.active .page-link {
            color: white;
        
            background:
                linear-gradient(
                    135deg,
                    #0d6efd,
                    #198754
                );
        
            box-shadow:
                0 6px 16px
                rgba(13, 110, 253, .20);
        }
        
        .pagination-container .page-item.disabled .page-link {
            color: #adb5bd;
            background: #f1f3f5;
        
            box-shadow: none;
        }
        
        @media(max-width: 500px) {
        
            .pagination-container .page-link {
                min-width: 36px;
                height: 36px;
        
                font-size: 13px;
            }
        
            .pagination-container .pagination {
                gap: 3px;
            }
        }

    </style>

</head>


<body>

<x-app-sidebar />


<!-- =====================================================
     HEADER
===================================================== -->

<div class="search-header text-center">

    <h1 class="fw-bold mb-3">

        <i class="bi bi-search me-2"></i>

        Trouver votre logement

    </h1>

    <p class="mb-0">

        Trouvez facilement votre futur logement avec CHEZMW.

    </p>
    
</div>



<div class="container">


    <!-- =====================================================
         FORMULAIRE DE RECHERCHE
    ===================================================== -->

    <div class="search-box">

        <form
            method="GET"
            action="{{ route('locataire.logements.index') }}"
        >

            <div class="row g-3">


                <!-- RECHERCHE -->

                <div class="col-md-6">

                    <label class="form-label fw-bold">

                        Recherche

                    </label>

                    <input
                        type="text"
                        name="q"
                        class="form-control"
                        placeholder="Ex : chambre à Adidogomé"
                        value="{{ request('q') }}"
                    >

                </div>


                <!-- TYPE -->

                <div class="col-md-3">

                    <label class="form-label fw-bold">

                        Type de logement

                    </label>

                    <select
                        name="type_logement"
                        class="form-select"
                    >

                        <option value="">
                            Tous les types
                        </option>

                        <option value="appartement"
                            {{ request('type_logement') === 'appartement' ? 'selected' : '' }}>
                            Appartement
                        </option>

                        <option value="maison"
                            {{ request('type_logement') === 'maison' ? 'selected' : '' }}>
                            Maison
                        </option>

                        <option value="villa"
                            {{ request('type_logement') === 'villa' ? 'selected' : '' }}>
                            Villa
                        </option>

                        <option value="studio"
                            {{ request('type_logement') === 'studio' ? 'selected' : '' }}>
                            Studio
                        </option>

                        <option value="chambre"
                            {{ request('type_logement') === 'chambre' ? 'selected' : '' }}>
                            Chambre
                        </option>

                        <option value="chambre_salon"
                            {{ request('type_logement') === 'chambre_salon' ? 'selected' : '' }}>
                            Chambre-salon
                        </option>

                    </select>

                </div>


                <!-- TRI -->

                <div class="col-md-3">

                    <label class="form-label fw-bold">

                        Trier par

                    </label>

                    <select name="tri" class="form-select">
                        <option value="pertinence" {{ request('tri', 'pertinence') === 'pertinence' ? 'selected' : '' }}>Annonces mises en avant</option>
                        <option value="plus_recent" {{ request('tri') === 'plus_recent' ? 'selected' : '' }}>Plus récentes</option>
                        <option value="prix_croissant" {{ request('tri') === 'prix_croissant' ? 'selected' : '' }}>Prix croissant</option>
                        <option value="prix_decroissant" {{ request('tri') === 'prix_decroissant' ? 'selected' : '' }}>Prix décroissant</option>
                    </select>

                </div>


                <!-- VILLE -->

                <div class="col-md-3">

                    <label class="form-label fw-bold">

                        Ville

                    </label>

                    <input
                        type="text"
                        name="ville"
                        class="form-control"
                        placeholder="Ex : Lomé"
                        value="{{ request('ville') }}"
                    >

                </div>


                <!-- QUARTIER -->

                <div class="col-md-3">

                    <label class="form-label fw-bold">

                        Quartier

                    </label>

                    <input
                        type="text"
                        name="quartier"
                        class="form-control"
                        placeholder="Ex : Adidogomé"
                        value="{{ request('quartier') }}"
                    >

                </div>


                <!-- PRIX MINIMUM -->

                <div class="col-md-3">

                    <label class="form-label fw-bold">

                        Budget minimum

                    </label>

                    <input
                        type="number"
                        name="prix_min"
                        min="0"
                        step="1000"
                        class="form-control"
                        placeholder="Ex : 50000"
                        value="{{ request('prix_min') }}"
                    >

                </div>


                <!-- PRIX MAXIMUM -->

                <div class="col-md-3">

                    <label class="form-label fw-bold">

                        Prix maximum

                    </label>

                    <input
                        type="number"
                        name="prix_max"
                        min="0"
                        step="1000"
                        class="form-control"
                        placeholder="Ex : 150000"
                        value="{{ request('prix_max') }}"
                    >

                </div>


                <!-- CHAMBRES -->

                <div class="col-md-3">

                    <label class="form-label fw-bold">

                        Chambres minimum

                    </label>

                    <select name="nombre_chambres_min" class="form-select">

                        <option value="">Indifférent</option>

                        @foreach(range(0, 5) as $nombre)
                            <option value="{{ $nombre }}" {{ request('nombre_chambres_min') !== null && (int) request('nombre_chambres_min') === $nombre ? 'selected' : '' }}>
                                {{ $nombre === 0 ? 'Studio / sans chambre' : $nombre . ' chambre' . ($nombre > 1 ? 's' : '') . ' +' }}
                            </option>
                        @endforeach

                    </select>

                </div>


                <!-- SALLES DE BAIN -->

                <div class="col-md-3">

                    <label class="form-label fw-bold">

                        Salles de bain minimum

                    </label>

                    <select name="nombre_salles_bain_min" class="form-select">

                        <option value="">Indifférent</option>

                        @foreach(range(0, 4) as $nombre)
                            <option value="{{ $nombre }}" {{ request('nombre_salles_bain_min') !== null && (int) request('nombre_salles_bain_min') === $nombre ? 'selected' : '' }}>
                                {{ $nombre }} +
                            </option>
                        @endforeach

                    </select>

                </div>

                <!-- OPTIONS -->

                <div class="col-md-6">

                    <label class="form-label fw-bold">

                        Options

                    </label>

                    <div class="d-flex gap-4 flex-wrap">


                        <div class="form-check">

                            <input
                                type="checkbox"
                                name="wc_douche_interne"
                                value="1"
                                class="form-check-input"
                                id="wc"

                                {{ request()->has('wc_douche_interne') ? 'checked' : '' }}
                            >

                            <label
                                class="form-check-label"
                                for="wc"
                            >

                                WC / douche interne

                            </label>

                        </div>


                        <div class="form-check">

                            <input
                                type="checkbox"
                                name="cuisine"
                                value="1"
                                class="form-check-input"
                                id="cuisine"

                                {{ request()->has('cuisine') ? 'checked' : '' }}
                            >

                            <label
                                class="form-check-label"
                                for="cuisine"
                            >

                                Cuisine

                            </label>

                        </div>

                    </div>

                </div>


                <!-- BOUTON -->

                <div class="col-12 d-flex flex-wrap gap-2">

                    <button
                        type="submit"
                        class="btn btn-primary flex-grow-1 py-3"
                    >

                        <i class="bi bi-search me-2"></i>

                        Rechercher

                    </button>

                    @if(request()->query())
                        <a href="{{ route('locataire.logements.index') }}" class="btn btn-outline-secondary py-3">
                            Réinitialiser
                        </a>
                    @endif

                </div>

            </div>

        </form>

        @if($errors->any())
            <div class="alert alert-danger mt-3 mb-0" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>
                Vérifiez vos critères : le budget maximum doit être supérieur ou égal au budget minimum.
            </div>
        @endif

    </div>



    <!-- =====================================================
         RÉSULTATS
    ===================================================== -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h4 class="result-title mb-0">

            Logements disponibles

        </h4>

        <span class="text-muted">

            {{ $logements->total() }} résultat(s)

        </span>

    </div>



    @if($logements->count() > 0)


        <div class="row g-4">


            @foreach($logements as $logement)


                @php

                    /*
                    |--------------------------------------------------------------------------
                    | PHOTO PRINCIPALE
                    |--------------------------------------------------------------------------
                    */

                    $photo = $logement->photos
                        ->where('principale', true)
                        ->first()
                        ?? $logement->photos->first();


                    /*
                    |--------------------------------------------------------------------------
                    | VISIBILITÉ
                    |--------------------------------------------------------------------------
                    */

                    $visibiliteActive =
                        $logement->niveau_visibilite > 0
                        &&
                        (
                            !$logement->date_debut_visibilite
                            ||
                            $logement->date_debut_visibilite <= now()
                        )
                        &&
                        (
                            !$logement->date_fin_visibilite
                            ||
                            $logement->date_fin_visibilite >= now()
                        );


                    /*
                    |--------------------------------------------------------------------------
                    | STYLE CARTE
                    |--------------------------------------------------------------------------
                    */

                    $cardClass = '';

                    if (
                        $visibiliteActive
                        &&
                        $logement->niveau_visibilite >= 3
                    ) {

                        $cardClass = 'top-result';

                    } elseif (
                        $visibiliteActive
                        &&
                        $logement->niveau_visibilite == 2
                    ) {

                        $cardClass = 'featured';

                    }

                @endphp



                <div class="col-md-6 col-lg-4">


                    <div class="property-card {{ $cardClass }}">


                        <!-- BADGE -->

                        @if($visibiliteActive)

                            @if($logement->niveau_visibilite >= 3)

                                <div class="visibility-badge badge-top">

                                    🚀 TÊTE DES RÉSULTATS

                                </div>

                            @elseif($logement->niveau_visibilite == 2)

                                <div class="visibility-badge badge-featured">

                                    🔥 MISE EN AVANT

                                </div>

                            @elseif($logement->niveau_visibilite == 1)

                                <div class="visibility-badge badge-premium">

                                    ⭐ PREMIUM

                                </div>

                            @endif

                        @endif



                        <!-- IMAGE -->

                        @if($photo)

                            <img
                                src="{{ asset('storage/' . $photo->chemin) }}"
                                class="property-image"
                                alt="{{ $logement->titre }}"
                            >

                        @else

                            <div class="no-image">

                                <i class="bi bi-house-door"></i>

                            </div>

                        @endif



                        <!-- INFORMATIONS -->

                        <div class="property-body">


                            <h5 class="property-title">

                                {{ $logement->titre }}

                            </h5>


                            <div class="location mb-2">

                                <i class="bi bi-geo-alt-fill me-1"></i>

                                {{ $logement->quartier }},
                                {{ $logement->ville }}

                            </div>


                            <span class="badge bg-light text-dark">

                                {{ str_replace(
                                    '_',
                                    '-',
                                    ucfirst($logement->type_logement)
                                ) }}

                            </span>


                            <div class="price mt-3">

                                {{ number_format(
                                    $logement->prix,
                                    0,
                                    ',',
                                    ' '
                                ) }}

                                FCFA / mois

                            </div>


                            @if($visibiliteActive)

                                <div class="sponsored-text">

                                    <i class="bi bi-stars me-1"></i>

                                    Annonce sponsorisée

                                </div>

                            @endif


                            <a
                                href="{{ route(
                                    'locataire.logements.show',
                                    $logement
                                ) }}"
                                class="btn btn-outline-primary w-100 mt-3"
                            >

                                <i class="bi bi-eye me-1"></i>

                                Voir le logement

                            </a>


                        </div>

                    </div>

                </div>


            @endforeach


        </div>



        <!-- =====================================================
             PAGINATION
        ===================================================== -->

        <div class="pagination-container mt-5 d-flex justify-content-center">

            {{ $logements->onEachSide(1)->links('pagination::bootstrap-5') }}
        
        </div>


    @else


        <!-- =====================================================
             AUCUN RÉSULTAT
        ===================================================== -->

        <div class="empty-state text-center mb-5">

            <i class="bi bi-house-x fs-1 text-muted"></i>

            <h4 class="mt-3 fw-bold">

                Aucun logement trouvé

            </h4>

            <p class="text-muted">

                Essayez de modifier vos critères de recherche.

            </p>

        </div>


    @endif


</div>


</body>

</html>
