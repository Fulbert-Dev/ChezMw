<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <x-pwa-head />

    <title>Mes logements - CHEZMW</title>
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
            max-width: 1200px;
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
            margin-bottom: 30px;
        }

        .header h2 {
            font-weight: bold;
        }

        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn-add {
            background: white;
            color: #0d6efd;
            border: none;
            border-radius: 10px;
            padding: 11px 18px;
            font-weight: bold;
            text-decoration: none;
        }

        .btn-add:hover {
            color: #0d6efd;
            background: #f1f1f1;
        }

        .property-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            border: none;
            box-shadow: 0 5px 20px rgba(0,0,0,.06);
            height: 100%;
            transition: .25s;
        }

        .property-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,.10);
        }

        .property-image {
            height: 220px;
            width: 100%;
            object-fit: cover;
        }

        .no-image {
            height: 220px;
            background: #eef5ff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #0d6efd;
            font-size: 50px;
        }

        .property-body {
            padding: 20px;
        }

        .property-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .property-location {
            color: #6c757d;
            font-size: 14px;
        }

        .price {
            color: #198754;
            font-size: 19px;
            font-weight: bold;
            margin-top: 12px;
        }

        .property-meta {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #eee;
            font-size: 14px;
        }

        .empty {
            background: white;
            border-radius: 18px;
            text-align: center;
            padding: 70px 20px;
            box-shadow: 0 5px 20px rgba(0,0,0,.05);
        }

        .empty-icon {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: #eef5ff;
            color: #0d6efd;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 40px;
        }


        :root {
            --cm-blue:#0d6efd;
            --cm-green:#198754;
            --cm-sidebar:#101c2d;
        }
        body { margin:0; padding-left:270px; }
        .cm-sidebar {
            position:fixed; inset:0 auto 0 0; width:270px; padding:24px 16px;
            background:radial-gradient(circle at 20% 10%,rgba(13,110,253,.28),transparent 30%),
                       linear-gradient(180deg,#101c2d,#0b1523);
            color:#fff; z-index:2000; display:flex; flex-direction:column;
            box-shadow:8px 0 30px rgba(10,25,45,.12);
        }
        .cm-brand { display:flex; align-items:center; gap:12px; padding:8px 10px 26px;
                    color:#fff; text-decoration:none; }
        .cm-brand-icon { width:44px;height:44px;border-radius:14px;display:grid;place-items:center;
                         background:linear-gradient(135deg,var(--cm-blue),var(--cm-green));
                         box-shadow:0 8px 22px rgba(13,110,253,.25);font-size:22px; }
        .cm-brand-text strong { display:block;font-size:20px;font-weight:800; }
        .cm-brand-text small { display:block;color:#9fb0c6;font-size:11px;margin-top:1px; }
        .cm-nav-title { padding:10px 12px 8px;color:#70839b;font-size:10px;font-weight:800;
                        text-transform:uppercase;letter-spacing:1.4px; }
        .cm-nav { display:flex;flex-direction:column;gap:7px; }
        .cm-nav a { display:flex;align-items:center;gap:13px;padding:12px 13px;border-radius:13px;
                    color:#cbd7e6;text-decoration:none;font-size:14px;font-weight:600;transition:.25s; }
        .cm-nav a i { width:22px;text-align:center;font-size:17px; }
        .cm-nav a:hover,.cm-nav a.active { color:#fff;
            background:linear-gradient(135deg,rgba(13,110,253,.92),rgba(25,135,84,.88));
            transform:translateX(3px);box-shadow:0 8px 20px rgba(13,110,253,.16); }
        .cm-sidebar-bottom { margin-top:auto; }
        .cm-user { display:flex;align-items:center;gap:10px;padding:12px;margin-bottom:10px;
                   border:1px solid rgba(255,255,255,.07);border-radius:14px;
                   background:rgba(255,255,255,.045); }
        .cm-user-avatar { width:38px;height:38px;flex-shrink:0;border-radius:12px;display:grid;
                          place-items:center;background:linear-gradient(135deg,var(--cm-blue),var(--cm-green)); }
        .cm-user-info { min-width:0; }
        .cm-user-info strong,.cm-user-info span { display:block;overflow:hidden;text-overflow:ellipsis;white-space:nowrap; }
        .cm-user-info strong { font-size:13px; }
        .cm-user-info span { color:#8fa2b9;font-size:11px;margin-top:2px; }
        .cm-sidebar-footer { color:#687d95;font-size:10px;text-align:center;padding-top:8px; }
        .container-page { max-width:1250px; }
        @media(max-width:900px) {
            body{padding-left:86px}.cm-sidebar{width:86px;padding:20px 10px}
            .cm-brand{justify-content:center;padding-left:0;padding-right:0}
            .cm-brand-text,.cm-nav-title,.cm-nav a span,.cm-user-info,.cm-sidebar-footer{display:none}
            .cm-nav a{justify-content:center;padding:13px 8px}.cm-nav a i{margin:0;font-size:19px}
            .cm-user{justify-content:center;padding:8px}
        }
        @media(max-width:576px) {
            body{padding-left:0;padding-bottom:74px}.cm-sidebar{top:auto;bottom:0;width:100%;height:68px;
            padding:7px 8px;flex-direction:row;align-items:center;justify-content:center;
            box-shadow:0 -8px 25px rgba(10,25,45,.14)}
            .cm-brand,.cm-sidebar-bottom,.cm-nav-title{display:none}.cm-nav{width:100%;flex-direction:row;
            justify-content:space-around;gap:3px}.cm-nav a{flex:1;max-width:72px;justify-content:center;padding:10px 5px}
            .cm-nav a i{font-size:19px}.container-page{margin-top:20px}
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

    <div class="header">

        <div class="header-actions">

            <div>

                <a href="{{ $promotion ? route('bailleur.offres') : route('bailleur.dashboard') }}"
                   class="text-white text-decoration-none">

                    <i class="bi bi-arrow-left me-1"></i>
                    {{ $promotion ? 'Offres' : 'Dashboard' }}

                </a>

                <h2 class="mt-3 mb-2">
                    Mes logements
                </h2>

                <p class="mb-0">
                    @if($promotion === 1)
                        Choisissez le logement à mettre en avant.
                    @elseif($promotion === 2)
                        Choisissez le logement à placer en tête des résultats.
                    @else
                        Gérez toutes vos annonces CHEZMW.
                    @endif
                </p>

            </div>

            @if(! $promotion)
            <a href="{{ route('bailleur.logements.create') }}"
               class="btn-add">

                <i class="bi bi-plus-lg me-1"></i>
                Ajouter un logement

            </a>
            @endif

        </div>

    </div>


    <!-- MESSAGE SUCCESS -->

    @if(session('success'))

        <div class="alert alert-success">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

        </div>

    @endif


    @if($logements->count() > 0)

        <div class="row g-4">

            @foreach($logements as $logement)

                <div class="col-md-6 col-lg-4">

                    <div class="property-card">

                        <!-- PHOTO -->

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
                                class="property-image"
                            >

                        @else

                            <div class="no-image">

                                <i class="bi bi-house-door"></i>

                            </div>

                        @endif


                        <!-- CONTENU -->

                        <div class="property-body">

                            <div class="d-flex justify-content-between align-items-start">

                                <div class="property-title">

                                    {{ $logement->titre }}

                                </div>

                                @if($logement->statut === 'actif')

                                    <span class="badge bg-success">
                                        Actif
                                    </span>

                                @elseif($logement->statut === 'loue')

                                    <span class="badge bg-warning text-dark">
                                        Loué
                                    </span>

                                @else

                                    <span class="badge bg-secondary">
                                        {{ ucfirst($logement->statut) }}
                                    </span>

                                @endif

                            </div>


                            <div class="property-location">

                                <i class="bi bi-geo-alt me-1"></i>

                                {{ $logement->quartier }},
                                {{ $logement->ville }}

                            </div>


                            <div class="mt-2">

                                <span class="badge bg-light text-dark">

                                    {{ str_replace('_', '-', ucfirst($logement->type_logement)) }}

                                </span>

                            </div>


                            <div class="price">

                                {{ number_format($logement->prix, 0, ',', ' ') }}
                                FCFA / mois

                            </div>


                            <div class="property-meta">

                                <span>

                                    <i class="bi bi-eye me-1"></i>

                                    {{ $logement->vues }} vues

                                </span>
                                
                                <span>
                                    <i class="bi bi-heart-fill text-danger"></i>
                                    {{ $logement->favoris_count }} favoris
                                </span>

                                <span>

                                    <i class="bi bi-images me-1"></i>

                                    {{ $logement->photos->count() }} photos

                                </span>

                            </div>


                            <!-- ACTIONS -->

                            <div class="d-flex gap-2 mt-3">

                                @if($promotion)

                                    <form
                                        method="POST"
                                        action="{{ route('bailleur.visibilite.acheter', $logement) }}"
                                        class="w-100"
                                    >
                                        @csrf
                                        <input type="hidden" name="niveau" value="{{ $promotion }}">

                                        <button
                                            type="submit"
                                            class="btn btn-primary w-100"
                                        >
                                            {{ $promotion === 1 ? '🔥 Mettre à jour : mise en avant' : '🚀 Mettre à jour : tête des résultats' }}
                                        </button>
                                    </form>

                                @else

                                <a
                                    href="{{ route('bailleur.logements.show', $logement) }}"
                                    class="btn btn-outline-primary btn-sm flex-fill"
                                >

                                    <i class="bi bi-eye me-1"></i>
                                    Voir

                                </a>

                                <a
                                    href="{{ route('bailleur.visibilite.index', $logement) }}"
                                    class="btn btn-outline-info"
                                >
                                    🚀 Augmenter la visibilité
                                </a>

                                <a
                                    href="{{ route('bailleur.logements.edit', $logement) }}"
                                    class="btn btn-outline-success btn-sm flex-fill"
                                >

                                    <i class="bi bi-pencil me-1"></i>
                                    Modifier

                                </a>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>


        <!-- PAGINATION -->

        <div class="mt-4">

            {{ $logements->links() }}

        </div>


    @else

        <!-- AUCUN LOGEMENT -->

        <div class="empty">

            <div class="empty-icon">

                <i class="bi bi-house-add"></i>

            </div>

            <h4>
                Aucun logement publié
            </h4>

            <p class="text-muted">
                Vous n'avez encore publié aucun logement.
                Commencez par ajouter votre première annonce.
            </p>

            <a
                href="{{ route('bailleur.logements.create') }}"
                class="btn btn-primary"
            >

                <i class="bi bi-plus-lg me-1"></i>

                Ajouter mon premier logement

            </a>

        </div>

    @endif

</div>

</body>

</html>
