<section class="chezmoi-profile-form">

    <style>

        /* =====================================================
           FORMULAIRE
        ===================================================== */

        .chezmoi-profile-form {
            width: 100%;
        }


        /* =====================================================
           LABEL
        ===================================================== */

        .chezmoi-label {
            display: block;
            margin-bottom: 8px;
            color: #25334a;
            font-size: 14px;
            font-weight: 700;
        }


        /* =====================================================
           INPUT WRAPPER
        ===================================================== */

        .chezmoi-input-wrapper {
            position: relative;
            width: 100%;
        }


        /* =====================================================
           ICÔNE
        ===================================================== */

        .chezmoi-input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #0d6efd;
            font-size: 18px;
            pointer-events: none;
            z-index: 2;
        }


        /* =====================================================
           INPUT
        ===================================================== */

        .chezmoi-input {
            width: 100%;
            height: 52px;

            padding: 0 16px 0 46px;

            border: 2px solid #e5eaf0;
            border-radius: 12px;

            background: #f8fafc;
            color: #172033;

            font-size: 15px;

            outline: none;

            transition:
                border-color .25s ease,
                box-shadow .25s ease,
                background .25s ease,
                transform .25s ease;
        }


        .chezmoi-input:hover {
            background: #fff;
            border-color: #b8c9dc;
        }


        .chezmoi-input:focus {
            background: #fff;
            border-color: #0d6efd;

            box-shadow:
                0 0 0 4px
                rgba(13,110,253,.10);

            transform: translateY(-1px);
        }


        /* =====================================================
           ERREURS
        ===================================================== */

        .chezmoi-error {
            margin-top: 7px;
            color: #dc3545;
            font-size: 13px;
        }


        /* =====================================================
           VÉRIFICATION EMAIL
        ===================================================== */

        .verification-box {
            margin-top: 15px;
            padding: 16px;

            border-radius: 13px;

            background:
                linear-gradient(
                    135deg,
                    rgba(13,110,253,.06),
                    rgba(25,135,84,.06)
                );

            border:
                1px solid
                rgba(13,110,253,.10);
        }


        .verification-message {
            margin: 0;
            color: #495057;
            font-size: 14px;
            line-height: 1.6;
        }


        .verification-button {
            display: inline-flex;
            align-items: center;
            gap: 7px;

            margin-top: 9px;

            padding: 0;

            border: none;
            background: transparent;

            color: #0d6efd;

            font-size: 13px;
            font-weight: 700;

            cursor: pointer;

            transition: color .25s ease;
        }


        .verification-button:hover {
            color: #198754;
        }


        .verification-success {
            margin-top: 10px;

            color: #198754;

            font-size: 13px;
            font-weight: 600;
        }


        /* =====================================================
           ACTIONS
        ===================================================== */

        .chezmoi-form-actions {
            display: flex;
            align-items: center;
            gap: 15px;

            margin-top: 25px;
        }


        /* =====================================================
           BOUTON ENREGISTRER
        ===================================================== */

        .chezmoi-save-button {
            min-width: 140px;
            min-height: 48px;

            padding: 0 24px;

            border: none;
            border-radius: 12px;

            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            color: white;

            background:
                linear-gradient(
                    135deg,
                    #0d6efd,
                    #198754
                );

            font-size: 15px;
            font-weight: 700;

            cursor: pointer;

            box-shadow:
                0 8px 20px
                rgba(13,110,253,.18);

            transition:
                transform .25s ease,
                box-shadow .25s ease;
        }


        .chezmoi-save-button:hover {
            transform: translateY(-2px);

            box-shadow:
                0 12px 28px
                rgba(13,110,253,.25);
        }


        .chezmoi-save-button:active {
            transform: translateY(0);
        }


        /* =====================================================
           MESSAGE SAUVEGARDÉ
        ===================================================== */

        .saved-message {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            color: #198754;

            font-size: 14px;
            font-weight: 600;

            animation: savedFade .3s ease;
        }


        @keyframes savedFade {

            from {
                opacity: 0;
                transform: translateY(5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }

        }


        /* =====================================================
           DARK MODE
        ===================================================== */

        .dark .chezmoi-label {
            color: #e5e7eb;
        }


        .dark .chezmoi-input {
            background: #111827;
            border-color: #374151;
            color: #f9fafb;
        }


        .dark .chezmoi-input:hover {
            background: #172033;
            border-color: #4b5563;
        }


        .dark .chezmoi-input:focus {
            background: #172033;
            border-color: #0d6efd;
        }


        .dark .verification-box {
            background:
                rgba(13,110,253,.08);

            border-color:
                rgba(255,255,255,.08);
        }


        .dark .verification-message {
            color: #d1d5db;
        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media (max-width: 576px) {

            .chezmoi-input {
                height: 50px;
                font-size: 14px;
            }


            .chezmoi-form-actions {
                flex-direction: column;
                align-items: stretch;
                gap: 12px;
            }


            .chezmoi-save-button {
                width: 100%;
                height: 50px;
            }


            .saved-message {
                justify-content: center;
            }

        }

    </style>


    <!-- =====================================================
         FORMULAIRE VÉRIFICATION
    ===================================================== -->

    <form
        id="send-verification"
        method="post"
        action="{{ route('verification.send') }}"
    >

        @csrf

    </form>


    <!-- =====================================================
         FORMULAIRE PROFIL
    ===================================================== -->

    <form
        method="post"
        action="{{ route('profile.update') }}"
    >

        @csrf

        @method('patch')


        <!-- =================================================
             NOM
        ================================================== -->

        <div style="margin-bottom:20px;">

            <label
                for="name"
                class="chezmoi-label"
            >
                Nom complet
            </label>


            <div class="chezmoi-input-wrapper">

                <i class="bi bi-person chezmoi-input-icon"></i>

                <input
                    id="name"
                    name="name"
                    type="text"
                    class="chezmoi-input"
                    value="{{ old('name', $user->name) }}"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Votre nom complet"
                >

            </div>


            @if ($errors->get('name'))

                <div class="chezmoi-error">
                    {{ $errors->first('name') }}
                </div>

            @endif

        </div>


        <!-- =================================================
             EMAIL
        ================================================== -->

        <div>

            <label
                for="email"
                class="chezmoi-label"
            >
                Adresse email
            </label>


            <div class="chezmoi-input-wrapper">

                <i class="bi bi-envelope chezmoi-input-icon"></i>

                <input
                    id="email"
                    name="email"
                    type="email"
                    class="chezmoi-input"
                    value="{{ old('email', $user->email) }}"
                    required
                    autocomplete="username"
                    placeholder="exemple@email.com"
                >

            </div>


            @if ($errors->get('email'))

                <div class="chezmoi-error">
                    {{ $errors->first('email') }}
                </div>

            @endif


            <!-- =============================================
                 VÉRIFICATION
            ============================================== -->

            @if (
                $user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail
                &&
                ! $user->hasVerifiedEmail()
            )

                <div class="verification-box">

                    <p class="verification-message">

                        <i
                            class="bi bi-exclamation-circle-fill"
                            style="color:#0d6efd;"
                        ></i>

                        Votre adresse email n'est pas encore vérifiée.

                    </p>


                    <button
                        form="send-verification"
                        class="verification-button"
                    >

                        <i class="bi bi-send"></i>

                        Renvoyer l'email de vérification

                    </button>


                    @if (
                        session('status')
                        ===
                        'verification-link-sent'
                    )

                        <p class="verification-success">

                            <i class="bi bi-check-circle-fill"></i>

                            Un nouveau lien de vérification
                            a été envoyé à votre adresse email.

                        </p>

                    @endif

                </div>

            @endif

        </div>


        <!-- =================================================
             BOUTON
        ================================================== -->

        <div class="chezmoi-form-actions">

            <button
                type="submit"
                class="chezmoi-save-button"
            >

                <i class="bi bi-check2-circle"></i>

                Enregistrer

            </button>


            @if (
                session('status')
                ===
                'profile-updated'
            )

                <p
                    class="saved-message"
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="
                        setTimeout(
                            () => show = false,
                            2500
                        )
                    "
                >

                    <i class="bi bi-check-circle-fill"></i>

                    Modifications enregistrées

                </p>

            @endif

        </div>

    </form>

</section>