<x-app-layout>

    <x-app-sidebar />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <style>

        /* =====================================================
           PAGE
        ===================================================== */

        .reply-page {

            min-height: calc(100vh - 65px);

            background:
                linear-gradient(
                    135deg,
                    #f0f8ff,
                    #f0fff6
                );

            padding: 40px 20px;

        }


        /* =====================================================
           HEADER
        ===================================================== */

        .reply-header {

            background:
                linear-gradient(
                    135deg,
                    #0d6efd,
                    #198754
                );

            color: white;

            border-radius: 25px;

            padding: 28px 30px;

            margin-bottom: 25px;

            box-shadow:
                0 15px 40px
                rgba(13, 110, 253, .18);

            position: relative;

            overflow: hidden;

            animation:
                slideDown .7s ease;

        }


        .reply-header::after {

            content: "";

            position: absolute;

            width: 250px;

            height: 250px;

            border-radius: 50%;

            background:
                rgba(255,255,255,.10);

            right: -90px;

            top: -120px;

            animation:
                floatCircle 5s ease-in-out infinite;

        }


        .reply-header h2 {

            margin: 0;

            font-size: 28px;

            font-weight: 800;

            position: relative;

            z-index: 2;

        }


        .reply-header p {

            margin-top: 7px;

            opacity: .9;

            position: relative;

            z-index: 2;

        }


        /* =====================================================
           CARD
        ===================================================== */

        .reply-card {

            background: white;

            border-radius: 25px;

            overflow: hidden;

            box-shadow:
                0 10px 35px
                rgba(0,0,0,.07);

            border:
                1px solid
                rgba(0,0,0,.04);

            animation:
                slideUp .8s ease;

        }


        /* =====================================================
           INFORMATIONS
        ===================================================== */

        .conversation-info {

            padding: 30px;

            border-bottom:
                1px solid #eee;

        }


        .user-avatar {

            width: 65px;

            height: 65px;

            min-width: 65px;

            border-radius: 20px;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 30px;

            color: white;

            background:
                linear-gradient(
                    135deg,
                    #0d6efd,
                    #198754
                );

            box-shadow:
                0 8px 20px
                rgba(13,110,253,.20);

        }


        .conversation-title {

            font-size: 21px;

            font-weight: 800;

            color: #212529;

        }


        .conversation-email {

            color: #6c757d;

            font-size: 14px;

            margin-top: 4px;

        }


        .property-badge {

            display: inline-flex;

            align-items: center;

            gap: 7px;

            margin-top: 12px;

            padding:
                8px 14px;

            border-radius: 50px;

            background:
                linear-gradient(
                    135deg,
                    #eff6ff,
                    #effdf5
                );

            color: #0d6efd;

            font-size: 14px;

            font-weight: 700;

        }


        /* =====================================================
           MESSAGE ORIGINAL
        ===================================================== */

        .original-message {

            margin: 25px 30px;

            padding: 22px;

            background:
                linear-gradient(
                    135deg,
                    #f8f9fa,
                    #f0fff6
                );

            border-radius: 18px;

            border-left:
                4px solid #0d6efd;

        }


        .original-label {

            font-size: 13px;

            text-transform: uppercase;

            letter-spacing: .7px;

            color: #6c757d;

            font-weight: 800;

            margin-bottom: 10px;

        }


        .original-text {

            color: #495057;

            line-height: 1.7;

            margin: 0;

            white-space: pre-line;

        }


        /* =====================================================
           ERREURS
        ===================================================== */

        .error-box {

            margin:
                0 30px 25px;

            padding: 16px 20px;

            background:
                #fff5f5;

            border:
                1px solid #f5c2c7;

            color:
                #842029;

            border-radius: 15px;

        }


        .error-box ul {

            margin: 0;

            padding-left: 20px;

        }


        /* =====================================================
           FORMULAIRE
        ===================================================== */

        .reply-form {

            padding:
                5px 30px 30px;

        }


        .form-label-custom {

            display: block;

            font-size: 15px;

            font-weight: 800;

            color: #343a40;

            margin-bottom: 10px;

        }


        .reply-textarea {

            width: 100%;

            min-height: 180px;

            padding: 16px;

            border:
                1px solid #dee2e6;

            border-radius: 16px;

            resize: vertical;

            font-size: 15px;

            line-height: 1.6;

            outline: none;

            transition:
                border .3s,
                box-shadow .3s;

        }


        .reply-textarea:focus {

            border-color:
                #0d6efd;

            box-shadow:
                0 0 0 4px
                rgba(13,110,253,.10);

        }


        .character-info {

            text-align: right;

            margin-top: 7px;

            color: #adb5bd;

            font-size: 12px;

        }


        /* =====================================================
           ACTIONS
        ===================================================== */

        .form-actions {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;

            margin-top: 22px;

        }


        .cancel-button {

            display: inline-flex;

            align-items: center;

            gap: 7px;

            padding:
                12px 20px;

            border-radius: 12px;

            background:
                #f1f3f5;

            color: #495057;

            text-decoration: none;

            font-weight: 700;

            transition: .3s;

        }


        .cancel-button:hover {

            background:
                #e9ecef;

            color: #212529;

            transform:
                translateY(-2px);

        }


        .send-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 8px;

            padding:
                12px 22px;

            border: none;

            border-radius: 12px;

            color: white;

            font-size: 15px;

            font-weight: 800;

            cursor: pointer;

            background:
                linear-gradient(
                    135deg,
                    #0d6efd,
                    #198754
                );

            transition: .3s;

        }


        .send-button:hover {

            transform:
                translateY(-3px);

            box-shadow:
                0 10px 25px
                rgba(13,110,253,.25);

        }


        /* =====================================================
           ANIMATIONS
        ===================================================== */

        @keyframes slideDown {

            from {

                opacity: 0;

                transform:
                    translateY(-25px);

            }

            to {

                opacity: 1;

                transform:
                    translateY(0);

            }

        }


        @keyframes slideUp {

            from {

                opacity: 0;

                transform:
                    translateY(35px);

            }

            to {

                opacity: 1;

                transform:
                    translateY(0);

            }

        }


        @keyframes floatCircle {

            0%,100% {

                transform:
                    translateY(0);

            }

            50% {

                transform:
                    translateY(20px);

            }

        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media(max-width: 768px) {

            .reply-page {

                padding:
                    25px 15px;

            }


            .reply-header {

                padding:
                    23px;

            }


            .reply-header h2 {

                font-size: 24px;

            }


            .conversation-info {

                padding:
                    23px;

            }


            .original-message {

                margin:
                    20px 23px;

            }


            .error-box {

                margin:
                    0 23px 20px;

            }


            .reply-form {

                padding:
                    5px 23px 25px;

            }


            .form-actions {

                flex-direction:
                    column-reverse;

            }


            .cancel-button,
            .send-button {

                width: 100%;

                justify-content: center;

            }

        }

    </style>


    <!-- =====================================================
         PAGE
    ===================================================== -->

    <div class="reply-page">


        <div class="max-w-3xl mx-auto">


            <!-- =================================================
                 HEADER
            ================================================== -->

            <div class="reply-header">

                <h2>

                    ↩️ Répondre au locataire

                </h2>

                <p>

                    Répondez directement à la demande
                    concernant le logement.

                </p>

            </div>



            <!-- =================================================
                 CARD
            ================================================== -->

            <div class="reply-card">


                <!-- =================================================
                     INFORMATIONS
                ================================================== -->

                <div class="conversation-info">


                    <div
                        class="flex items-center gap-4"
                    >


                        <!-- AVATAR -->

                        <div class="user-avatar">

                            <i class="bi bi-person-fill"></i>

                        </div>


                        <!-- INFOS -->

                        <div>

                            <div class="conversation-title">

                                Conversation avec
                                {{ $message->expediteur->name }}

                            </div>


                            @if($message->expediteur->email)

                                <div class="conversation-email">

                                    <i class="bi bi-envelope"></i>

                                    {{ $message->expediteur->email }}

                                </div>

                            @endif


                            @if($message->logement)

                                <div class="property-badge">

                                    🏠

                                    {{ $message->logement->titre }}

                                </div>

                            @endif

                        </div>


                    </div>

                </div>



                <!-- =================================================
                     MESSAGE ORIGINAL
                ================================================== -->

                <div class="original-message">


                    <div class="original-label">

                        <i class="bi bi-chat-left-text"></i>

                        Message du locataire

                    </div>


                    <p class="original-text">

                        {{ $message->contenu }}

                    </p>


                </div>



                <!-- =================================================
                     ERREURS
                ================================================== -->

                @if ($errors->any())

                    <div class="error-box">

                        <div class="font-bold mb-2">

                            <i class="bi bi-exclamation-triangle-fill"></i>

                            Vérifiez les informations :

                        </div>


                        <ul>

                            @foreach ($errors->all() as $error)

                                <li>

                                    {{ $error }}

                                </li>

                            @endforeach

                        </ul>

                    </div>

                @endif



                <!-- =================================================
                     FORMULAIRE
                ================================================== -->

                <form
                    method="POST"
                    action="{{ route(
                        'bailleur.messages.sendReply',
                        $message
                    ) }}"
                    class="reply-form"
                >

                    @csrf


                    <!-- TEXTAREA -->

                    <div>


                        <label
                            for="contenu"
                            class="form-label-custom"
                        >

                            ✍️ Votre réponse

                        </label>


                        <textarea
                            name="contenu"
                            id="contenu"
                            rows="7"
                            maxlength="2000"
                            required
                            class="reply-textarea"
                            placeholder="Bonjour, oui le logement est toujours disponible..."
                        >{{ old('contenu') }}</textarea>


                        <div class="character-info">

                            Maximum 2000 caractères

                        </div>


                    </div>



                    <!-- ACTIONS -->

                    <div class="form-actions">


                        <!-- ANNULER -->

                        <a
                            href="{{ route(
                                'bailleur.messages.show',
                                $message
                            ) }}"
                            class="cancel-button"
                        >

                            ←

                            Annuler

                        </a>


                        <!-- ENVOYER -->

                        <button
                            type="submit"
                            class="send-button"
                        >

                            <i class="bi bi-send-fill"></i>

                            Envoyer la réponse

                        </button>


                    </div>


                </form>


            </div>


        </div>

    </div>


</x-app-layout>