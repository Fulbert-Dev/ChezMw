<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <x-pwa-head />

    <title>Mot de passe oublié - CHEZMW</title>


    <!-- Bootstrap -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <!-- Bootstrap Icons -->

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >


    <style>

        /* =====================================================
           RESET
        ===================================================== */

        * {
            box-sizing: border-box;
        }


        html,
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            min-height: 100%;
        }


        /* =====================================================
           PAGE
        ===================================================== */

        body {

            min-height: 100vh;

            font-family: Arial, sans-serif;

            background:
                linear-gradient(
                    135deg,
                    #0d6efd,
                    #198754
                );

            display: flex;

            align-items: center;

            justify-content: center;

            overflow-x: hidden;

            padding: 30px 0;

        }


        /* =====================================================
           CERCLES ANIMÉS
        ===================================================== */

        .background-circle {

            position: fixed;

            border-radius: 50%;

            background:
                rgba(
                    255,
                    255,
                    255,
                    0.08
                );

            animation:
                float 6s ease-in-out infinite;

            pointer-events: none;

            z-index: 0;

        }


        .circle-one {

            width: 400px;

            height: 400px;

            top: -150px;

            right: -100px;

        }


        .circle-two {

            width: 300px;

            height: 300px;

            bottom: -120px;

            left: -80px;

            animation-delay: 1s;

        }


        .circle-three {

            width: 180px;

            height: 180px;

            top: 35%;

            left: -100px;

            animation-delay: 2s;

        }


        .circle-four {

            width: 220px;

            height: 220px;

            bottom: 20%;

            right: -120px;

            animation-delay: 3s;

        }


        /* =====================================================
           CARD
        ===================================================== */

        .forgot-card {

            position: relative;

            z-index: 5;

            width: calc(100% - 40px);

            max-width: 520px;

            margin: auto;

            padding: 40px;

            background:
                rgba(
                    255,
                    255,
                    255,
                    0.97
                );

            border-radius: 25px;

            box-shadow:
                0 25px 60px
                rgba(
                    0,
                    0,
                    0,
                    0.25
                );

            animation:
                slideUp .8s ease;

        }


        /* =====================================================
           LOGO
        ===================================================== */

        .logo {

            text-align: center;

            font-size: 35px;

            font-weight: 800;

            background:
                linear-gradient(
                    135deg,
                    #0d6efd,
                    #198754
                );

            -webkit-background-clip: text;

            -webkit-text-fill-color: transparent;

            margin-bottom: 8px;

        }


        .subtitle {

            text-align: center;

            color: #6c757d;

            margin-bottom: 28px;

            line-height: 1.6;

        }


        /* =====================================================
           ICON
        ===================================================== */

        .forgot-icon {

            width: 72px;

            height: 72px;

            margin: 0 auto 20px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 50%;

            color: white;

            font-size: 30px;

            background:
                linear-gradient(
                    135deg,
                    #0d6efd,
                    #198754
                );

            box-shadow:
                0 10px 30px
                rgba(
                    13,
                    110,
                    253,
                    .25
                );

            animation:
                iconFloat 3s ease-in-out infinite;

        }


        /* =====================================================
           TITRE
        ===================================================== */

        .forgot-title {

            text-align: center;

            color: #172033;

            font-size: 26px;

            font-weight: 800;

            margin-bottom: 10px;

        }


        /* =====================================================
           LABEL
        ===================================================== */

        .form-label {

            font-weight: 600;

            color: #25334a;

        }


        /* =====================================================
           INPUT
        ===================================================== */

        .input-wrapper {

            position: relative;

        }


        .input-icon {

            position: absolute;

            left: 16px;

            top: 50%;

            transform:
                translateY(-50%);

            color: #0d6efd;

            font-size: 18px;

            z-index: 2;

            pointer-events: none;

        }


        .form-control {

            width: 100%;

            height: 52px;

            border-radius: 12px;

            border: 2px solid #e5eaf0;

            background: #f8fafc;

            padding-left: 45px;

            transition: .3s;

        }


        .form-control:hover {

            background: white;

            border-color: #b8c9dc;

        }


        .form-control:focus {

            background: white;

            border-color: #0d6efd;

            box-shadow:
                0 0 0 4px
                rgba(
                    13,
                    110,
                    253,
                    .10
                );

        }


        /* =====================================================
           BOUTON
        ===================================================== */

        .btn-reset {

            width: 100%;

            height: 52px;

            margin-top: 22px;

            border: none;

            border-radius: 12px;

            color: white;

            font-weight: bold;

            font-size: 17px;

            background:
                linear-gradient(
                    135deg,
                    #0d6efd,
                    #198754
                );

            transition: .3s;

            box-shadow:
                0 10px 25px
                rgba(
                    13,
                    110,
                    253,
                    .25
                );

        }


        .btn-reset:hover {

            transform:
                translateY(-3px);

            box-shadow:
                0 15px 30px
                rgba(
                    0,
                    0,
                    0,
                    .18
                );

        }


        .btn-reset i {

            transition: .3s;

        }


        .btn-reset:hover i {

            transform:
                translateX(5px);

        }


        /* =====================================================
           RETOUR CONNEXION
        ===================================================== */

        .login-link {

            display: block;

            text-align: center;

            margin-top: 25px;

            color: #0d6efd;

            font-weight: 600;

            text-decoration: none;

            transition: .3s;

        }


        .login-link:hover {

            color: #198754;

        }


        /* =====================================================
           RETOUR ACCUEIL
        ===================================================== */

        .home-link {

            display: block;

            text-align: center;

            margin-top: 15px;

            color: #6c757d;

            text-decoration: none;

            font-size: 14px;

            transition: .3s;

        }


        .home-link:hover {

            color: #0d6efd;

        }


        /* =====================================================
           ERREURS
        ===================================================== */

        .error-message {

            color: #dc3545;

            font-size: 14px;

            margin-top: 6px;

        }


        /* =====================================================
           ANIMATIONS
        ===================================================== */

        @keyframes slideUp {

            from {

                opacity: 0;

                transform:
                    translateY(40px);

            }

            to {

                opacity: 1;

                transform:
                    translateY(0);

            }

        }


        @keyframes float {

            0%,
            100% {

                transform:
                    translateY(0);

            }

            50% {

                transform:
                    translateY(-25px);

            }

        }


        @keyframes iconFloat {

            0%,
            100% {

                transform:
                    translateY(0);

            }

            50% {

                transform:
                    translateY(-7px);

            }

        }


        /* =====================================================
           TABLETTE
        ===================================================== */

        @media (max-width: 768px) {

            body {

                padding:
                    25px 0;

            }


            .forgot-card {

                width: calc(100% - 30px);

                padding: 35px;

            }

        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media (max-width: 576px) {

            body {

                padding:
                    20px 0;

                align-items: center;

            }


            .forgot-card {

                width: calc(100% - 24px);

                padding:
                    30px 22px;

                border-radius: 21px;

            }


            .forgot-icon {

                width: 62px;

                height: 62px;

                font-size: 26px;

                margin-bottom: 16px;

            }


            .logo {

                font-size: 30px;

            }


            .forgot-title {

                font-size: 22px;

            }


            .subtitle {

                font-size: 14px;

                margin-bottom: 24px;

            }


            .form-control {

                height: 50px;

            }


            .btn-reset {

                height: 50px;

                font-size: 16px;

            }


            .circle-three,
            .circle-four {

                display: none;

            }

        }


        /* =====================================================
           PETIT TÉLÉPHONE
        ===================================================== */

        @media (max-width: 380px) {

            body {

                padding: 15px 0;

            }


            .forgot-card {

                width: calc(100% - 20px);

                padding:
                    26px 17px;

                border-radius: 19px;

            }


            .logo {

                font-size: 27px;

            }


            .forgot-title {

                font-size: 20px;

            }


            .subtitle {

                font-size: 13px;

            }

        }


        /* =====================================================
           PETITE HAUTEUR
        ===================================================== */

        @media (max-height: 600px) {

            body {

                align-items: flex-start;

                overflow-y: auto;

                padding-top: 25px;

            }

        }

    </style>

</head>


<body>


<!-- =====================================================
     CERCLES
===================================================== -->

<div class="background-circle circle-one"></div>

<div class="background-circle circle-two"></div>

<div class="background-circle circle-three"></div>

<div class="background-circle circle-four"></div>



<!-- =====================================================
     CARTE
===================================================== -->

<div class="forgot-card">


    <!-- =================================================
         ICON
    ================================================== -->

    <div class="forgot-icon">

        <i class="bi bi-shield-lock-fill"></i>

    </div>



    <!-- =================================================
         LOGO
    ================================================== -->

    <div class="logo">

        <img src="{{ asset('images/logo-chezmoi.svg') }}" alt="CHEZMW" style="max-width: 260px; width: 100%; height: auto; display: block; margin: 0 auto 12px;">

    </div>



    <!-- =================================================
         TITRE
    ================================================== -->

    <h1 class="forgot-title">

        Mot de passe oublié ?

    </h1>



    <!-- =================================================
         DESCRIPTION
    ================================================== -->

    <p class="subtitle">

        Pas de problème 👋<br>

        Entrez votre adresse email et nous vous
        enverrons un lien pour réinitialiser votre
        mot de passe.

    </p>



    <!-- =================================================
         MESSAGE
    ================================================== -->

    



    <!-- =================================================
         FORMULAIRE
    ================================================== -->

    <form
        method="POST"
        action="{{ route('password.email') }}"
    >

        @csrf


        <!-- EMAIL -->

        <div class="mb-3">

            <label
                for="email"
                class="form-label"
            >

                Adresse email

            </label>


            <div class="input-wrapper">

                <i
                    class="bi bi-envelope input-icon"
                ></i>


                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="form-control @error('email') is-invalid @enderror"
                    placeholder="exemple@email.com"
                    required
                    autofocus
                    autocomplete="email"
                >

            </div>


            @error('email')

                <div class="error-message">

                    {{ $message }}

                </div>

            @enderror

        </div>



        <!-- =================================================
             BOUTON
        ================================================== -->

        <button
            type="submit"
            class="btn-reset"
        >

            <i class="bi bi-envelope-arrow-up-fill"></i>

            Envoyer le lien de réinitialisation

            <i class="bi bi-arrow-right"></i>

        </button>

    </form>



    <!-- =================================================
         RETOUR CONNEXION
    ================================================== -->

    <a
        href="{{ route('login') }}"
        class="login-link"
    >

        ← Retour à la connexion

    </a>



    <!-- =================================================
         ACCUEIL
    ================================================== -->

    <a
        href="{{ route('home') }}"
        class="home-link"
    >

        Retour à l'accueil

    </a>


</div>


</body>

</html>
