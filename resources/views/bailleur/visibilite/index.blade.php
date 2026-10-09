<x-app-layout>

    <x-app-sidebar />

    <style>

        .visibilite-page {
            min-height: calc(100vh - 65px);
            padding: 40px 20px;

            background:
                radial-gradient(
                    circle at 10% 20%,
                    rgba(13,110,253,.08),
                    transparent 30%
                ),
                radial-gradient(
                    circle at 90% 80%,
                    rgba(25,135,84,.08),
                    transparent 30%
                ),
                linear-gradient(
                    135deg,
                    #f0f8ff,
                    #f0fff6
                );
        }


        .visibilite-container {
            max-width: 1100px;
            margin: auto;
        }


        .visibilite-header {
            text-align: center;
            margin-bottom: 35px;
        }


        .visibilite-header h1 {
            font-size: 32px;
            font-weight: 800;
            color: #212529;
            margin-bottom: 10px;
        }


        .visibilite-header p {
            color: #6c757d;
            margin: 0;
        }


        .logement-name {
            display: inline-block;
            margin-top: 15px;
            padding: 8px 15px;
            border-radius: 50px;

            background: rgba(13,110,253,.08);
            color: #0d6efd;

            font-weight: 700;
            font-size: 14px;
        }


        .visibilite-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }


        .visibilite-card {
            background: white;
            border-radius: 25px;
            padding: 30px;

            box-shadow:
                0 12px 35px rgba(0,0,0,.08);

            border: 1px solid rgba(0,0,0,.05);

            transition: .3s;
        }


        .visibilite-card:hover {
            transform: translateY(-8px);

            box-shadow:
                0 20px 45px rgba(0,0,0,.13);
        }


        .visibilite-icon {
            width: 70px;
            height: 70px;

            border-radius: 20px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 34px;

            margin-bottom: 20px;
        }


        .icon-boost {
            background: rgba(255,176,0,.12);
        }


        .icon-top {
            background: rgba(220,53,69,.10);
        }


        .visibilite-card h2 {
            font-size: 23px;
            font-weight: 800;
            margin-bottom: 10px;
        }


        .visibilite-description {
            color: #6c757d;
            line-height: 1.6;
            min-height: 52px;
        }


        .visibilite-price {
            margin-top: 20px;

            font-size: 28px;
            font-weight: 900;
            color: #198754;
        }


        .visibilite-price small {
            font-size: 13px;
            color: #6c757d;
            font-weight: 500;
        }


        .visibilite-duration {
            margin-top: 10px;

            display: inline-block;

            padding: 7px 12px;

            border-radius: 50px;

            background: #f1f3f5;

            color: #495057;

            font-size: 13px;
            font-weight: 700;
        }


        .visibilite-button {
            width: 100%;

            margin-top: 25px;

            padding: 13px;

            border: 0;
            border-radius: 13px;

            color: white;

            font-weight: 800;

            cursor: pointer;

            transition: .3s;
        }


        .button-boost {
            background:
                linear-gradient(
                    135deg,
                    #ffb000,
                    #ff7a00
                );
        }


        .button-top {
            background:
                linear-gradient(
                    135deg,
                    #ff7a00,
                    #dc3545
                );
        }


        .visibilite-button:hover {
            transform: translateY(-3px);

            box-shadow:
                0 10px 22px rgba(0,0,0,.15);
        }


        @media(max-width: 768px) {

            .visibilite-grid {
                grid-template-columns: 1fr;
            }

            .visibilite-header h1 {
                font-size: 26px;
            }

        }

    </style>


    <div class="visibilite-page">

        <div class="visibilite-container">


            {{-- HEADER --}}

            <div class="visibilite-header">

                <h1>
                    🚀 Augmentez la visibilité de votre logement
                </h1>

                <p>
                    Donnez plus de visibilité à votre annonce
                    et augmentez vos chances de trouver rapidement
                    un locataire.
                </p>

                <span class="logement-name">

                    🏠 {{ $logement->titre }}

                </span>

            </div>


            {{-- OPTIONS --}}

            <div class="visibilite-grid">


                {{-- =========================================
                     MISE EN AVANT
                ========================================== --}}

                <div class="visibilite-card">

                    <div class="visibilite-icon icon-boost">
                        🔥
                    </div>

                    <h2>
                        Mise en avant
                    </h2>

                    <p class="visibilite-description">

                        Votre logement bénéficie d'une meilleure
                        visibilité dans les résultats de recherche.

                    </p>

                    <div class="visibilite-price">

                        2 500

                        <small>FCFA</small>

                    </div>

                    <span class="visibilite-duration">

                        📅 Pendant 7 jours

                    </span>


                    <form
                        method="POST"
                        action="{{ route(
                            'bailleur.visibilite.acheter',
                            $logement
                        ) }}"
                    >

                        @csrf

                        <input
                            type="hidden"
                            name="niveau"
                            value="1"
                        >

                        <button
                            type="submit"
                            class="
                                visibilite-button
                                button-boost
                            "
                        >

                            🔥 Choisir la mise en avant

                        </button>

                    </form>

                </div>


                {{-- =========================================
                     TÊTE DES RÉSULTATS
                ========================================== --}}

                <div class="visibilite-card">

                    <div class="visibilite-icon icon-top">
                        🚀
                    </div>

                    <h2>
                        Tête des résultats
                    </h2>

                    <p class="visibilite-description">

                        Votre logement apparaît en priorité
                        dans les résultats pendant toute la durée
                        de la promotion.

                    </p>

                    <div class="visibilite-price">

                        5 000

                        <small>FCFA</small>

                    </div>

                    <span class="visibilite-duration">

                        📅 Pendant 15 jours

                    </span>


                    <form
                        method="POST"
                        action="{{ route(
                            'bailleur.visibilite.acheter',
                            $logement
                        ) }}"
                    >

                        @csrf

                        <input
                            type="hidden"
                            name="niveau"
                            value="2"
                        >

                        <button
                            type="submit"
                            class="
                                visibilite-button
                                button-top
                            "
                        >

                            🚀 Choisir tête des résultats

                        </button>

                    </form>

                </div>


            </div>

        </div>

    </div>

</x-app-layout>