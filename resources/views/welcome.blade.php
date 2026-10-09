<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-pwa-head />

    <title>CHEZMW - Trouvez votre chez-vous</title>
    <link
        rel="icon"
        type="image/svg+xml"
        href="{{ asset('images/ChatGPT Image 7 sept. 2026, 21_37_28 - Copie.png') }}"
    >

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f8f9fa;
            color: #212529;
        }

        /* =========================
           NAVBAR
        ========================= */

        .navbar {
            background: linear-gradient(135deg, #0d6efd, #198754);
            padding: 15px 0;
        }

        .navbar-brand {
            font-size: 28px;
            font-weight: 800;
            color: white !important;
        }

        .navbar-nav .nav-link {
            color: white !important;
            font-weight: 500;
            margin-left: 15px;
            transition: 0.3s;
        }

        .navbar-nav .nav-link:hover {
            transform: translateY(-2px);
            opacity: 0.8;
        }

        /* =========================
           HERO
        ========================= */

        .hero {
            min-height: 650px;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;

            background:
                linear-gradient(
                    135deg,
                    rgba(13, 110, 253, 0.95),
                    rgba(25, 135, 84, 0.9)
                );
        }

        .hero::before {
            content: "";
            position: absolute;
            width: 450px;
            height: 450px;
            border-radius: 50%;
            background: rgba(255,255,255,0.08);
            top: -150px;
            right: -100px;
            animation: float 6s ease-in-out infinite;
        }

        .hero::after {
            content: "";
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(255,255,255,0.07);
            bottom: -120px;
            left: -80px;
            animation: float 5s ease-in-out infinite reverse;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            color: white;
        }

        .hero-title {
            font-size: 60px;
            font-weight: 800;
            line-height: 1.1;
        }

        .hero-title span {
            color: #d9ffe9;
        }

        .hero-text {
            font-size: 20px;
            max-width: 650px;
            margin: 25px 0;
            line-height: 1.7;
        }

        /* =========================
           SEARCH BOX
        ========================= */

        .search-box {
            background: white;
            padding: 25px;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
            margin-top: 35px;
            color: #212529;
        }

        .search-box label {
            font-weight: bold;
            margin-bottom: 8px;
        }

        .search-box .form-control,
        .search-box .form-select {
            height: 50px;
            border-radius: 10px;
        }

        .btn-search {
            height: 50px;
            border-radius: 10px;
            background: linear-gradient(135deg, #0d6efd, #198754);
            color: white;
            border: none;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-search:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(13,110,253,0.3);
            color: white;
        }

        /* =========================
           SECTIONS
        ========================= */

        .section {
            padding: 90px 0;
        }

        .section-title {
            font-size: 40px;
            font-weight: 800;
            text-align: center;
            margin-bottom: 15px;
        }

        .section-subtitle {
            text-align: center;
            color: #6c757d;
            margin-bottom: 50px;
        }

        /* =========================
           LOGEMENTS
        ========================= */

        .property-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            border: none;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            transition: 0.4s;
            height: 100%;
        }

        .property-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .property-image {
            height: 220px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0d6efd, #198754);
            color: white;
            font-size: 60px;
        }

        .property-body {
            padding: 25px;
        }

        .property-title {
            font-size: 22px;
            font-weight: bold;
        }

        .location {
            color: #6c757d;
            margin: 12px 0;
        }

        .price {
            color: #198754;
            font-size: 20px;
            font-weight: bold;
        }

        /* =========================
           COMMENT CA MARCHE
        ========================= */

        .step-card {
            background: white;
            padding: 35px 25px;
            border-radius: 20px;
            text-align: center;
            height: 100%;
            box-shadow: 0 8px 25px rgba(0,0,0,0.07);
            transition: 0.3s;
        }

        .step-card:hover {
            transform: translateY(-8px);
        }

        .step-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0d6efd, #198754);
            color: white;
            font-size: 32px;
        }

        /* =========================
           STATS
        ========================= */

        .stats {
            background: linear-gradient(135deg, #0d6efd, #198754);
            color: white;
            padding: 70px 0;
        }

        .stat-number {
            font-size: 45px;
            font-weight: 800;
        }

        .stat-label {
            font-size: 18px;
            opacity: 0.9;
        }

        /* =========================
           BAILLEUR
        ========================= */

        .owner-section {
            padding: 90px 0;
        }

        .owner-box {
            padding: 60px;
            border-radius: 30px;
            color: white;

            background:
                linear-gradient(
                    135deg,
                    #0d6efd,
                    #198754
                );

            box-shadow: 0 20px 50px rgba(0,0,0,0.15);
        }

        .owner-box h2 {
            font-size: 40px;
            font-weight: 800;
        }

        /* =========================
           FOOTER
        ========================= */

        footer {
            background: #111827;
            color: white;
            padding: 60px 0 20px;
        }

        footer h4 {
            font-weight: bold;
            margin-bottom: 20px;
        }

        footer a {
            color: #adb5bd;
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
            transition: 0.3s;
        }

        footer a:hover {
            color: white;
            padding-left: 5px;
        }

        .footer-bottom {
            border-top: 1px solid #343a40;
            margin-top: 40px;
            padding-top: 20px;
            text-align: center;
            color: #adb5bd;
        }

        /* =========================
           ANIMATION
        ========================= */

        .fade-in {
            animation: fadeIn 1.2s ease forwards;
        }

        .slide-up {
            animation: slideUp 1s ease forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-25px);
            }
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 768px) {

            .hero {
                min-height: 750px;
            }

            .hero-title {
                font-size: 42px;
            }

            .hero-text {
                font-size: 17px;
            }

            .section-title {
                font-size: 32px;
            }

            .owner-box {
                padding: 35px 25px;
            }

            .owner-box h2 {
                font-size: 30px;
            }
        }
    </style>
