<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <x-pwa-head />

    <title>{{ $logement->titre }} - CHEZMW</title>
    <title>CHEZMW - Trouvez votre chez-vous</title>
    <link
        rel="icon"
        type="image/png"
        href="{{ asset('images/logo-chezmoi.svg') }}"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>

        body {
            background: #f5f8fc;
            font-family: Arial, Helvetica, sans-serif;
        }

        .container-page {
            max-width: 1150px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .top-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 25px;
        }

        .back-link {
            color: #0d6efd;
            text-decoration: none;
            font-weight: 600;
        }

        .main-card {
            background: white;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 5px 25px rgba(0,0,0,.06);
        }

        .main-photo {
            width: 100%;
            height: 480px;
            object-fit: cover;
        }

        .no-photo {
            height: 480px;
            background: #eef5ff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #0d6efd;
            font-size: 80px;
        }

        .content {
            padding: 30px;
        }

        .title {
            font-size: 30px;
            font-weight: bold;
            color: #172033;
        }

        .location {
            color: #6c757d;
            margin-top: 8px;
        }

        .price {
            color: #198754;
            font-size: 26px;
            font-weight: bold;
        }

        .info-card {
            background: #f8fafc;
            border-radius: 12px;
            padding: 18px;
            height: 100%;
        }

        .info-icon {
            color: #0d6efd;
            font-size: 22px;
            margin-right: 8px;
        }

        .gallery img {
            width: 100%;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
            cursor: pointer;
        }

        .gallery img:hover {
            opacity: .8;
        }

        .description {
            line-height: 1.8;
            color: #555;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        @media(max-width: 768px) {

            .main-photo,
            .no-photo {
                height: 300px;
            }

            .title {
                font-size: 24px;
            }

            .content {
                padding: 20px;
            }

        }

        /* =========================================================
           SIDEBAR CHEZMOI
           ========================================================= */
        
        :root {
            --cm-blue: #0d6efd;
            --cm-green: #198754;
            --cm-sidebar: #101c2d;
        }
        
        /* =========================
           ESPACE POUR LA SIDEBAR
           ========================= */
        
        body {
            margin: 0;
            padding-left: 270px;
        }
        
        
        /* =========================
           SIDEBAR
           ========================= */
        
        .cm-sidebar {
            position: fixed;
            inset: 0 auto 0 0;
        
            width: 270px;
            padding: 24px 16px;
        
            background:
                radial-gradient(
                    circle at 20% 10%,
                    rgba(13, 110, 253, .28),
                    transparent 30%
                ),
                linear-gradient(
                    180deg,
                    #101c2d 0%,
                    #0b1523 100%
                );
        
            color: white;
        
            z-index: 2000;
        
            display: flex;
            flex-direction: column;
        
            box-shadow:
                8px 0 30px rgba(10, 25, 45, .12);
        }
        
        
        /* =========================
           LOGO CHEZMOI
           ========================= */
        
        .cm-brand {
            display: flex;
            align-items: center;
        
            gap: 12px;
        
            padding: 8px 10px 26px;
        
            color: white;
            text-decoration: none;
        }
        
        .cm-brand:hover {
            color: white;
        }
        
        .cm-brand-icon {
            width: 44px;
            height: 44px;
        
            border-radius: 14px;
        
            display: grid;
            place-items: center;
        
            background:
                linear-gradient(
                    135deg,
                    var(--cm-blue),
                    var(--cm-green)
                );
        
            box-shadow:
                0 8px 22px rgba(13, 110, 253, .25);
        
            font-size: 22px;
        }
        
        .cm-brand-text strong {
            display: block;
        
            font-size: 20px;
            font-weight: 800;
        
            letter-spacing: -.3px;
        }
        
        .cm-brand-text small {
            display: block;
        
            color: #9fb0c6;
        
            font-size: 11px;
        
            margin-top: 1px;
        }
        
        
        /* =========================
           TITRE NAVIGATION
           ========================= */
        
        .cm-nav-title {
            padding: 10px 12px 8px;
        
            color: #70839b;
        
            font-size: 10px;
            font-weight: 800;
        
            text-transform: uppercase;
        
            letter-spacing: 1.4px;
        }
        
        
        /* =========================
           MENU
           ========================= */
        
        .cm-nav {
            display: flex;
            flex-direction: column;
        
            gap: 7px;
        }
        
        .cm-nav a {
            display: flex;
            align-items: center;
        
            gap: 13px;
        
            padding: 12px 13px;
        
            border-radius: 13px;
        
            color: #cbd7e6;
        
            text-decoration: none;
        
            font-size: 14px;
            font-weight: 600;
        
            transition: .25s ease;
        }
        
        .cm-nav a i {
            width: 22px;
        
            text-align: center;
        
            font-size: 17px;
        }
        
        
        /* =========================
           HOVER + MENU ACTIF
           ========================= */
        
        .cm-nav a:hover,
        .cm-nav a.active {
            color: white;
        
            background:
                linear-gradient(
                    135deg,
                    rgba(13, 110, 253, .92),
                    rgba(25, 135, 84, .88)
                );
        
            transform: translateX(3px);
        
            box-shadow:
                0 8px 20px rgba(13, 110, 253, .16);
        }
        
        
        /* =========================
           PARTIE BASSE
           ========================= */
        
        .cm-sidebar-bottom {
            margin-top: auto;
        }
        
        
        /* =========================
           UTILISATEUR
           ========================= */
        
        .cm-user {
            display: flex;
            align-items: center;
        
            gap: 10px;
        
            padding: 12px;
        
            margin-bottom: 10px;
        
            border:
                1px solid
                rgba(255, 255, 255, .07);
        
            border-radius: 14px;
        
            background:
                rgba(255, 255, 255, .045);
        }
        
        .cm-user-avatar {
            width: 38px;
            height: 38px;
        
            flex-shrink: 0;
        
            border-radius: 12px;
        
            display: grid;
            place-items: center;
        
            background:
                linear-gradient(
                    135deg,
                    var(--cm-blue),
                    var(--cm-green)
                );
        }
        
        .cm-user-info {
            min-width: 0;
        }
        
        .cm-user-info strong,
        .cm-user-info span {
            display: block;
        
            overflow: hidden;
        
            text-overflow: ellipsis;
        
            white-space: nowrap;
        }
        
        .cm-user-info strong {
            font-size: 13px;
        }
        
        .cm-user-info span {
            color: #8fa2b9;
        
            font-size: 11px;
        
            margin-top: 2px;
        }
        
        
        /* =========================
           FOOTER
           ========================= */
        
        .cm-sidebar-footer {
            color: #687d95;
        
            font-size: 10px;
        
            text-align: center;
        
            padding-top: 8px;
        }
        
        
        /* =========================================================
           TABLETTE
           ========================================================= */
        
        @media (max-width: 900px) {
        
            body {
                padding-left: 86px;
            }
        
            .cm-sidebar {
                width: 86px;
        
                padding: 20px 10px;
            }
        
            .cm-brand {
                justify-content: center;
        
                padding-left: 0;
                padding-right: 0;
            }
        
            .cm-brand-text,
            .cm-nav-title,
            .cm-nav a span,
            .cm-user-info,
            .cm-sidebar-footer {
                display: none;
            }
        
            .cm-nav a {
                justify-content: center;
        
                padding: 13px 8px;
            }
        
            .cm-nav a i {
                margin: 0;
        
                font-size: 19px;
            }
        
            .cm-user {
                justify-content: center;
        
                padding: 8px;
            }
        }
        
        
        /* =========================================================
           MOBILE
           ========================================================= */
        
        @media (max-width: 576px) {
        
            body {
                padding-left: 0;
        
                padding-bottom: 74px;
            }
        
            .cm-sidebar {
        
                top: auto;
                bottom: 0;
        
                width: 100%;
                height: 68px;
        
                padding: 7px 8px;
        
                flex-direction: row;
        
                align-items: center;
                justify-content: center;
        
                box-shadow:
                    0 -8px 25px
                    rgba(10, 25, 45, .14);
            }
        
            .cm-brand,
            .cm-sidebar-bottom,
            .cm-nav-title {
                display: none;
            }
        
            .cm-nav {
                width: 100%;
        
                flex-direction: row;
        
                justify-content: space-around;
        
                gap: 3px;
            }
        
            .cm-nav a {
                flex: 1;
        
                max-width: 72px;
        
                justify-content: center;
        
                padding: 10px 5px;
            }
        
            .cm-nav a i {
                font-size: 19px;
            }
        }

        /* =========================================================
           BOUTON DECONNEXION
           ========================================================= */
        
        .cm-logout {
            width: 100%;
        
            display: flex;
            align-items: center;
        
            gap: 13px;
        
            padding: 12px 13px;
        
            margin-bottom: 12px;
        
            border: 1px solid rgba(220, 53, 69, .15);
        
            border-radius: 13px;
        
            background: rgba(220, 53, 69, .07);
        
            color: #ff8d9a;
        
            font-family: inherit;
        
            font-size: 14px;
        
            font-weight: 600;
        
            cursor: pointer;
        
            transition: .25s ease;
        }
        
        .cm-logout i {
            width: 22px;
        
            text-align: center;
        
            font-size: 17px;
        }
        
        .cm-logout:hover {
            color: white;
        
            background:
                linear-gradient(
                    135deg,
                    #dc3545,
                    #b02a37
                );
        
            border-color: transparent;
        
            transform: translateX(3px);
        
            box-shadow:
                0 8px 20px
                rgba(220, 53, 69, .20);
        }

    </style>

