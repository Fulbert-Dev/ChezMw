<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <x-pwa-head />

    <title>Modifier le logement - CHEZMW</title>
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
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .header {
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

        .form-card {
            background: white;
            padding: 30px;
            border-radius: 18px;
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

        .option-card {
            border: 1px solid #dee2e6;
            border-radius: 12px;
            padding: 15px;
        }

        .photo-card {
            position: relative;
        }

        .photo-card img {
            width: 100%;
            height: 140px;
            object-fit: cover;
            border-radius: 10px;
        }

        .btn-main {
            background: linear-gradient(
                135deg,
                #0d6efd,
                #198754
            );

            border: none;
            color: white;
            padding: 12px 25px;
            border-radius: 10px;
            font-weight: bold;
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

    <div class="header">

        <a
            href="{{ route('bailleur.logements.show', $logement) }}"
            class="text-white text-decoration-none"
        >

            <i class="bi bi-arrow-left me-1"></i>

            Retour au logement

        </a>

        <h2 class="mt-4 mb-2">

            <i class="bi bi-pencil-square me-2"></i>

            Modifier le logement

        </h2>

        <p class="mb-0">

            Modifiez les informations de votre annonce.

        </p>

    </div>


    @if ($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif


    <div class="form-card">

        <form
            method="POST"
            action="{{ route('bailleur.logements.update', $logement) }}"
        >

            @csrf
            @method('PUT')


            <!-- TITRE -->

            <div class="mb-4">

                <label class="form-label">
                    Titre de l'annonce
                </label>

                <input
                    type="text"
                    name="titre"
                    class="form-control"
                    value="{{ old('titre', $logement->titre) }}"
                    required
                >

            </div>


            <!-- TYPE -->

            <div class="mb-4">

                <label class="form-label">
                    Type de logement
                </label>

                <select
                    name="type_logement"
                    class="form-select"
                    required
                >

                    <option value="appartement"
                        {{ old('type_logement', $logement->type_logement) === 'appartement' ? 'selected' : '' }}>
                        Appartement
                    </option>

                    <option value="maison"
                        {{ old('type_logement', $logement->type_logement) === 'maison' ? 'selected' : '' }}>
                        Maison
                    </option>

                    <option value="villa"
                        {{ old('type_logement', $logement->type_logement) === 'villa' ? 'selected' : '' }}>
                        Villa
                    </option>

                    <option value="studio"
                        {{ old('type_logement', $logement->type_logement) === 'studio' ? 'selected' : '' }}>
                        Studio
                    </option>

                    <option value="chambre"
                        {{ old('type_logement', $logement->type_logement) === 'chambre' ? 'selected' : '' }}>
                        Chambre
                    </option>

                    <option value="chambre_salon"
                        {{ old('type_logement', $logement->type_logement) === 'chambre_salon' ? 'selected' : '' }}>
                        Chambre-salon
                    </option>

                </select>

            </div>


            <!-- WC -->

            <div class="mb-4">

                <label class="form-label d-block">

                    WC / douche interne

                </label>

                <div class="row g-3">

                    <div class="col-md-6">

                        <label class="option-card d-block">

                            <input
                                type="radio"
                                name="wc_douche_interne"
                                value="1"
                                {{ old('wc_douche_interne', $logement->wc_douche_interne) ? 'checked' : '' }}
                                required
                            >

                            Oui, interne

                        </label>

                    </div>

                    <div class="col-md-6">

                        <label class="option-card d-block">

                            <input
                                type="radio"
                                name="wc_douche_interne"
                                value="0"
                                {{ !old('wc_douche_interne', $logement->wc_douche_interne) ? 'checked' : '' }}
                            >

                            Non, externe

                        </label>

                    </div>

                </div>

            </div>


            <!-- CUISINE -->

            <div class="mb-4">

                <label class="form-label d-block">

                    Cuisine

                </label>

                <div class="row g-3">

                    <div class="col-md-6">

                        <label class="option-card d-block">

                            <input
                                type="radio"
                                name="cuisine"
                                value="1"
                                {{ old('cuisine', $logement->cuisine) ? 'checked' : '' }}
                                required
                            >

                            Oui

                        </label>

                    </div>

                    <div class="col-md-6">

                        <label class="option-card d-block">

                            <input
                                type="radio"
                                name="cuisine"
                                value="0"
                                {{ !old('cuisine', $logement->cuisine) ? 'checked' : '' }}
                            >

                            Non

                        </label>

                    </div>

                </div>

            </div>


            <!-- PRIX -->

            <div class="mb-4">

                <label class="form-label">

                    Prix mensuel (FCFA)

                </label>

                <input
                    type="number"
                    name="prix"
                    class="form-control"
                    value="{{ old('prix', $logement->prix) }}"
                    min="0"
                    required
                >

            </div>


            <!-- CHAMBRES -->

            <div class="row g-3 mb-4">

                <div class="col-md-6">

                    <label class="form-label">

                        Nombre de chambres

                    </label>

                    <input
                        type="number"
                        name="nombre_chambres"
                        class="form-control"
                        value="{{ old('nombre_chambres', $logement->nombre_chambres) }}"
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
                        value="{{ old('nombre_salles_bain', $logement->nombre_salles_bain) }}"
                        min="0"
                    >

                </div>

            </div>


            <!-- VILLE -->

            <div class="mb-4">

                <label class="form-label">

                    Ville

                </label>

                <input
                    type="text"
                    name="ville"
                    class="form-control"
                    value="{{ old('ville', $logement->ville) }}"
                    required
                >

            </div>


            <!-- QUARTIER -->

            <div class="mb-4">

                <label class="form-label">

                    Quartier

                </label>

                <input
                    type="text"
                    name="quartier"
                    class="form-control"
                    value="{{ old('quartier', $logement->quartier) }}"
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
                    value="{{ old('adresse', $logement->adresse) }}"
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
                >{{ old('description', $logement->description) }}</textarea>

            </div>


            <div class="d-flex justify-content-between
                        align-items-center flex-wrap gap-3">

                <a
                    href="{{ route('bailleur.logements.show', $logement) }}"
                    class="btn btn-outline-secondary"
                >

                    Annuler

                </a>


                <button
                    type="submit"
                    class="btn-main"
                >

                    <i class="bi bi-check-circle me-2"></i>

                    Enregistrer les modifications

                </button>

            </div>

        </form>

    </div>

</div>

</body>

</html>
