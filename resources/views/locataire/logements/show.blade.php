<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            background: linear-gradient(180deg, #edf5ff 0, #f7fafc 420px, #f8fafc 100%);
            font-family: Arial, Helvetica, sans-serif;
            color: #172033;
        }

        .container-page {
            max-width: 1150px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 25px;
        }

        .back-link {
            color: #0d6efd;
            text-decoration: none;
            font-weight: 600;
        }

        .main-card {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            border: 1px solid rgba(15, 42, 77, .08);
            box-shadow: 0 20px 55px rgba(28, 57, 90, .12);
        }

        .photo-stage { position: relative; background: #e8f0fa; }

        .photo-count {
            position: absolute;
            right: 20px;
            bottom: 18px;
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(15, 23, 42, .74);
            color: white;
            font-size: 13px;
            font-weight: 700;
        }

        .photo-nav {
            position: absolute;
            top: 50%;
            z-index: 2;
            width: 58px;
            height: 58px;
            border: 0;
            border-radius: 50%;
            background: rgba(15, 23, 42, .72);
            color: white;
            font-size: 44px;
            line-height: 1;
            transform: translateY(-50%);
            transition: transform .2s, background .2s;
        }

        .photo-nav:hover { background: #0d6efd; transform: translateY(-50%) scale(1.08); }
        .photo-nav-prev { left: 22px; }
        .photo-nav-next { right: 22px; }
        .modal-nav { position: absolute; top: 50%; z-index: 3; }

        @media(max-width: 576px) {
            .photo-nav { width: 46px; height: 46px; font-size: 34px; }
            .photo-nav-prev { left: 12px; }
            .photo-nav-next { right: 12px; }
        }

        .main-photo {
            width: 100%;
            height: 500px;
            object-fit: cover;
            display: block;
        }

        .no-photo {
            height: 500px;
            background: #eef5ff;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #0d6efd;
            font-size: 80px;
        }

        .content {
            padding: 36px;
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
            display: inline-block;
            margin-top: 22px;
            padding: 12px 16px;
            border-radius: 14px;
            background: #ecfdf3;
            color: #087443;
            font-size: 28px;
            font-weight: bold;
        }

        .info-card {
            background: linear-gradient(145deg, #f8fbff, #f0f7ff);
            border-radius: 14px;
            padding: 18px;
            height: 100%;
            border: 1px solid #e3edf8;
        }

        .info-icon {
            color: #0d6efd;
            font-size: 22px;
            margin-right: 8px;
        }

        .description {
            color: #555;
            line-height: 1.8;
        }

        .gallery img {
            width: 100%;
            height: 110px;
            object-fit: cover;
            border-radius: 12px;
            cursor: pointer;
            transition: .2s;
        }

        .gallery img:hover {
            transform: scale(1.04);
            box-shadow: 0 10px 22px rgba(15, 42, 77, .16);
        }

        .favorite-btn {
            border: 2px solid #dc3545;
            color: #dc3545;
            background: white;
            border-radius: 10px;
            padding: 11px 18px;
            font-weight: bold;
        }

        .contact-btn {
            background: linear-gradient(
                135deg,
                #0d6efd,
                #198754
            );

            border: none;
            color: white;
            border-radius: 10px;
            padding: 12px 20px;
            font-weight: bold;
        }

        .contact-btn:hover {
            color: white;
            opacity: .9;
        }

        .contact-btn, .favorite-btn { min-height: 50px; transition: transform .2s, box-shadow .2s; }
        .contact-btn:hover, .favorite-btn:hover { transform: translateY(-2px); box-shadow: 0 10px 20px rgba(13, 110, 253, .16); }

        .bailleur-card {
            background: #f8fafc;
            border-radius: 15px;
            padding: 20px;
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

    </style>

</head>

<body>

<x-app-sidebar />

<div class="container-page">

    <!-- TOP -->

    <div class="topbar">

        <a
            href="{{ route('locataire.logements.index') }}"
            class="back-link"
        >

            <i class="bi bi-arrow-left me-1"></i>

            Retour aux logements

        </a>

        <div>

            <span class="badge bg-success">

                <i class="bi bi-check-circle me-1"></i>

                Disponible

            </span>

        </div>

    </div>


    <!-- LOGEMENT -->

    <div class="main-card">

        @php

            $photoPrincipale = $logement->photos
                ->where('principale', true)
                ->first()
                ?? $logement->photos->first();

        @endphp


        <!-- PHOTO PRINCIPALE -->

        <div class="photo-stage">
        @if($photoPrincipale)

            <img
                src="{{ asset('storage/' . $photoPrincipale->chemin) }}"
                alt="{{ $logement->titre }}"
                class="main-photo"
                id="mainPhoto"
                onclick="showImage(this.src)"
            >

        @else

            <div class="no-photo">

                <i class="bi bi-house-door"></i>

            </div>

        @endif

            <span class="photo-count">
                <i class="bi bi-images me-1"></i>
                {{ $logement->photos->count() }} photo{{ $logement->photos->count() > 1 ? 's' : '' }}
            </span>

            @if($logement->photos->count() > 1)
                <button type="button" class="photo-nav photo-nav-prev" onclick="openAdjacentPhoto(-1)" aria-label="Photo précédente">‹</button>
                <button type="button" class="photo-nav photo-nav-next" onclick="openAdjacentPhoto(1)" aria-label="Photo suivante">›</button>
            @endif
        </div>


        <div class="content">

            <!-- TITRE -->

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

                <div class="text-muted">

                    <i class="bi bi-eye me-1"></i>

                    {{ $logement->vues }} vues

                </div>

            </div>


            <!-- PRIX -->

            <div class="price mt-4">

                {{ number_format(
                    $logement->prix,
                    0,
                    ',',
                    ' '
                ) }}

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


            <!-- ACTIONS -->

            <hr class="my-4">

            <div class="row g-3">

                <div class="col-md-6">

                    @auth

                        @php
                            $estFavori = \App\Models\Favori::where(
                                'user_id',
                                auth()->id()
                            )
                            ->where(
                                'logement_id',
                                $logement->id
                            )
                            ->exists();
                        @endphp
                    
                    
                        @if($estFavori)
                    
                            <form
                                method="POST"
                                action="{{ route('favoris.destroy', $logement) }}"
                            >
                    
                                @csrf
                                @method('DELETE')
                    
                                <button
                                    type="submit"
                                    class="favorite-btn w-100"
                                >
                    
                                    <i class="bi bi-heart-fill me-2"></i>
                    
                                    Retirer des favoris
                    
                                </button>
                    
                            </form>
                    
                        @else
                    
                            <form
                                method="POST"
                                action="{{ route('favoris.store', $logement) }}"
                            >
                    
                                @csrf
                    
                                <button
                                    type="submit"
                                    class="favorite-btn w-100"
                                >
                    
                                    <i class="bi bi-heart me-2"></i>
                    
                                    Ajouter aux favoris
                    
                                </button>
                    
                            </form>
                    
                        @endif
                    
                    @else
                    
                        <a
                            href="{{ route('login') }}"
                            class="favorite-btn w-100 text-center
                                   text-decoration-none d-block"
                        >
                    
                            <i class="bi bi-heart me-2"></i>
                    
                            Connectez-vous pour ajouter aux favoris
                    
                        </a>
                    
                    @endauth

                </div>

                <div class="col-md-6">

                    <a
                        href="{{ route('messages.create', $logement) }}"
                        class="contact-btn w-100 text-center text-decoration-none d-block"
                    >
                        <i class="bi bi-chat-dots me-2"></i>
                        Contacter le bailleur
                    </a>

                </div>

            </div>


            <!-- BAILLEUR -->

            <hr class="my-4">

            <h5 class="fw-bold mb-3">

                À propos du bailleur

            </h5>

            <div class="bailleur-card">

                <div class="d-flex align-items-center gap-3">

                    <div
                        class="rounded-circle bg-primary text-white
                               d-flex align-items-center justify-content-center"
                        style="width:55px;height:55px;"
                    >

                        <i class="bi bi-person fs-4"></i>

                    </div>

                    <div>

                        <strong>

                            {{ $logement->bailleur->name }}

                        </strong>

                        <div class="text-muted small">

                            Membre CHEZMW

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

                @if($logement->photos->count() > 1)
                    <button type="button" class="photo-nav photo-nav-prev modal-nav" onclick="showPreviousImage()" aria-label="Photo précédente">‹</button>
                    <button type="button" class="photo-nav photo-nav-next modal-nav" onclick="showNextImage()" aria-label="Photo suivante">›</button>
                @endif

            </div>

        </div>

    </div>

</div>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>


<script>

    let currentPhotoIndex = 0;

    function getGalleryImages() {
        return Array.from(document.querySelectorAll('.gallery img')).map((image) => image.src);
    }

    function showImage(src) {
        const images = getGalleryImages();
        currentPhotoIndex = Math.max(0, images.indexOf(src));
        document.getElementById('modalImage').src = src;

        const modal =
            new bootstrap.Modal(
                document.getElementById('imageModal')
            );

        modal.show();
    }

    function openAdjacentPhoto(direction) {
        const images = getGalleryImages();
        const mainPhoto = document.getElementById('mainPhoto');
        const currentIndex = Math.max(0, images.indexOf(mainPhoto.src));
        const nextIndex = (currentIndex + direction + images.length) % images.length;

        mainPhoto.src = images[nextIndex];
        showImage(images[nextIndex]);
    }

    function showPreviousImage() {
        const images = getGalleryImages();
        currentPhotoIndex = (currentPhotoIndex - 1 + images.length) % images.length;
        document.getElementById('modalImage').src = images[currentPhotoIndex];
        document.getElementById('mainPhoto').src = images[currentPhotoIndex];
    }

    function showNextImage() {
        const images = getGalleryImages();
        currentPhotoIndex = (currentPhotoIndex + 1) % images.length;
        document.getElementById('modalImage').src = images[currentPhotoIndex];
        document.getElementById('mainPhoto').src = images[currentPhotoIndex];
    }

    document.addEventListener('keydown', function (event) {
        if (!document.getElementById('imageModal').classList.contains('show')) return;
        if (event.key === 'ArrowLeft') showPreviousImage();
        if (event.key === 'ArrowRight') showNextImage();
    });

</script>

</body>

</html>
