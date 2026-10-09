<x-app-layout>

    <style>

        /* =====================================================
           RESET
        ===================================================== */

        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
        }


        /* =====================================================
           PAGE
        ===================================================== */

        .profile-page {
            min-height: calc(100vh - 65px);
            padding: 45px 20px 80px;
            position: relative;
            overflow: hidden;

            background:
                linear-gradient(
                    135deg,
                    #0d6efd 0%,
                    #198754 100%
                );
        }


        /* =====================================================
           CERCLES
        ===================================================== */

        .profile-circle {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            background: rgba(255,255,255,.08);
            animation: profileFloat 7s ease-in-out infinite;
        }

        .profile-circle-one {
            width: 420px;
            height: 420px;
            top: -180px;
            right: -120px;
        }

        .profile-circle-two {
            width: 320px;
            height: 320px;
            bottom: -150px;
            left: -100px;
            animation-delay: 2s;
        }

        .profile-circle-three {
            width: 150px;
            height: 150px;
            top: 45%;
            right: 5%;
            background: rgba(255,255,255,.05);
            animation-delay: 1s;
        }

        @keyframes profileFloat {
            0%, 100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-25px);
            }
        }


        /* =====================================================
           CONTAINER
        ===================================================== */

        .profile-container {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 900px;
            margin: auto;

            animation:
                profileFade .7s ease;
        }

        @keyframes profileFade {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }


        /* =====================================================
           HEADER
        ===================================================== */

        .profile-heading {
            text-align: center;
            margin-bottom: 35px;
            color: white;
        }

        .profile-heading h1 {
            margin: 0;
            font-size: clamp(30px, 5vw, 44px);
            font-weight: 800;
        }

        .profile-heading h1 span {
            background:
                linear-gradient(
                    135deg,
                    #ffffff,
                    #d9fff0
                );

            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .profile-heading p {
            margin: 10px auto 0;
            max-width: 600px;
            color: rgba(255,255,255,.85);
            font-size: 15px;
        }


        /* =====================================================
           CARTE
        ===================================================== */

        .profile-card {
            background: rgba(255,255,255,.98);
            padding: 30px;
            margin-bottom: 25px;

            border-radius: 24px;

            border: 1px solid rgba(255,255,255,.4);

            box-shadow:
                0 25px 60px
                rgba(0,0,0,.20);

            transition:
                transform .3s ease,
                box-shadow .3s ease;
        }

        .profile-card:hover {
            transform: translateY(-3px);

            box-shadow:
                0 30px 70px
                rgba(0,0,0,.25);
        }


        /* =====================================================
           HEADER CARTE
        ===================================================== */

        .profile-card-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 28px;
        }

        .profile-card-icon {
            width: 55px;
            height: 55px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 16px;

            color: white;
            font-size: 22px;

            background:
                linear-gradient(
                    135deg,
                    #0d6efd,
                    #198754
                );

            box-shadow:
                0 8px 20px
                rgba(13,110,253,.25);
        }

        .profile-card-header h2 {
            margin: 0;

            color: #172033;

            font-size: 21px;
            font-weight: 800;
        }

        .profile-card-header p {
            margin: 5px 0 0;

            color: #6c757d;

            font-size: 13px;
        }


        /* =====================================================
           FORMULAIRES BREEZE
        ===================================================== */

        .profile-card form {
            width: 100%;
        }

        .profile-card label {
            color: #172033;
            font-weight: 600;
        }

        .profile-card input,
        .profile-card select,
        .profile-card textarea {
            width: 100%;

            min-height: 50px;

            border-radius: 12px !important;

            border: 1px solid #dce2e8 !important;

            transition:
                border-color .25s ease,
                box-shadow .25s ease,
                transform .25s ease;
        }

        .profile-card input:focus,
        .profile-card select:focus,
        .profile-card textarea:focus {
            border-color:
                #0d6efd !important;

            box-shadow:
                0 0 0 4px
                rgba(13,110,253,.10) !important;

            outline: none;
        }


        /* =====================================================
           BOUTONS
        ===================================================== */

        .profile-card button {
            min-height: 46px;

            border-radius: 12px !important;

            font-weight: 700;

            transition:
                transform .25s ease,
                box-shadow .25s ease;
        }

        .profile-card button:hover {
            transform: translateY(-2px);

            box-shadow:
                0 10px 25px
                rgba(13,110,253,.20);
        }


        /* =====================================================
           BOUTON PRINCIPAL
        ===================================================== */

        .profile-card button[type="submit"] {
            background:
                linear-gradient(
                    135deg,
                    #0d6efd,
                    #198754
                ) !important;

            color: white !important;

            border: none !important;

            padding:
                10px 25px;
        }


        /* =====================================================
           MESSAGES
        ===================================================== */

        .profile-card .text-green-600,
        .profile-card .text-green-400 {
            color: #198754 !important;
            font-weight: 600;
        }

        .profile-card .text-red-600,
        .profile-card .text-red-400 {
            color: #dc3545 !important;
        }


        /* =====================================================
           EMAIL NON VÉRIFIÉ
        ===================================================== */

        .profile-card a {
            color: #0d6efd;
            font-weight: 600;
        }

        .profile-card a:hover {
            color: #198754;
        }


        /* =====================================================
           SUPPRESSION
        ===================================================== */

        .danger-card {
            border:
                2px solid
                rgba(220,53,69,.12);
        }

        .danger-card .profile-card-icon {
            background:
                linear-gradient(
                    135deg,
                    #dc3545,
                    #b02a37
                );

            box-shadow:
                0 8px 20px
                rgba(220,53,69,.20);
        }

        .danger-card button[type="submit"] {
            background:
                linear-gradient(
                    135deg,
                    #dc3545,
                    #b02a37
                ) !important;
        }


        /* =====================================================
           DARK MODE
        ===================================================== */

        .dark .profile-page {
            background:
                linear-gradient(
                    135deg,
                    #101827,
                    #10221a
                );
        }

        .dark .profile-card {
            background:
                rgba(31,41,55,.98);

            border-color:
                rgba(255,255,255,.06);
        }

        .dark .profile-card-header h2 {
            color: #f8fafc;
        }

        .dark .profile-card-header p {
            color: #cbd5e1;
        }

        .dark .profile-card label {
            color: #f1f5f9;
        }

        .dark .profile-card input,
        .dark .profile-card select,
        .dark .profile-card textarea {
            background: #111827 !important;
            color: white !important;
            border-color: #374151 !important;
        }

        .dark .profile-card input:focus,
        .dark .profile-card select:focus,
        .dark .profile-card textarea:focus {
            border-color: #0d6efd !important;
        }


        /* =====================================================
           TABLETTE
        ===================================================== */

        @media (max-width: 768px) {

            .profile-page {
                padding:
                    35px 16px 60px;
            }

            .profile-container {
                max-width: 100%;
            }

            .profile-card {
                padding: 25px;
                border-radius: 20px;
            }

        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media (max-width: 576px) {

            .profile-page {
                padding:
                    25px 12px 45px;
            }

            .profile-heading {
                margin-bottom: 25px;
            }

            .profile-heading h1 {
                font-size: 30px;
            }

            .profile-heading p {
                font-size: 14px;
            }

            .profile-card {
                padding: 20px 17px;
                margin-bottom: 18px;
                border-radius: 18px;
            }

            .profile-card-header {
                gap: 12px;
                margin-bottom: 22px;
            }

            .profile-card-icon {
                width: 45px;
                height: 45px;
                border-radius: 12px;
                font-size: 18px;
            }

            .profile-card-header h2 {
                font-size: 17px;
            }

            .profile-card-header p {
                font-size: 12px;
            }

            .profile-circle-one {
                width: 220px;
                height: 220px;
            }

            .profile-circle-two {
                width: 170px;
                height: 170px;
            }

        }


        /* =====================================================
           PETIT TÉLÉPHONE
        ===================================================== */

        @media (max-width: 380px) {

            .profile-page {
                padding:
                    18px 9px 35px;
            }

            .profile-card {
                padding:
                    18px 14px;
            }

            .profile-heading h1 {
                font-size: 26px;
            }

        }

    </style>


    <!-- =====================================================
         PAGE
    ===================================================== -->

    <div class="profile-page">

        <!-- CERCLES -->

        <div class="profile-circle profile-circle-one"></div>

        <div class="profile-circle profile-circle-two"></div>

        <div class="profile-circle profile-circle-three"></div>


        <div class="profile-container">


            <!-- =================================================
                 EN-TÊTE
            ================================================= -->

            <div class="profile-heading">

                <h1>
                    Mon <span>profil</span>
                </h1>

                <p>
                    Gérez vos informations personnelles,
                    votre mot de passe et votre compte.
                </p>

            </div>


            <!-- =================================================
                 INFORMATIONS PERSONNELLES
            ================================================= -->

            <div class="profile-card">

                <div class="profile-card-header">

                    <div class="profile-card-icon">
                        <i class="bi bi-person-fill"></i>
                    </div>

                    <div>

                        <h2>
                            Informations du compte
                        </h2>

                        <p>
                            Modifiez votre nom et votre adresse e-mail.
                        </p>

                    </div>

                </div>

                @include(
                    'profile.partials.update-profile-information-form'
                )

            </div>


            <!-- =================================================
                 MOT DE PASSE
            ================================================= -->

            <div class="profile-card">

                <div class="profile-card-header">

                    <div class="profile-card-icon">
                        <i class="bi bi-shield-lock-fill"></i>
                    </div>

                    <div>

                        <h2>
                            Modifier le mot de passe
                        </h2>

                        <p>
                            Utilisez un mot de passe long et sécurisé.
                        </p>

                    </div>

                </div>

                @include(
                    'profile.partials.update-password-form'
                )

            </div>


            <!-- =================================================
                 SUPPRESSION
            ================================================= -->

            <div class="profile-card danger-card">

                <div class="profile-card-header">

                    <div class="profile-card-icon">
                        <i class="bi bi-trash3-fill"></i>
                    </div>

                    <div>

                        <h2>
                            Supprimer le compte
                        </h2>

                        <p>
                            Cette action est définitive.
                        </p>

                    </div>

                </div>

                @include(
                    'profile.partials.delete-user-form'
                )

            </div>


        </div>

    </div>

</x-app-layout>