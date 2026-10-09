<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-pwa-head />

    <title>Connexion - chezmw</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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

            overflow: hidden;
        }

        .background-circle {
            position: fixed;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
            animation: float 6s ease-in-out infinite;
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

        .login-card {
            position: relative;
            z-index: 2;

            width: 100%;
            max-width: 450px;

            background: rgba(255, 255, 255, 0.97);

            padding: 40px;

            border-radius: 25px;

            box-shadow:
                0 25px 60px rgba(0, 0, 0, 0.25);

            animation: slideUp 0.8s ease;
        }

        .logo {
            text-align: center;
            font-size: 35px;
            font-weight: 800;

            background: linear-gradient(
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

        .form-label {
            font-weight: 600;
        }

        .form-control {
            height: 52px;
            border-radius: 12px;
            padding-right: 45px;
        }

        .password-wrapper {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);

            border: none;
            background: transparent;

            color: #6c757d;

            cursor: pointer;

            font-size: 20px;
        }

        .toggle-password:hover {
            color: #0d6efd;
        }

        .btn-login {
            width: 100%;
            height: 52px;

            border: none;
            border-radius: 12px;

            color: white;
            font-weight: bold;
            font-size: 17px;

            background: linear-gradient(
                135deg,
                #0d6efd,
                #198754
            );

            transition: 0.3s;
        }

        .btn-login:hover {
            transform: translateY(-3px);

            box-shadow:
                0 10px 25px rgba(13, 110, 253, 0.3);
        }

        .register-link {
            text-align: center;
            margin-top: 25px;
        }

        .register-link a {
            color: #0d6efd;
            font-weight: bold;
            text-decoration: none;
        }

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

        .error-message {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
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

        @media (max-width: 500px) {

            .login-card {
                margin: 20px;
                padding: 30px 25px;
            }

            .logo {
                font-size: 30px;
            }
        }
    </style>
</head>

<body>

<div class="background-circle circle-one"></div>
<div class="background-circle circle-two"></div>


<div class="login-card">

    <div class="logo">
        <img src="{{ asset('images/ChatGPT Image 7 sept. 2026, 21_37_28.png') }}" alt="CHEZMW" style="max-width: 260px; width: 100%; height: auto; display: block; margin: 0 auto 12px;">
    </div>

    <p class="subtitle">
        Heureux de vous revoir 👋
    </p>


    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif


    <form method="POST" action="{{ route('login') }}">

        @csrf


        <!-- EMAIL -->

        <div class="mb-3">

            <label for="email" class="form-label">
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
                autofocus
                autocomplete="username"
            >

            @error('email')
                <div class="error-message">
                    {{ $message }}
                </div>
            @enderror

        </div>


        <!-- PASSWORD -->

        <div class="mb-3">

            <label for="password" class="form-label">
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
                    autocomplete="current-password"
                >

                <button
                    type="button"
                    class="toggle-password"
                    onclick="togglePassword('password', 'eyeIcon')"
                >
                    <i id="eyeIcon" class="bi bi-eye"></i>
                </button>

            </div>

            @error('password')
                <div class="error-message">
                    {{ $message }}
                </div>
            @enderror

        </div>


        <!-- REMEMBER -->

        <div class="form-check mb-4">

            <input
                class="form-check-input"
                type="checkbox"
                name="remember"
                id="remember"
            >

            <label
                class="form-check-label"
                for="remember"
            >
                Se souvenir de moi
            </label>

        </div>


        <!-- BUTTON -->

        <button
            type="submit"
            class="btn-login"
        >
            <i class="bi bi-box-arrow-in-right"></i>
            Se connecter
        </button>

    </form>


    @if (Route::has('password.request'))

        <div class="text-center mt-3">

            <a
                href="{{ route('password.request') }}"
                class="text-decoration-none"
            >
                Mot de passe oublié ?
            </a>

        </div>

    @endif


    <div class="register-link">

        Vous n'avez pas encore de compte ?

        <a href="{{ route('register') }}">
            S'inscrire
        </a>

    </div>


    <a
        href="{{ route('home') }}"
        class="home-link"
    >
        ← Retour à l'accueil
    </a>

</div>


<script>

function togglePassword(inputId, iconId) {

    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);

    if (input.type === "password") {

        input.type = "text";

        icon.classList.remove("bi-eye");
        icon.classList.add("bi-eye-slash");

    } else {

        input.type = "password";

        icon.classList.remove("bi-eye-slash");
        icon.classList.add("bi-eye");

    }
}

</script>

</body>
</html>
