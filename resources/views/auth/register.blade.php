<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <x-pwa-head />

    <title>Inscription - CHEZMW</title>
    <link
        rel="icon"
        type="image/svg+xml"
        href="{{ asset('images/ChatGPT Image 7 sept. 2026, 21_37_28 - Copie.png') }}"
    >


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

        * {
            box-sizing: border-box;
        }


        body {

            margin: 0;

            min-height: 100vh;

            font-family: Arial, sans-serif;

            background: linear-gradient(
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


        /* =====================================================
           CARTE
        ===================================================== */

        .register-card {

            position: relative;

            z-index: 2;

            width: 100%;

            max-width: 520px;

            background:
                rgba(
                    255,
                    255,
                    255,
                    0.97
                );

            padding: 40px;

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
                slideUp 0.8s ease;

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

        }


        .subtitle {

            text-align: center;

            color: #6c757d;

            margin-bottom: 30px;

        }


        /* =====================================================
           LABEL
        ===================================================== */

        .form-label {

            font-weight: 600;

        }


        /* =====================================================
           INPUT
        ===================================================== */

        .form-control,
        .form-select {

            height: 52px;

            border-radius: 12px;

        }


        /* =====================================================
           PASSWORD
        ===================================================== */

        .password-wrapper {

            position: relative;

        }


        .password-wrapper .form-control {

            padding-right: 50px;

        }


        .toggle-password {

            position: absolute;

            right: 15px;

            top: 50%;

            transform:
                translateY(-50%);

            border: none;

            background: transparent;

            color: #6c757d;

            cursor: pointer;

            font-size: 20px;

        }


        .toggle-password:hover {

            color: #0d6efd;

        }


        /* =====================================================
           PROFIL
        ===================================================== */

        .profile-icon {

            margin-right: 5px;

        }


        /* =====================================================
           BOUTON
        ===================================================== */

        .btn-register {

            width: 100%;

            height: 52px;

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

            transition: 0.3s;

        }


        .btn-register:hover {

            transform:
                translateY(-3px);

            box-shadow:
                0 10px 25px
                rgba(
                    13,
                    110,
                    253,
                    0.3
                );

        }


        /* =====================================================
           LOGIN LINK
        ===================================================== */

        .login-link {

            text-align: center;

            margin-top: 25px;

        }


        .login-link a {

            color: #0d6efd;

            font-weight: bold;

            text-decoration: none;

        }


        .login-link a:hover {

            color: #198754;

        }


        /* =====================================================
           HOME
        ===================================================== */

        .home-link {

            display: block;

            text-align: center;

            margin-top: 20px;

            color: #6c757d;

            text-decoration: none;

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

            margin-top: 5px;

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


        /* =====================================================
           MOBILE
        ===================================================== */

        @media (max-width: 500px) {

            body {

                padding:
                    20px 0;

                overflow-y: auto;

            }


            .register-card {

                margin: 20px;

                padding:
                    30px 25px;

            }


            .logo {

                font-size: 30px;

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



<!-- =====================================================
     CARD
===================================================== -->

<div class="register-card">


    <!-- LOGO -->

    <div class="logo">

        <img src="{{ asset('images/ChatGPT Image 7 sept. 2026, 21_37_28.png') }}" alt="CHEZMW" style="max-width: 260px; width: 100%; height: auto; display: block; margin: 0 auto 12px;">

    </div>


    <p class="subtitle">

        Créez votre compte gratuitement ✨

    </p>



    <!-- =================================================
         FORMULAIRE
    ================================================== -->

    <form
        method="POST"
        action="{{ route('register') }}"
    >

        @csrf



        <!-- =========================
             NOM
        ========================== -->

        <div class="mb-3">

            <label
                for="name"
                class="form-label"
            >

                Nom complet

            </label>


            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name') }}"
                class="form-control @error('name') is-invalid @enderror"
                placeholder="Exemple : Jean Dupont"
                required
                autofocus
                autocomplete="name"
            >


            @error('name')

                <div class="error-message">

                    {{ $message }}

                </div>

            @enderror

        </div>



        <!-- =========================
             EMAIL
        ========================== -->

        <div class="mb-3">

            <label
                for="email"
                class="form-label"
            >

                Adresse email

            </label>


            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="form-control @error('email') is-invalid @enderror"
                placeholder="exemple@email.com"
                required
                autocomplete="username"
            >


            @error('email')

                <div class="error-message">

                    {{ $message }}

                </div>

            @enderror

        </div>



        <!-- =========================
             PROFIL
        ========================== -->

        <div class="mb-3">

            <label
                for="role"
                class="form-label"
            >

                Quel est votre profil ?

            </label>


            <select
                id="role"
                name="role"
                class="form-select @error('role') is-invalid @enderror"
                required
            >

                <option value="">

                    -- Choisissez votre profil --

                </option>


                <option
                    value="locataire"
                    {{ old('role') === 'locataire'
                        ? 'selected'
                        : '' }}
                >

                    🏠 Je cherche un logement

                </option>


                <option
                    value="bailleur"
                    {{ old('role') === 'bailleur'
                        ? 'selected'
                        : '' }}
                >

                    🏢 Je propose un logement

                </option>

            </select>


            @error('role')

                <div class="error-message">

                    {{ $message }}

                </div>

            @enderror

        </div>



        <!-- =========================
             TYPE DE COMPTE
        ========================== -->

        <div
            class="mb-3"
            id="accountTypeContainer"
            style="display: none;"
        >

            <label
                for="account_type"
                class="form-label"
            >

                Type de compte

            </label>


            <select
                id="account_type"
                name="account_type"
                class="form-select @error('account_type') is-invalid @enderror"
            >

                <option value="">

                    -- Choisissez le type --

                </option>


                <option
                    value="particulier"
                    {{ old('account_type') === 'particulier'
                        ? 'selected'
                        : '' }}
                >

                    👤 Particulier

                </option>


                <option
                    value="agence"
                    {{ old('account_type') === 'agence'
                        ? 'selected'
                        : '' }}
                >

                    🏢 Agence immobilière

                </option>

            </select>


            @error('account_type')

                <div class="error-message">

                    {{ $message }}

                </div>

            @enderror

        </div>



        <!-- =========================
             PASSWORD
        ========================== -->

        <div class="mb-3">

            <label
                for="password"
                class="form-label"
            >

                Mot de passe

            </label>


            <div class="password-wrapper">

                <input
                    id="password"
                    type="password"
                    name="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="Votre mot de passe"
                    required
                    autocomplete="new-password"
                >


                <button
                    type="button"
                    class="toggle-password"
                    onclick="
                        togglePassword(
                            'password',
                            'eyePassword'
                        )
                    "
                >

                    <i
                        id="eyePassword"
                        class="bi bi-eye"
                    ></i>

                </button>

            </div>


            @error('password')

                <div class="error-message">

                    {{ $message }}

                </div>

            @enderror

        </div>



        <!-- =========================
             CONFIRMATION
        ========================== -->

        <div class="mb-4">

            <label
                for="password_confirmation"
                class="form-label"
            >

                Confirmer le mot de passe

            </label>


            <div class="password-wrapper">

                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    class="form-control"
                    placeholder="Confirmez votre mot de passe"
                    required
                    autocomplete="new-password"
                >


                <button
                    type="button"
                    class="toggle-password"
                    onclick="
                        togglePassword(
                            'password_confirmation',
                            'eyeConfirmation'
                        )
                    "
                >

                    <i
                        id="eyeConfirmation"
                        class="bi bi-eye"
                    ></i>

                </button>

            </div>

        </div>



        <!-- =========================
             BUTTON
        ========================== -->

        <button
            type="submit"
            class="btn-register"
        >

            <i class="bi bi-person-plus-fill"></i>

            Créer mon compte

        </button>

    </form>



    <!-- =================================================
         CONNEXION
    ================================================== -->

    <div class="login-link">

        Vous avez déjà un compte ?

        <a
            href="{{ route('login') }}"
        >

            Se connecter

        </a>

    </div>



    <!-- =================================================
         ACCUEIL
    ================================================== -->

    <a
        href="{{ route('home') }}"
        class="home-link"
    >

        ← Retour à l'accueil

    </a>


</div>



<!-- =====================================================
     JAVASCRIPT
===================================================== -->

<script>


    /* =====================================================
       TYPE DE COMPTE
    ===================================================== */

    const role =
        document.getElementById('role');


    const accountTypeContainer =
        document.getElementById(
            'accountTypeContainer'
        );


    const accountType =
        document.getElementById(
            'account_type'
        );


    function updateAccountType() {

        if (role.value === 'bailleur') {

            accountTypeContainer.style.display =
                'block';

            accountType.required = true;

        } else {

            accountTypeContainer.style.display =
                'none';

            accountType.required = false;

            accountType.value = '';

        }

    }


    role.addEventListener(
        'change',
        updateAccountType
    );


    /* Restaurer après erreur */

    updateAccountType();



    /* =====================================================
       AFFICHER / CACHER MOT DE PASSE
    ===================================================== */

    function togglePassword(
        inputId,
        iconId
    ) {

        const input =
            document.getElementById(inputId);


        const icon =
            document.getElementById(iconId);


        if (input.type === 'password') {

            input.type = 'text';


            icon.classList.remove(
                'bi-eye'
            );


            icon.classList.add(
                'bi-eye-slash'
            );

        } else {

            input.type = 'password';


            icon.classList.remove(
                'bi-eye-slash'
            );


            icon.classList.add(
                'bi-eye'
            );

        }

    }

</script>


</body>

</html>
