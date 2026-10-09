<x-app-layout>

    <x-app-sidebar />

    <style>

        /* =====================================================
           PAGE
        ===================================================== */

        .dashboard-page {
            min-height: calc(100vh - 65px);
            padding: 35px 20px;
            background:
                radial-gradient(
                    circle at 10% 20%,
                    rgba(13,110,253,.10),
                    transparent 30%
                ),
                radial-gradient(
                    circle at 90% 80%,
                    rgba(25,135,84,.10),
                    transparent 30%
                ),
                linear-gradient(
                    135deg,
                    #f0f8ff,
                    #f0fff6
                );
        }

        .dashboard-container {
            max-width: 1200px;
            margin: auto;
        }


        /* =====================================================
           HERO
        ===================================================== */

        .dashboard-hero {
            position: relative;
            overflow: hidden;
            padding: 30px 35px;
            margin-bottom: 30px;
            color: white;
            border-radius: 25px;
            background: linear-gradient(135deg, #0d6efd, #198754);
            box-shadow: 0 18px 45px rgba(13,110,253,.20);
            animation: slideDown .7s ease;
        }

        .dashboard-hero::before {
            content: "";
            position: absolute;
            width: 280px;
            height: 280px;
            right: -90px;
            top: -130px;
            border-radius: 50%;
            background: rgba(255,255,255,.08);
            animation: floating 6s ease-in-out infinite;
        }

        .dashboard-hero::after {
            content: "";
            position: absolute;
            width: 180px;
            height: 180px;
            left: 40%;
            bottom: -130px;
            border-radius: 50%;
            background: rgba(255,255,255,.06);
            animation: floating 7s ease-in-out infinite reverse;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .hero-title {
            margin: 0;
            font-size: 30px;
            font-weight: 800;
        }

        .hero-subtitle {
            margin-top: 6px;
            margin-bottom: 0;
            opacity: .9;
        }

        .dashboard-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 13px 20px;
            color: #0d6efd;
            background: white;
            border-radius: 13px;
            text-decoration: none;
            font-weight: 700;
            transition: .3s;
        }

        .dashboard-button:hover {
            transform: translateY(-4px);
            color: #198754;
            box-shadow: 0 10px 25px rgba(0,0,0,.18);
        }


        /* =====================================================
           ALERTS
        ===================================================== */

        .payment-alert {
            border: none;
            border-radius: 15px;

            padding: 15px 20px;

            margin-bottom: 20px;

            animation: slideDown .5s ease;
        }


        /* =====================================================
           CARD
        ===================================================== */

        .payment-card {
            overflow: hidden;

            background: white;

            border-radius: 24px;

            border: 1px solid
                rgba(0,0,0,.04);

            box-shadow:
                0 12px 40px
                rgba(0,0,0,.07);

            animation: slideUp .8s ease;
        }

        .payment-card-header {
            display: flex;

            align-items: center;
            justify-content: space-between;

            padding: 22px 28px;

            border-bottom:
                1px solid #edf0f2;
        }

        .payment-card-title {
            display: flex;

            align-items: center;

            gap: 12px;
        }

        .payment-icon {
            width: 48px;
            height: 48px;

            display: flex;

            align-items: center;
            justify-content: center;

            font-size: 23px;

            border-radius: 15px;

            color: white;

            background:
                linear-gradient(
                    135deg,
                    #0d6efd,
                    #198754
                );

            box-shadow:
                0 7px 18px
                rgba(13,110,253,.18);
        }

        .payment-card-title h3 {
            margin: 0;

            font-size: 19px;
            font-weight: 800;

            color: #212529;
        }

        .payment-card-title p {
            margin: 3px 0 0;

            font-size: 13px;
            color: #6c757d;
        }


        /* =====================================================
           TABLE
        ===================================================== */

        .payment-table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        .payment-table {
            width: 100%;

            margin: 0;

            border-collapse: collapse;

            min-width: 850px;
        }

        .payment-table thead {
            background:
                linear-gradient(
                    135deg,
                    #f4f8ff,
                    #f2fbf6
                );
        }

        .payment-table th {
            padding: 16px 20px;

            color: #6c757d;

            font-size: 12px;

            text-transform: uppercase;

            letter-spacing: .6px;

            font-weight: 800;

            border: none;
        }

        .payment-table td {
            padding: 19px 20px;

            vertical-align: middle;

            border-top:
                1px solid #f0f2f4;

            color: #495057;
        }

        .payment-table tbody tr {
            transition: .25s;
        }

        .payment-table tbody tr:hover {
            background:
                linear-gradient(
                    90deg,
                    #f8fbff,
                    #f8fffb
                );

            transform: scale(1.002);
        }


        /* =====================================================
           REFERENCE
        ===================================================== */

        .payment-reference {
            font-weight: 800;

            color: #212529;
        }

        .payment-reference small {
            display: block;

            margin-top: 3px;

            color: #adb5bd;

            font-size: 11px;

            font-weight: 500;
        }


        /* =====================================================
           TYPE
        ===================================================== */

        .payment-type {
            display: inline-flex;

            align-items: center;

            gap: 8px;

            padding: 8px 12px;

            border-radius: 10px;

            background: #f8f9fa;

            color: #495057;

            font-size: 13px;

            font-weight: 600;
        }


        /* =====================================================
           MONTANT
        ===================================================== */

        .payment-amount {
            font-size: 16px;

            font-weight: 800;

            color: #198754;

            white-space: nowrap;
        }


        /* =====================================================
           METHOD
        ===================================================== */

        .payment-method {
            display: inline-flex;

            align-items: center;

            gap: 7px;

            color: #495057;

            font-weight: 600;
        }


        /* =====================================================
           STATUS
        ===================================================== */

        .payment-status {
            display: inline-flex;

            align-items: center;

            gap: 6px;

            padding: 7px 12px;

            border-radius: 30px;

            font-size: 12px;

            font-weight: 800;

            white-space: nowrap;
        }

        .status-paid {
            color: #146c43;

            background:
                #d1e7dd;
        }

        .status-pending {
            color: #997404;

            background:
                #fff3cd;
        }

        .status-danger {
            color: #b02a37;

            background:
                #f8d7da;
        }


        /* =====================================================
           DATE
        ===================================================== */

        .payment-date {
            white-space: nowrap;

            color: #6c757d;

            font-size: 13px;

            font-weight: 600;
        }


        /* =====================================================
           PAGINATION
        ===================================================== */

        .payment-pagination {
            padding: 20px 25px;

            border-top:
                1px solid #edf0f2;
        }


        /* =====================================================
           EMPTY
        ===================================================== */

        .empty-payment {
            padding: 70px 25px;

            text-align: center;
        }

        .empty-icon {
            width: 85px;
            height: 85px;

            margin: 0 auto 20px;

            display: flex;

            align-items: center;
            justify-content: center;

            font-size: 40px;

            border-radius: 25px;

            background:
                linear-gradient(
                    135deg,
                    #eff6ff,
                    #effdf5
                );

            animation:
                floating 3s ease-in-out infinite;
        }

        .empty-payment h3 {
            margin: 0;

            font-size: 21px;

            font-weight: 800;

            color: #212529;
        }

        .empty-payment p {
            margin: 8px 0 20px;

            color: #6c757d;
        }

        .offers-button {
            display: inline-flex;

            align-items: center;

            gap: 8px;

            padding: 12px 20px;

            color: white;

            background:
                linear-gradient(
                    135deg,
                    #0d6efd,
                    #198754
                );

            border-radius: 12px;

            text-decoration: none;

            font-weight: 700;

            transition: .3s;
        }

        .offers-button:hover {
            color: white;

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
                transform: translateY(-25px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }

        }

        @keyframes slideUp {

            from {
                opacity: 0;
                transform: translateY(35px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }

        }

        @keyframes floatCircle {

            0%, 100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(25px);
            }

        }

        @keyframes floating {

            0%, 100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
            }

        }


        /* =====================================================
           TABLET
        ===================================================== */

        @media(max-width: 900px) {

            .payment-page {
                padding: 30px 15px;
            }

            .payment-header-content {
                align-items: flex-start;
            }

            .payment-title {
                font-size: 24px;
            }

        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media(max-width: 600px) {

            .payment-page {
                padding: 20px 12px;
            }

            .payment-header {
                padding: 22px 20px;

                border-radius: 20px;
            }

            .payment-header-content {
                flex-direction: column;
            }

            .payment-title {
                font-size: 22px;
            }

            .payment-subtitle {
                font-size: 14px;
            }

            .dashboard-button {
                width: 100%;
            }

            .payment-card {
                border-radius: 20px;
            }

            .payment-card-header {
                padding: 18px;
            }

            .payment-card-title h3 {
                font-size: 17px;
            }

            .payment-table {
                min-width: 800px;
            }

            .empty-payment {
                padding: 55px 20px;
            }

        }


        /* =====================================================
           VERY SMALL MOBILE
        ===================================================== */

        @media(max-width: 400px) {

            .payment-title {
                font-size: 20px;
            }

            .payment-header {
                padding: 20px 16px;
            }

            .payment-card-header {
                padding: 16px;
            }

            .payment-icon {
                width: 42px;
                height: 42px;

                font-size: 20px;
            }

        }

    </style>


    <!-- =====================================================
         PAGE
    ===================================================== -->

    <div class="dashboard-page">

        <div class="dashboard-container">


            <!-- =================================================
                 HEADER
            ================================================== -->

            <div class="dashboard-hero">

                <div class="hero-content">

                    <div>

                        <h1 class="hero-title">

                            <i class="bi bi-credit-card me-2"></i>
                            Historique des paiements

                        </h1>

                        <p class="hero-subtitle">

                            Consultez vos paiements et transactions
                            effectués sur CHEZMW.

                        </p>

                    </div>


                    <a
                        href="{{ route('bailleur.dashboard') }}"
                        class="dashboard-button"
                    >

                        ←

                        Tableau de bord

                    </a>

                </div>

            </div>



            <!-- =================================================
                 ALERTS
            ================================================== -->

            @if(session('success'))

                <div class="alert alert-success payment-alert">

                    <i class="bi bi-check-circle-fill me-2"></i>

                    {{ session('success') }}

                </div>

            @endif


            @if(session('error'))

                <div class="alert alert-danger payment-alert">

                    <i class="bi bi-exclamation-circle-fill me-2"></i>

                    {{ session('error') }}

                </div>

            @endif



            <!-- =================================================
                 CARD
            ================================================== -->

            <div class="payment-card">


                <!-- HEADER -->

                <div class="payment-card-header">

                    <div class="payment-card-title">

                        <div class="payment-icon">

                            💳

                        </div>

                        <div>

                            <h3>
                                Mes transactions
                            </h3>

                            <p>
                                Historique de vos opérations
                            </p>

                        </div>

                    </div>

                </div>



                @if($paiements->count())


                    <!-- =================================================
                         TABLE
                    ================================================== -->

                    <div class="payment-table-wrapper">

                        <table class="payment-table">

                            <thead>

                                <tr>

                                    <th>
                                        Référence
                                    </th>

                                    <th>
                                        Type
                                    </th>

                                    <th>
                                        Montant
                                    </th>

                                    <th>
                                        Méthode
                                    </th>

                                    <th>
                                        Statut
                                    </th>

                                    <th>
                                        Date
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @foreach($paiements as $paiement)

                                    <tr>


                                        <!-- REFERENCE -->

                                        <td>

                                            <div class="payment-reference">

                                                {{ $paiement->reference }}

                                                <small>
                                                    Transaction #{{ $paiement->id }}
                                                </small>

                                            </div>

                                        </td>



                                        <!-- TYPE -->

                                        <td>

                                            @if(
                                                $paiement->type
                                                === 'annonce_supplementaire'
                                            )

                                                <span class="payment-type">

                                                    📢

                                                    Annonce supplémentaire

                                                </span>

                                            @elseif(
                                                $paiement->type
                                                === 'offre_agence'
                                            )

                                                <span class="payment-type">

                                                    💼

                                                    Offre agence

                                                </span>

                                            @else

                                                <span class="payment-type">

                                                    💳

                                                    {{ ucfirst(
                                                        str_replace(
                                                            '_',
                                                            ' ',
                                                            $paiement->type
                                                        )
                                                    ) }}

                                                </span>

                                            @endif

                                        </td>



                                        <!-- MONTANT -->

                                        <td>

                                            <div class="payment-amount">

                                                {{ number_format(
                                                    $paiement->montant,
                                                    0,
                                                    ',',
                                                    ' '
                                                ) }}

                                                FCFA

                                            </div>

                                        </td>



                                        <!-- METHODE -->

                                        <td>

                                            <div class="payment-method">

                                                @if($paiement->methode)

                                                    📱

                                                    {{ ucfirst(
                                                        $paiement->methode
                                                    ) }}

                                                @else

                                                    —

                                                @endif

                                            </div>

                                        </td>



                                        <!-- STATUT -->

                                        <td>

                                            @if(
                                                $paiement->statut
                                                === 'paye'
                                            )

                                                <span
                                                    class="payment-status status-paid"
                                                >

                                                    ✓

                                                    Payé

                                                </span>

                                            @elseif(
                                                $paiement->statut
                                                === 'en_attente'
                                            )

                                                <span
                                                    class="payment-status status-pending"
                                                >

                                                    ⏳

                                                    En attente

                                                </span>

                                            @else

                                                <span
                                                    class="payment-status status-danger"
                                                >

                                                    ✕

                                                    {{ ucfirst(
                                                        str_replace(
                                                            '_',
                                                            ' ',
                                                            $paiement->statut
                                                        )
                                                    ) }}

                                                </span>

                                            @endif

                                        </td>



                                        <!-- DATE -->

                                        <td>

                                            <div class="payment-date">

                                                <i
                                                    class="bi bi-calendar3 me-1"
                                                ></i>

                                                {{ $paiement->created_at
                                                    ->format('d/m/Y H:i')
                                                }}

                                            </div>

                                        </td>


                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>



                    <!-- =================================================
                         PAGINATION
                    ================================================== -->

                    <div class="payment-pagination">

                        {{ $paiements->links() }}

                    </div>


                @else


                    <!-- =================================================
                         AUCUN PAIEMENT
                    ================================================== -->

                    <div class="empty-payment">

                        <div class="empty-icon">

                            💳

                        </div>

                        <h3>

                            Aucun paiement

                        </h3>

                        <p>

                            Vous n'avez encore effectué
                            aucun paiement sur CHEZMW.

                        </p>

                        <a
                            href="{{ route('bailleur.offres') }}"
                            class="offers-button"
                        >

                            💎

                            Voir les offres

                        </a>

                    </div>


                @endif


            </div>

        </div>

    </div>

</x-app-layout>