</head>

<body>

<!-- =========================
     NAVBAR
========================= -->

<nav class="navbar navbar-expand-lg sticky-top">

    <div class="container">

        <a class="navbar-brand" href="{{ route('home') }}" aria-label="CHEZMW">
            <img src="{{ asset('images/ChatGPT Image 7 sept. 2026, 21_37_28.png') }}" alt="CHEZMW" style="height: 52px; width: auto; display: block;">
        </a>

        <button
            class="navbar-toggler bg-white"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        Accueil
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#logements">
                        Logements
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#comment-ca-marche">
                        Comment ça marche
                    </a>
                </li>

                @auth

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            Tableau de bord
                        </a>
                    </li>

                @else

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            Connexion
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            Inscription
                        </a>
                    </li>

                @endauth

            </ul>

        </div>

    </div>

</nav>


<!-- =========================
     HERO
========================= -->

<section class="hero">

    <div class="container">

        <div class="hero-content fade-in">

            @auth

                <p class="mb-2">
                    Bonjour, <strong>{{ Auth::user()->name }}</strong> 👋
                </p>

            @else

                <p class="mb-2">
                    Bienvenue sur CHEZMW 👋
                </p>

            @endauth

            <h1 class="hero-title">
                Trouvez votre
                <span>chez-vous.</span>
            </h1>

            <p class="hero-text">
                CHEZMW vous met directement en relation avec
                les bailleurs et les locataires.
                Trouvez facilement le logement qui correspond
                à vos besoins à Lomé et partout au Togo.
            </p>


            <!-- SEARCH -->

            <div class="search-box slide-up">

                <form action="{{ route('recherche.login') }}" method="GET">

                    <div class="row g-3 align-items-end">

                        <div class="col-md-4">

                            <label>
                                Localisation
                            </label>

                            <input
                                type="text"
                                name="q"
                                class="form-control"
                                placeholder="Ex: Lomé, Adidogomé"
                            >

                        </div>


                        <div class="col-md-3">

                            <label>
                                Type de logement
                            </label>

                            <select
                                name="type_logement"
                                class="form-select"
                            >
                                <option value="">
                                    Tous les types
                                </option>

                                <option value="appartement">
                                    Appartement
                                </option>

                                <option value="maison">
                                    Maison
                                </option>

                                <option value="villa">
                                    Villa
                                </option>

                                <option value="studio">
                                    Studio
                                </option>

                                <option value="chambre">
                                    Chambre
                                </option>

                            </select>

                        </div>


                        <div class="col-md-3">

                            <label>
                                Budget max
                            </label>

                            <input
                                type="number"
                                name="prix_max"
                                class="form-control"
                                placeholder="Prix maximum"
                            >

                        </div>


                        <div class="col-md-2">

                            <button
                                type="submit"
                                class="btn btn-search w-100"
                            >
                                <i class="bi bi-search"></i>
                                Rechercher
                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</section>


<!-- =========================
     LOGEMENTS
========================= -->

<section class="section" id="logements">

    <div class="container">

        <h2 class="section-title">
            Logements populaires
        </h2>

        <p class="section-subtitle">
            Découvrez les logements disponibles actuellement.
        </p>


        <div class="row g-4">

            @forelse ($logementsPopulaires as $logement)

                <div class="col-lg-4 col-md-6">

                    <div class="property-card">

                        <div class="property-image">
                            @if ($logement->photos->isNotEmpty())
                                <img
                                    src="{{ asset('storage/' . $logement->photos->first()->chemin) }}"
                                    alt="{{ $logement->titre }}"
                                    style="width: 100%; height: 100%; object-fit: cover;"
                                >
                            @else
                                @switch($logement->type_logement)
                                    @case('appartement') 🏢 @break
                                    @case('maison') 🏠 @break
                                    @case('villa') 🏡 @break
                                    @case('studio') 🏩 @break
                                    @default 🏘️ @endswitch
                            @endif
                        </div>

                        <div class="property-body">

                            <h3 class="property-title">
                                {{ $logement->titre }}
                            </h3>

                            <div class="location">
                                📍 {{ $logement->quartier ?? 'Centre' }}, {{ $logement->ville ?? 'Lomé' }}
                            </div>

                            <div class="price">
                                {{ number_format($logement->prix, 0, ',', ' ') }} FCFA / mois
                            </div>

                            <a href="{{ route('logement.login', $logement) }}" class="property-link">
                                Voir le logement
                            </a>

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-12">
                    <div class="alert alert-light text-center">
                        Aucun logement disponible pour le moment.
                    </div>
                </div>

            @endforelse

        </div>

    </div>

