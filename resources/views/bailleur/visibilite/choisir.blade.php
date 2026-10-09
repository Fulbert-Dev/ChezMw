<x-app-layout>

    <x-app-sidebar />

    <style>

        .visibility-page {
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

        .visibility-container {
            max-width: 1100px;
            margin: auto;
        }

        .visibility-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .visibility-header h1 {
            font-size: 32px;
            font-weight: 800;
            color: #212529;
            margin-bottom: 10px;
        }

        .visibility-header p {
            color: #6c757d;
            margin: 0;
        }

        .logement-name {
            display: inline-block;
            margin-top: 15px;
            padding: 8px 16px;
            border-radius: 50px;

            background: rgba(13,110,253,.08);
            color: #0d6efd;

            font-size: 14px;
            font-weight: 700;
        }

        .visibility-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }

        .visibility-card {
            background: white;
            border-radius: 25px;
            padding: 30px;

            box-shadow:
                0 10px 30px rgba(0,0,0,.07);

            border: 1px solid rgba(0,0,0,.05);

            transition: .3s;
        }

        .visibility-card:hover {
            transform: translateY(-7px);

            box-shadow:
                0 20px 40px rgba(0,0,0,.12);
        }

        .visibility-icon {
            width: 70px;
            height: 70px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 20px;

            font-size: 32px;

            margin-bottom: 20px;
        }

        .icon-boost {
            background: rgba(255,176,0,.12);
        }

        .icon-top {
            background: rgba(220,53,69,.10);
        }

        .visibility-card h2 {
            font-size: 23px;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .visibility-card p {
            color: #6c757d;
            line-height: 1.6;
        }

        .visibility-price {
            font-size: 28px;
            font-weight: 900;
            color: #198754;
            margin: 20px 0 5px;
        }

        .visibility-duration {
            color: #6c757d;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .visibility-list {
            padding: 0;
            margin: 0 0 25px;
            list-style: none;
        }

        .visibility-list li {
            margin-bottom: 10px;
            color: #495057;
            font-size: 14px;
        }

        .visibility-button {
            width: 100%;

            border: 0;

            padding: 13px;

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

        .visibility-button:hover {
            transform: translateY(-3px);

            box-shadow:
                0 10px 20px rgba(0,0,0,.15);
        }

        @media(max-width: 768px) {

            .visibility-grid {
                grid-template-columns: 1fr;
            }

            .visibility-header h1 {
                font-size: 26px;
            }

        }

    </style>


    <div class="visibility-page">

        <div class="visibility-container">


            {{-- HEADER --}}

            <div class="visibility-header">

                <h1>
                    🚀 Augmentez la visibilité de votre logement
                </h1>

                <p>
                    Choisissez une option pour donner plus de visibilité
                    à votre annonce.
                </p>

                <span class="logement-name">

                    🏠 {{ $logement->titre }}

                </span>

            </div>


            {{-- OFFRES --}}

            <div class="visibility-grid">


                {{-- MISE EN AVANT --}}

                <div class="visibility-card">

                    <div class="visibility-icon icon-boost">
                        🔥
                    </div>

                    <h2>
                        Mise en avant
                    </h2>

                    <p>
                        Votre logement bénéficie d'une meilleure
                        visibilité dans les résultats.
                    </p>

                    <div class="visibility-price">
                        2 500 FCFA
                    </div>

                    <div class="visibility-duration">
                        ⏱️ Pendant 7 jours
                    </div>

                    <ul class="visibility-list">

                        <li>
                            ✅ Logement mis en avant
                        </li>

                        <li>
                            ✅ Plus visible dans les résultats
                        </li>

                        <li>
                            ✅ Badge « Mise en avant »
                        </li>

                    </ul>


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
                            class="visibility-button button-boost"
                        >

                            🔥
                            Choisir — 2 500 FCFA

                        </button>

                    </form>

                </div>


                {{-- TÊTE DES RÉSULTATS --}}

                <div class="visibility-card">

                    <div class="visibility-icon icon-top">
                        🚀
                    </div>

                    <h2>
                        Tête des résultats
                    </h2>

                    <p>
                        Votre logement apparaît en priorité
                        pendant une durée prolongée.
                    </p>

                    <div class="visibility-price">
                        5 000 FCFA
                    </div>

                    <div class="visibility-duration">
                        ⏱️ Pendant 15 jours
                    </div>

                    <ul class="visibility-list">

                        <li>
                            ✅ Position prioritaire
                        </li>

                        <li>
                            ✅ Forte visibilité
                        </li>

                        <li>
                            ✅ Badge « Tête des résultats »
                        </li>

                    </ul>


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
                            class="visibility-button button-top"
                        >

                            🚀
                            Choisir — 5 000 FCFA

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>