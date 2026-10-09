<x-app-layout>

    <x-app-sidebar />

    <style>

        .visibility-manage-page {

            min-height: calc(100vh - 65px);

            padding: 35px 20px;

            background:
                linear-gradient(
                    135deg,
                    #f0f8ff,
                    #f0fff6
                );

        }


        .visibility-manage-container {

            max-width: 1000px;

            margin: auto;

        }


        .manage-header {

            background:
                linear-gradient(
                    135deg,
                    #0d6efd,
                    #198754
                );

            color: white;

            padding: 30px;

            border-radius: 25px;

            margin-bottom: 25px;

            box-shadow:
                0 15px 35px
                rgba(13,110,253,.18);

        }


        .manage-header h1 {

            margin: 0;

            font-size: 28px;

            font-weight: 800;

        }


        .manage-header p {

            margin: 8px 0 0;

            opacity: .9;

        }


        .current-status {

            background: white;

            border-radius: 20px;

            padding: 25px;

            margin-bottom: 25px;

            box-shadow:
                0 8px 25px
                rgba(0,0,0,.06);

        }


        .current-status h2 {

            margin: 0 0 15px;

            font-size: 21px;

            font-weight: 800;

        }


        .status-badge {

            display: inline-flex;

            padding: 8px 14px;

            border-radius: 50px;

            font-size: 13px;

            font-weight: 800;

        }


        .status-normal {

            background: #f1f3f5;

            color: #495057;

        }


        .status-boost {

            background: #fff3cd;

            color: #9a6700;

        }


        .status-top {

            background: #f8d7da;

            color: #842029;

        }


        .visibility-options {

            display: grid;

            grid-template-columns:
                repeat(2, 1fr);

            gap: 22px;

        }


        .option-card {

            background: white;

            border-radius: 22px;

            padding: 28px;

            box-shadow:
                0 8px 28px
                rgba(0,0,0,.07);

            transition: .3s;

        }


        .option-card:hover {

            transform:
                translateY(-6px);

            box-shadow:
                0 18px 40px
                rgba(0,0,0,.12);

        }


        .option-icon {

            width: 65px;

            height: 65px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 20px;

            font-size: 30px;

            margin-bottom: 18px;

        }


        .boost-icon {

            background:
                rgba(255,176,0,.12);

        }


        .top-icon {

            background:
                rgba(220,53,69,.10);

        }


        .option-card h2 {

            margin: 0;

            font-size: 21px;

            font-weight: 800;

        }


        .option-card p {

            color: #6c757d;

            line-height: 1.6;

            margin-top: 10px;

        }


        .option-price {

            margin-top: 20px;

            font-size: 28px;

            font-weight: 900;

            color: #198754;

        }


        .option-price small {

            font-size: 12px;

            color: #6c757d;

        }


        .option-button {

            display: flex;

            align-items: center;

            justify-content: center;

            width: 100%;

            margin-top: 20px;

            padding: 13px;

            border-radius: 13px;

            color: white;

            text-decoration: none;

            font-weight: 800;

        }


        .option-button:hover {

            color: white;

        }


        .boost-button {

            background:
                linear-gradient(
                    135deg,
                    #ffb000,
                    #ff7a00
                );

        }


        .top-button {

            background:
                linear-gradient(
                    135deg,
                    #ff7a00,
                    #dc3545
                );

        }


        .back-button {

            display: inline-flex;

            margin-top: 25px;

            padding: 11px 18px;

            border-radius: 12px;

            background: white;

            color: #0d6efd;

            text-decoration: none;

            font-weight: 700;

            box-shadow:
                0 5px 15px
                rgba(0,0,0,.06);

        }


        @media(max-width: 768px) {

            .visibility-manage-page {

                padding: 22px 14px;

            }

            .visibility-options {

                grid-template-columns: 1fr;

            }

        }

    </style>


    <div class="visibility-manage-page">

        <div class="visibility-manage-container">


            {{-- HEADER --}}

            <div class="manage-header">

                <h1>

                    🚀 Gérer la visibilité

                </h1>

                <p>

                    {{ $logement->titre }}

                </p>

            </div>


            {{-- STATUT ACTUEL --}}

            <div class="current-status">

                <h2>

                    Visibilité actuelle

                </h2>


                @if($logement->niveau_visibilite == 2)

                    <span class="
                        status-badge
                        status-top
                    ">

                        🚀 Tête des résultats

                    </span>

                    @if($logement->date_fin_visibilite)

                        <p class="text-muted mt-3 mb-0">

                            Expire le :

                            {{ $logement->date_fin_visibilite
                                ->format('d/m/Y à H:i')
                            }}

                        </p>

                    @endif


                @elseif($logement->niveau_visibilite == 1)

                    <span class="
                        status-badge
                        status-boost
                    ">

                        🔥 Mise en avant

                    </span>

                    @if($logement->date_fin_visibilite)

                        <p class="text-muted mt-3 mb-0">

                            Expire le :

                            {{ $logement->date_fin_visibilite
                                ->format('d/m/Y à H:i')
                            }}

                        </p>

                    @endif


                @else

                    <span class="
                        status-badge
                        status-normal
                    ">

                        🏠 Visibilité normale

                    </span>

                @endif

            </div>


            {{-- OPTIONS --}}

            <div class="visibility-options">


                {{-- MISE EN AVANT --}}

                <form
                    action="{{ route(
                        'bailleur.visibilite.acheter',
                        $logement
                    ) }}"
                    method="POST"
                >
                    @csrf
                
                    <input
                        type="hidden"
                        name="niveau"
                        value="1"
                    >
                
                    <button
                        type="submit"
                        class="option-button boost-button"
                    >
                        🔥 Mettre en avant
                    </button>
                </form>


                {{-- TÊTE DES RÉSULTATS --}}

                <form
                    action="{{ route(
                        'bailleur.visibilite.acheter',
                        $logement
                    ) }}"
                    method="POST"
                >
                    @csrf
                
                    <input
                        type="hidden"
                        name="niveau"
                        value="2"
                    >
                
                    <button
                        type="submit"
                        class="option-button top-button"
                    >
                        🚀 Acheter
                    </button>
                </form>

            </div>


            <a
                href="{{ route('bailleur.visibilite') }}"
                class="back-button"
            >

                ← Retour aux logements

            </a>

        </div>

    </div>

</x-app-layout>