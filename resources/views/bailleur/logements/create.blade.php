<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <x-pwa-head />

    <title>Ajouter un logement - CHEZMW</title>
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

        /* =====================================================
           PHOTOS TEMPORAIRES
           ===================================================== */
        
        .temporary-photo {
            position: relative;
            height: 180px;
            border-radius: 15px;
            overflow: hidden;
            background: #f1f3f5;
            border: 1px solid #dee2e6;
            box-shadow: 0 5px 15px rgba(0,0,0,.08);
        }
        
        .temporary-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .temporary-photo-badge {
            position: absolute;
            left: 8px;
            right: 8px;
            bottom: 8px;
        
            padding: 7px 10px;
        
            border-radius: 8px;
        
            background: rgba(25, 135, 84, .92);
        
            color: white;
        
            font-size: 12px;
            font-weight: 600;
        
            text-align: center;
        }
        
        
        /* =====================================================
           APERÇU DES NOUVELLES PHOTOS
           ===================================================== */
        
        .preview-photo {
            position: relative;
            height: 180px;
            border-radius: 15px;
            overflow: hidden;
            border: 1px solid #dee2e6;
            background: #f8f9fa;
        }
        
        .preview-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .preview-photo-label {
            position: absolute;
            left: 8px;
            right: 8px;
            bottom: 8px;
        
            padding: 6px 8px;
        
            border-radius: 8px;
        
            background: rgba(13, 110, 253, .9);
        
            color: white;
        
            font-size: 12px;
        
            text-align: center;
        }

        body {
            background: #f5f8fc;
            font-family: Arial, Helvetica, sans-serif;
        }

        .page-container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .header-card {
            background: linear-gradient(
                135deg,
                #0d6efd,
                #198754
            );

            color: white;
            padding: 30px;
            border-radius: 18px;
            margin-bottom: 25px;
        }

        .header-card h2 {
            font-weight: bold;
        }

        .form-card {
            background: white;
            border-radius: 18px;
            padding: 30px;
            box-shadow: 0 5px 25px rgba(0,0,0,.06);
        }

        .form-label {
            font-weight: 600;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            padding: 12px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 .2rem rgba(13,110,253,.12);
        }

        .option-card {
            border: 1px solid #dee2e6;
            border-radius: 12px;
            padding: 15px;
            cursor: pointer;
            transition: .2s;
        }

        .option-card:hover {
            border-color: #0d6efd;
            background: #f8fbff;
        }

        .option-card input {
            margin-right: 8px;
        }

        .btn-main {
            background: linear-gradient(
                135deg,
                #0d6efd,
                #198754
            );

            color: white;
            border: none;
            border-radius: 10px;
            padding: 13px 25px;
            font-weight: bold;
        }

        .btn-main:hover {
            color: white;
            opacity: .9;
        }

        .back-link {
            color: #0d6efd;
            text-decoration: none;
        }

    </style>

</head>

    <script>
    
    document.addEventListener('DOMContentLoaded', function () {

    const input = document.getElementById('photos');
    const preview = document.getElementById('preview');

    if (!input || !preview) {
        return;
    }

    input.addEventListener('change', function () {

        preview.innerHTML = '';

        const files = Array.from(this.files);

        if (files.length > 10) {

            alert('Vous pouvez sélectionner au maximum 10 photos.');

            this.value = '';

            return;
        }

        files.forEach(function (file, index) {

            if (!file.type.startsWith('image/')) {
                return;
            }

            const reader = new FileReader();

            reader.onload = function (event) {

                const col = document.createElement('div');

                col.className =
                    'col-6 col-md-4 col-lg-3';


                col.innerHTML = `

                    <div class="preview-photo">

                        <img
                            src="${event.target.result}"
                            alt="Aperçu photo"
                        >

                        <div class="preview-photo-label">

                            ${index === 0
                                ? '⭐ Photo principale'
                                : 'Photo ' + (index + 1)
                            }

                        </div>

                    </div>

                `;

                preview.appendChild(col);

            };

            reader.readAsDataURL(file);

        });

    });

    });
    
    </script>


<body>

    <x-app-sidebar />