</section>


<!-- =========================
     COMMENT CA MARCHE
========================= -->

<section
    class="section bg-light"
    id="comment-ca-marche"
>

    <div class="container">

        <h2 class="section-title">
            Comment ça marche ?
        </h2>

        <p class="section-subtitle">
            Trouvez votre logement en quelques étapes.
        </p>


        <div class="row g-4">


            <div class="col-lg-4">

                <div class="step-card">

                    <div class="step-icon">
                        🔎
                    </div>

                    <h3>
                        Recherchez
                    </h3>

                    <p class="text-muted">
                        Recherchez un logement selon votre
                        ville, quartier et budget.
                    </p>

                </div>

            </div>


            <div class="col-lg-4">

                <div class="step-card">

                    <div class="step-icon">
                        🏠
                    </div>

                    <h3>
                        Choisissez
                    </h3>

                    <p class="text-muted">
                        Consultez les photos et les informations
                        des logements disponibles.
                    </p>

                </div>

            </div>


            <div class="col-lg-4">

                <div class="step-card">

                    <div class="step-icon">
                        🤝
                    </div>

                    <h3>
                        Contactez
                    </h3>

                    <p class="text-muted">
                        Contactez directement le bailleur
                        pour organiser une visite.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- =========================
     STATISTIQUES
========================= -->

<section class="stats">

    <div class="container">

        <div class="row text-center g-4">

            <div class="col-md-4">

                <div class="stat-number">
                    {{ number_format($statistiques['logements'], 0, ',', ' ') }}
                </div>

                <div class="stat-label">
                    Logements
                </div>

            </div>


            <div class="col-md-4">

                <div class="stat-number">
                    {{ number_format($statistiques['bailleurs'], 0, ',', ' ') }}
                </div>

                <div class="stat-label">
                    Bailleurs
                </div>

            </div>


            <div class="col-md-4">

                <div class="stat-number">
                    {{ number_format($statistiques['locataires'], 0, ',', ' ') }}
                </div>

                <div class="stat-label">
                    Locataires
                </div>

            </div>

        </div>

    </div>

</section>


<!-- =========================
     BAILLEUR
========================= -->

<section class="owner-section">

    <div class="container">

        <div class="owner-box">

            <div class="row align-items-center">

                <div class="col-lg-8">

                    <h2>
                        Vous êtes bailleur ?
                    </h2>

                    <p class="lead mt-3">
                        Publiez votre logement et trouvez
                        rapidement votre prochain locataire.
                    </p>

                </div>


                <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">

                    @auth

                        <a
                            href="{{ route('dashboard') }}"
                            class="btn btn-light btn-lg px-4"
                        >
                            Publier un logement
                        </a>

                    @else

                        <a
                            href="{{ route('register') }}"
                            class="btn btn-light btn-lg px-4"
                        >
                            Devenir bailleur
                        </a>

                    @endauth

                </div>

            </div>

        </div>

    </div>

</section>


<!-- =========================
     FOOTER
========================= -->

<footer>

    <div class="container">

        <div class="row g-4">


            <div class="col-lg-4">

                <a class="navbar-brand" href="{{ route('home') }}" aria-label="CHEZMW">
                    <img src="{{ asset('images/ChatGPT Image 7 sept. 2026, 21_37_28 - Copie (2).png') }}" alt="CHEZMW" style="height: 52px; width: auto; display: block;">
                </a>

                <p>
                    La plateforme qui rapproche les bailleurs
                    et les locataires.
                </p>

            </div>


            <div class="col-lg-2">

                <h4>
                    Navigation
                </h4>

                <a href="{{ route('home') }}">
                    Accueil
                </a>

                <a href="#logements">
                    Logements
                </a>

                <a href="#comment-ca-marche">
                    Comment ça marche
                </a>

            </div>


            <div class="col-lg-3">

                <h4>
                    Informations légales
                </h4>

                <a href="{{ route('legal.terms') }}">
                    Conditions d’utilisation
                </a>

                <a href="{{ route('legal.privacy') }}">
                    Politique de confidentialité
                </a>

            </div>


            <div class="col-lg-3">

                <h4>
                    Contact
                </h4>

                <p>
                    📍 Lomé, Togo
                </p>

                <p>
                    ✉️ contact@chezmoi.com
                </p>

            </div>

        </div>


        <div class="footer-bottom">

            © 2026 CHEZMW.
            Tous droits réservés.

        </div>

    </div>

</footer>


<!-- Bootstrap JS -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


<!-- Animation au scroll -->

<script>

    const elements = document.querySelectorAll(
        '.property-card, .step-card'
    );

    const observer = new IntersectionObserver(
        entries => {

            entries.forEach(entry => {

                if (entry.isIntersecting) {

                    entry.target.classList.add('slide-up');

                }

            });

        },
        {
            threshold: 0.15
        }
    );

    elements.forEach(element => {
        observer.observe(element);
    });

</script>

</body>
</html>