</head>

<body>

    <x-app-sidebar />

<div class="container-page">

    <!-- HEADER -->

    <div class="top-header">

        <a
            href="{{ route('bailleur.logements.index') }}"
            class="back-link"
        >

            <i class="bi bi-arrow-left me-1"></i>

            Retour à mes logements

        </a>


        <div class="action-buttons">

            <a
                href="{{ route('bailleur.visibilite.index', $logement) }}"
                class="btn btn-outline-primary"
            >
                🚀 Augmenter la visibilité
            </a>

            <a
                href="{{ route('bailleur.logements.edit', $logement) }}"
                class="btn btn-outline-success"
            >

                <i class="bi bi-pencil me-1"></i>

                Modifier

            </a>

            <form
                method="POST"
                action="{{ route('bailleur.logements.destroy', $logement) }}"
                onsubmit="return confirm('Voulez-vous vraiment supprimer ce logement ?');"
                class="d-inline"
            >
            
                @csrf
                @method('DELETE')
            
                <button
                    type="submit"
                    class="btn btn-outline-danger"
                >
            
                    <i class="bi bi-trash me-1"></i>
            
                    Supprimer
            
                </button>
            
            </form>

        </div>

    </div>


    <!-- LOGEMENT -->

    <div class="main-card">

        <!-- PHOTO PRINCIPALE -->

        @php

            $photoPrincipale = $logement->photos
                ->where('principale', true)
                ->first()
                ?? $logement->photos->first();

        @endphp


        @if($photoPrincipale)

            <img
                src="{{ asset('storage/' . $photoPrincipale->chemin) }}"
                alt="{{ $logement->titre }}"
                class="main-photo"
            >

        @else

            <div class="no-photo">

                <i class="bi bi-house-door"></i>

            </div>

        @endif


        <!-- CONTENU -->

        <div class="content">

            <div class="d-flex justify-content-between
                        align-items-start flex-wrap gap-3">

                <div>

                    <div class="title">

                        {{ $logement->titre }}

                    </div>

                    <div class="location">

                        <i class="bi bi-geo-alt me-1"></i>

                        {{ $logement->quartier }},
                        {{ $logement->ville }}

                        @if($logement->adresse)

                            — {{ $logement->adresse }}

                        @endif

                    </div>

                </div>


                <!-- STATUT -->

                <div>

                    @if($logement->statut === 'actif')

                        <span class="badge bg-success fs-6">
                            Actif
                        </span>

                    @elseif($logement->statut === 'loue')

                        <span class="badge bg-warning text-dark fs-6">
                            Loué
                        </span>

                    @elseif($logement->statut === 'brouillon')

                        <span class="badge bg-secondary fs-6">
                            Brouillon
                        </span>

                    @else

                        <span class="badge bg-dark fs-6">
                            Archivé
                        </span>

                    @endif

                </div>

            </div>


            <!-- PRIX -->

            <div class="price mt-4">

                {{ number_format($logement->prix, 0, ',', ' ') }}

                FCFA / mois

            </div>


            <hr class="my-4">


            <!-- INFORMATIONS -->

            <h5 class="fw-bold mb-3">
                Informations du logement
            </h5>


            <div class="row g-3">

                <!-- TYPE -->

                <div class="col-md-4">

                    <div class="info-card">

                        <div>

                            <i class="bi bi-house info-icon"></i>

                            <strong>Type</strong>

                        </div>

                        <div class="mt-2">

                            {{ str_replace(
                                '_',
                                '-',
                                ucfirst($logement->type_logement)
                            ) }}

                        </div>

                    </div>

                </div>


                <!-- WC -->

                <div class="col-md-4">

                    <div class="info-card">

                        <div>

                            <i class="bi bi-droplet info-icon"></i>

                            <strong>WC / Douche</strong>

                        </div>

                        <div class="mt-2">

                            @if($logement->wc_douche_interne)

                                <span class="text-success">
                                    <i class="bi bi-check-circle"></i>
                                    Interne
                                </span>

                            @else

                                <span class="text-danger">
                                    <i class="bi bi-x-circle"></i>
                                    Externe
                                </span>

                            @endif

                        </div>

                    </div>

                </div>


                <!-- CUISINE -->

                <div class="col-md-4">

                    <div class="info-card">

                        <div>

                            <i class="bi bi-cup-hot info-icon"></i>

                            <strong>Cuisine</strong>

                        </div>

                        <div class="mt-2">

                            @if($logement->cuisine)

                                <span class="text-success">
                                    <i class="bi bi-check-circle"></i>
                                    Oui
                                </span>

                            @else

                                <span class="text-danger">
                                    <i class="bi bi-x-circle"></i>
                                    Non
                                </span>

                            @endif

                        </div>

                    </div>

                </div>


                <!-- CHAMBRES -->

                <div class="col-md-6">

                    <div class="info-card">

                        <i class="bi bi-door-open info-icon"></i>

                        <strong>
                            Chambres
                        </strong>

                        <div class="mt-2">

                            {{ $logement->nombre_chambres ?? 0 }}

                        </div>

                    </div>

                </div>


                <!-- SALLES DE BAIN -->

                <div class="col-md-6">

                    <div class="info-card">

                        <i class="bi bi-water info-icon"></i>

                        <strong>
                            Salles de bain
                        </strong>

                        <div class="mt-2">

                            {{ $logement->nombre_salles_bain ?? 0 }}

                        </div>

                    </div>

                </div>

            </div>


            <!-- DESCRIPTION -->

            <hr class="my-4">

            <h5 class="fw-bold mb-3">
                Description
            </h5>

            <div class="description">

                @if($logement->description)

                    {!! nl2br(e($logement->description)) !!}

                @else

                    <span class="text-muted">
                        Aucune description disponible.
                    </span>

                @endif

            </div>


            <!-- GALERIE -->

            @if($logement->photos->count() > 0)

                <hr class="my-4">

                <h5 class="fw-bold mb-3">

                    Photos
                    <span class="text-muted">
                        ({{ $logement->photos->count() }})
                    </span>

                </h5>

                <div class="row g-3 gallery">

                    @foreach($logement->photos as $photo)

                        <div class="col-6 col-md-3">

                            <img
                                src="{{ asset('storage/' . $photo->chemin) }}"
                                alt="Photo du logement"
                                onclick="showImage(this.src)"
                            >

                        </div>

                    @endforeach

                </div>

            @endif


            <!-- STATISTIQUES -->

            <hr class="my-4">

            <div class="row g-3">

                <div class="col-md-6">

                    <div class="info-card">

                        <i class="bi bi-eye info-icon"></i>

                        <strong>
                            Vues
                        </strong>

                        <div class="mt-2">

                            {{ $logement->vues }}

                            vue(s)

                        </div>

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="info-card">

                        <i class="bi bi-calendar3 info-icon"></i>

                        <strong>
                            Publié le
                        </strong>

                        <div class="mt-2">

                            {{ $logement->created_at->format('d/m/Y') }}

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<!-- MODAL IMAGE -->

<div
    class="modal fade"
    id="imageModal"
    tabindex="-1"
>

    <div class="modal-dialog modal-xl modal-dialog-centered">

        <div class="modal-content bg-dark">

            <div class="modal-body text-center">

                <img
                    id="modalImage"
                    src=""
                    class="img-fluid"
                    style="max-height:80vh;"
                >

            </div>

        </div>

    </div>

</div>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>


<script>

    function showImage(src)
    {
        document.getElementById('modalImage').src = src;

        const modal =
            new bootstrap.Modal(
                document.getElementById('imageModal')
            );

        modal.show();
    }

</script>

</body>

</html>