<div class="page-container">

    <!-- HEADER -->

    <div class="header-card">

        <a href="{{ route('bailleur.dashboard') }}"
           class="text-white text-decoration-none">

            <i class="bi bi-arrow-left"></i>
            Retour au dashboard

        </a>

        <h2 class="mt-4">
            <i class="bi bi-house-add me-2"></i>
            Ajouter un logement
        </h2>

        <p class="mb-0">
            Publiez votre logement et trouvez rapidement
            un locataire sur CHEZMW.
        </p>

    </div>


    <!-- ERREURS -->

    @if ($errors->any())

        <div class="alert alert-danger">

            <strong>
                Veuillez corriger les erreurs suivantes :
            </strong>

            <ul class="mb-0 mt-2">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <!-- FORMULAIRE -->

    <div class="form-card">

        <form
            method="POST"
            action="{{ route('bailleur.logements.store') }}"
            enctype="multipart/form-data"
        >

            @csrf


            <!-- TITRE -->

            <div class="mb-4">

                <label class="form-label">
                    Titre de l'annonce *
                </label>

                <input
                    type="text"
                    name="titre"
                    class="form-control"
                    value="{{ old('titre', $annonceEnAttente['titre'] ?? '') }}"
                    placeholder="Ex : Chambre moderne à Adidogomé"
                    required
                >

            </div>


            <!-- TYPE -->

            <div class="mb-4">

                <label class="form-label">
                    Type de logement *
                </label>

                <select
                    name="type_logement"
                    id="type_logement"
                    class="form-select"
                    required
                >

                    <option value="">
                        Sélectionner le type
                    </option>

                    <option value="appartement"
                        {{ old('type_logement', $annonceEnAttente['type_logement'] ?? '') == 'appartement' ? 'selected' : '' }}>
                        Appartement
                    </option>

                    <option value="maison"
                        {{ old('type_logement', $annonceEnAttente['type_logement'] ?? '') == 'maison' ? 'selected' : '' }}>
                        Maison
                    </option>

                    <option value="villa"
                        {{ old('type_logement', $annonceEnAttente['type_logement'] ?? '') == 'villa' ? 'selected' : '' }}>
                        Villa
                    </option>

                    <option value="studio"
                        {{ old('type_logement', $annonceEnAttente['type_logement'] ?? '') == 'studio' ? 'selected' : '' }}>
                        Studio
                    </option>

                    <option value="chambre"
                        {{ old('type_logement', $annonceEnAttente['type_logement'] ?? '') == 'chambre' ? 'selected' : '' }}>
                        Chambre
                    </option>

                    <option value="chambre_salon"
                        {{ old('type_logement', $annonceEnAttente['type_logement'] ?? '') == 'chambre_salon' ? 'selected' : '' }}>
                        Chambre-salon
                    </option>

                </select>

            </div>


            <!-- WC / DOUCHE -->

            <div class="mb-4">

                <label class="form-label d-block">
                    WC / douche interne *
                </label>

                <div class="row g-3">

                    <div class="col-md-6">

                        <label class="option-card d-block">

                            <input
                                type="radio"
                                name="wc_douche_interne"
                                value="1"
                                {{ old('wc_douche_interne', $annonceEnAttente['wc_douche_interne'] ?? '') == '1' ? 'checked' : '' }}
                                required
                            >

                            Oui, WC / douche interne

                        </label>

                    </div>

                    <div class="col-md-6">

                        <label class="option-card d-block">

                            <input
                                type="radio"
                                name="wc_douche_interne"
                                value="0"
                                {{ old('wc_douche_interne', $annonceEnAttente['wc_douche_interne'] ?? '') === '0' ? 'checked' : '' }}
                            >

                            Non, WC / douche externe

                        </label>

                    </div>

                </div>

            </div>


            <!-- CUISINE -->

            <div class="mb-4">

                <label class="form-label d-block">
                    Cuisine *
                </label>

                <div class="row g-3">

                    <div class="col-md-6">

                        <label class="option-card d-block">

                            <input
                                type="radio"
                                name="cuisine"
                                value="1"
                                {{ old('cuisine', $annonceEnAttente['cuisine'] ?? '') == '1' ? 'checked' : '' }}
                                required
                            >

                            Oui, avec cuisine

                        </label>

                    </div>

                    <div class="col-md-6">

                        <label class="option-card d-block">

                            <input
                                type="radio"
                                name="cuisine"
                                value="0"
                                {{ old('cuisine', $annonceEnAttente['cuisine'] ?? '') === '0' ? 'checked' : '' }}
                            >

                            Non, sans cuisine

                        </label>

                    </div>

                </div>

            </div>


            <!-- PRIX -->

            <div class="mb-4">

                <label class="form-label">
                    Prix mensuel (FCFA) *
                </label>

                <div class="input-group">

                    <input
                        type="number"
                        name="prix"
                        class="form-control"
                        value="{{ old('prix', $annonceEnAttente['prix'] ?? '') }}"
                        placeholder="75000"
                        min="0"
                        required
                    >

                    <span class="input-group-text">
                        FCFA
                    </span>

                </div>

            </div>


            <!-- CHAMBRES / SALLES DE BAIN -->

            <div class="row g-3 mb-4">

                <div class="col-md-6">

                    <label class="form-label">
                        Nombre de chambres
                    </label>

                    <input
                        type="number"
                        name="nombre_chambres"
                        class="form-control"
                        value="{{ old('nombre_chambres', $annonceEnAttente['nombre_chambres'] ?? '') }}"
                        min="0"
                    >

                </div>

                <div class="col-md-6">

                    <label class="form-label">
                        Nombre de salles de bain
                    </label>

                    <input
                        type="number"
                        name="nombre_salles_bain"
                        class="form-control"
                        value="{{ old('nombre_salles_bain', $annonceEnAttente['nombre_salles_bain'] ?? '') }}"
                        min="0"
                    >

                </div>

            </div>


            <!-- VILLE -->

            <div class="mb-4">

                <label class="form-label">
                    Ville *
                </label>

                <input
                    type="text"
                    name="ville"
                    class="form-control"
                    value="{{ old('ville', $annonceEnAttente['ville'] ?? 'Lomé') }}"
                    maxlength="100"
                    required
                >

            </div>


            <!-- QUARTIER -->

            <div class="mb-4">

                <label class="form-label">
                    Quartier *
                </label>

                <input
                    type="text"
                    name="quartier"
                    class="form-control"
                    value="{{ old('quartier', $annonceEnAttente['quartier'] ?? '') }}"
                    placeholder="Ex : Adidogomé"
                    required
                >

            </div>


            <!-- ADRESSE -->

            <div class="mb-4">

                <label class="form-label">
                    Adresse / localisation
                </label>

                <input
                    type="text"
                    name="adresse"
                    class="form-control"
                    value="{{ old('adresse', $annonceEnAttente['adresse'] ?? '') }}"
                    placeholder="Ex : près du marché d'Adidogomé"
                >

            </div>


            <!-- DESCRIPTION -->

            <div class="mb-4">

                <label class="form-label">
                    Description
                </label>

                <textarea
                    name="description"
                    class="form-control"
                    rows="6"
                    placeholder="Décrivez le logement, son environnement, les conditions de location..."
                >{{ old('description', $annonceEnAttente['description'] ?? '') }}</textarea>

            </div>


            <!-- PHOTOS -->

            <div class="mb-4">
            
                <label class="form-label fw-bold">
                    Photos du logement
                </label>
            
                <div class="border rounded-3 p-4 text-center">
            
                    <i class="bi bi-images fs-1 text-primary"></i>
            
                    <h6 class="mt-3">
                        Sélectionnez plusieurs photos
                    </h6>
            
                    <p class="text-muted small mb-3">
                        Vous pouvez sélectionner jusqu'à 10 photos.
                    </p>
            
                    <input
                        type="file"
                        name="photos[]"
                        id="photos"
                        class="form-control"
                        accept="image/jpeg,image/png,image/webp"
                        multiple
                    >
            
                </div>
            
            
                {{-- =====================================================
                     PHOTOS TEMPORAIRES APRÈS PAIEMENT
                     ===================================================== --}}
            
                @if (!empty($photosEnAttente))
            
                    <div class="mt-4">
            
                        <div class="alert alert-success d-flex align-items-center">
            
                            <i class="bi bi-check-circle-fill me-2"></i>
            
                            <div>
                                <strong>
                                    {{ count($photosEnAttente) }}
                                    photo(s) déjà sélectionnée(s)
                                </strong>
            
                                <br>
            
                                <small>
                                    Ces photos seront publiées avec votre logement.
                                </small>
                            </div>
            
                        </div>
            
            
                        <div class="row g-3">
            
                            @foreach ($photosEnAttente as $photo)
            
                                <div class="col-6 col-md-4 col-lg-3">
            
                                    <div class="temporary-photo">
            
                                        <img
                                            src="{{ asset('storage/' . $photo) }}"
                                            alt="Photo du logement"
                                        >
            
                                        <div class="temporary-photo-badge">
            
                                            <i class="bi bi-check-circle-fill"></i>
            
                                            Photo sélectionnée
            
                                        </div>
            
                                    </div>
            
                                </div>
            
                            @endforeach
            
                        </div>
            
                    </div>
            
                @endif
            
            
                {{-- =====================================================
                     APERÇU DES NOUVELLES PHOTOS
                     ===================================================== --}}
            
                <div
                    id="preview"
                    class="row g-3 mt-3"
                ></div>
            
            </div>


            <!-- BOUTONS -->

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                <a
                    href="{{ route('bailleur.dashboard') }}"
                    class="back-link"
                >
                    <i class="bi bi-arrow-left me-1"></i>
                    Annuler
                </a>

                <button
                    type="submit"
                    class="btn-main"
                >

                    <i class="bi bi-check-circle me-2"></i>

                    Publier le logement

                </button>

            </div>

        </form>

    </div>

</div>

</body>

</html>
