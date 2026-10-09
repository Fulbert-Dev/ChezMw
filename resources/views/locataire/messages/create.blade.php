<x-app-layout>
    <x-app-sidebar />

    <style>

        /* =====================================================
           PAGE
        ===================================================== */

        .contact-page {

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

        .contact-header {

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


        .contact-header::after {

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


        .contact-header h2 {

            margin: 0;

            font-size: 28px;

            font-weight: 800;

            position: relative;

            z-index: 2;

        }


        .contact-header p {

            margin-top: 7px;

            opacity: .9;

            position: relative;

            z-index: 2;

        }


        /* =====================================================
           CARD
        ===================================================== */

        .contact-card {

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
           LOGEMENT
        ===================================================== */

        .property-section {

            padding: 30px;

            border-bottom:
                1px solid #eee;

        }


        .property-icon {

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


        .property-title {

            font-size: 23px;

            font-weight: 800;

            color: #212529;

        }


        .property-location {

            margin-top: 7px;

            color: #6c757d;

            font-size: 14px;

        }


        .property-price {

            display: inline-block;

            margin-top: 12px;

            padding:
                8px 15px;

            border-radius: 50px;

            background:
                linear-gradient(
                    135deg,
                    #e9f7ef,
                    #eff6ff
                );

            color: #198754;

            font-size: 16px;

            font-weight: 800;

        }


        /* =====================================================
           FORMULAIRE
        ===================================================== */

        .contact-form {

            padding:
                30px;

        }


        .form-title {

            font-size: 19px;

            font-weight: 800;

            color: #212529;

            margin-bottom: 20px;

        }


        .form-label-custom {

            display: block;

            font-size: 15px;

            font-weight: 800;

            color: #343a40;

            margin-bottom: 10px;

        }


        .contact-textarea {

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


        .contact-textarea:focus {

            border-color:
                #0d6efd;

            box-shadow:
                0 0 0 4px
                rgba(13,110,253,.10);

        }


        .character-info {

            display: flex;

            align-items: center;

            justify-content: space-between;

            margin-top: 8px;

            color: #adb5bd;

            font-size: 12px;

        }


        /* =====================================================
           ERREURS
        ===================================================== */

        .error-box {

            margin:
                25px 30px 0;

            padding:
                16px 20px;

            background:
                #fff5f5;

            border:
                1px solid #f5c2c7;

            color:
                #842029;

            border-radius: 15px;

            animation:
                shake .4s ease;

        }


        .error-box ul {

            margin: 0;

            padding-left: 20px;

        }


        /* =====================================================
           ACTIONS
        ===================================================== */

        .form-actions {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;

            margin-top: 25px;

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


        @keyframes shake {

            0%,100% {

                transform:
                    translateX(0);

            }

            25% {

                transform:
                    translateX(-5px);

            }

            75% {

                transform:
                    translateX(5px);

            }

        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media(max-width: 768px) {

            .contact-page {

                padding:
                    25px 15px;

            }


            .contact-header {

                padding:
                    23px;

            }


            .contact-header h2 {

                font-size: 24px;

            }


            .property-section {

                padding:
                    23px;

            }


            .contact-form {

                padding:
                    23px;

            }


            .error-box {

                margin:
                    20px 23px 0;

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

    <div class="contact-page">


        <div class="max-w-3xl mx-auto">


            <!-- =================================================
                 HEADER
            ================================================== -->

            <div class="contact-header">

                <h2>

                    💬 Contacter le bailleur

                </h2>

                <p>

                    Envoyez votre demande directement
                    au propriétaire du logement.

                </p>

            </div>



            <!-- =================================================
                 CARD
            ================================================== -->

            <div class="contact-card">


                <!-- =================================================
                     LOGEMENT
                ================================================== -->

                <div class="property-section">


                    <div class="flex items-center gap-4">


                        <!-- ICÔNE -->

                        <div class="property-icon">

                            🏠

                        </div>


                        <!-- INFORMATIONS -->

                        <div>

                            <div class="property-title">

                                {{ $logement->titre }}

                            </div>


                            <div class="property-location">

                                <i class="bi bi-geo-alt-fill"></i>

                                {{ $logement->quartier }},
                                {{ $logement->ville }}

                            </div>


                            <div class="property-price">

                                <i class="bi bi-cash-coin"></i>

                                {{ number_format(
                                    $logement->prix,
                                    0,
                                    ',',
                                    ' '
                                ) }}

                                FCFA / mois

                            </div>

                        </div>


                    </div>

                </div>



                <!-- =================================================
                     ERREURS
                ================================================== -->

                @if ($errors->any())

                    <div class="error-box">

                        <div class="font-bold mb-2">

                            <i class="bi bi-exclamation-triangle-fill"></i>

                            Vérifiez votre message :

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
                        'messages.store',
                        $logement
                    ) }}"
                    class="contact-form"
                >

                    @csrf


                    <div class="form-title">

                        ✍️ Écrivez votre message

                    </div>


                    <div>


                        <label
                            for="contenu"
                            class="form-label-custom"
                        >

                            Votre message

                        </label>


                        <textarea
                            name="contenu"
                            id="contenu"
                            rows="7"
                            maxlength="2000"
                            required
                            class="contact-textarea"
                            placeholder="Bonjour, votre logement m'intéresse. Est-il toujours disponible ?"
                        >{{ old('contenu') }}</textarea>


                        <div class="character-info">

                            <span>

                                💡 Soyez précis dans votre demande.

                            </span>

                            <span>

                                Maximum 2000 caractères

                            </span>

                        </div>


                    </div>



                    <!-- ACTIONS -->

                    <div class="form-actions">


                        <!-- ANNULER -->

                        <a
                            href="{{ route(
                                'locataire.logements.show',
                                $logement
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

                            Envoyer le message

                        </button>


                    </div>


                </form>


            </div>


        </div>

    </div>


</x-app-layout>