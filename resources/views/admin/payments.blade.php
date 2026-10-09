<x-app-layout>

<style>

/* =====================================================
   GLOBAL
===================================================== */

* {
    box-sizing: border-box;
}

.payments-page {
    min-height: calc(100vh - 65px);

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

    padding: 35px 20px;
}

.payments-container {
    max-width: 1400px;
    margin: auto;
}


/* =====================================================
   HERO
===================================================== */

.payments-hero {
    position: relative;
    overflow: hidden;

    padding: 30px 35px;

    border-radius: 25px;

    color: white;

    background:
        linear-gradient(
            135deg,
            #0d6efd,
            #198754
        );

    box-shadow:
        0 18px 45px
        rgba(13,110,253,.20);

    margin-bottom: 25px;

    animation:
        slideDown .7s ease;
}

.payments-hero::before {
    content: "";

    position: absolute;

    width: 280px;
    height: 280px;

    border-radius: 50%;

    background:
        rgba(255,255,255,.08);

    right: -90px;
    top: -130px;

    animation:
        floating 6s ease-in-out infinite;
}

.payments-hero::after {
    content: "";

    position: absolute;

    width: 180px;
    height: 180px;

    border-radius: 50%;

    background:
        rgba(255,255,255,.06);

    left: 40%;
    bottom: -130px;

    animation:
        floating 7s ease-in-out infinite reverse;
}

.hero-content {
    position: relative;

    z-index: 2;

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 20px;
}

.hero-left {
    min-width: 0;
}

.hero-badge {
    display: inline-flex;

    align-items: center;

    gap: 7px;

    padding: 7px 12px;

    margin-bottom: 9px;

    border-radius: 10px;

    background:
        rgba(255,255,255,.12);

    border:
        1px solid
        rgba(255,255,255,.15);

    font-size: 11px;

    font-weight: 800;

    letter-spacing: 1px;

    text-transform: uppercase;
}

.hero-title {
    margin: 0;

    font-size: 30px;

    font-weight: 800;
}

.hero-subtitle {
    margin-top: 7px;

    font-size: 15px;

    opacity: .9;
}

.dashboard-button {
    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    padding: 13px 20px;

    background: white;

    color: #0d6efd;

    border-radius: 13px;

    text-decoration: none;

    font-weight: 700;

    transition: .3s;

    white-space: nowrap;
}

.dashboard-button:hover {
    transform:
        translateY(-4px);

    color: #198754;

    box-shadow:
        0 10px 25px
        rgba(0,0,0,.18);
}


/* =====================================================
   FILTER
===================================================== */

.filter-card {
    background:
        rgba(255,255,255,.96);

    border-radius: 22px;

    padding: 25px;

    margin-bottom: 25px;

    border:
        1px solid
        rgba(0,0,0,.04);

    box-shadow:
        0 10px 30px
        rgba(0,0,0,.06);

    animation:
        slideUp .7s ease;
}

.filter-header {
    display: flex;

    align-items: center;

    gap: 12px;

    margin-bottom: 18px;
}

.filter-icon {
    width: 48px;
    height: 48px;

    border-radius: 15px;

    display: flex;

    align-items: center;
    justify-content: center;

    background:
        linear-gradient(
            135deg,
            #e8f1ff,
            #e9f8f1
        );

    font-size: 22px;
}

.filter-title {
    font-size: 18px;

    font-weight: 800;

    color: #212529;
}

.filter-subtitle {
    margin-top: 3px;

    color: #6c757d;

    font-size: 13px;
}

.filter-form {
    display: flex;

    align-items: center;

    gap: 10px;
}

.filter-select {
    height: 45px;

    min-width: 230px;

    padding:
        0 14px;

    border:
        1px solid #dfe5eb;

    border-radius: 12px;

    background: white;

    color: #212529;

    font-size: 14px;

    outline: none;

    transition: .3s;
}

.filter-select:focus {
    border-color:
        rgba(13,110,253,.55);

    box-shadow:
        0 0 0 4px
        rgba(13,110,253,.08);
}

.filter-button {
    height: 45px;

    padding:
        0 22px;

    border: none;

    border-radius: 12px;

    background:
        linear-gradient(
            135deg,
            #0d6efd,
            #198754
        );

    color: white;

    font-weight: 800;

    cursor: pointer;

    transition: .3s;
}

.filter-button:hover {
    transform:
        translateY(-2px);

    box-shadow:
        0 8px 20px
        rgba(13,110,253,.20);
}


/* =====================================================
   TABLE CARD
===================================================== */

.table-card {
    overflow: hidden;

    background:
        rgba(255,255,255,.97);

    border-radius: 23px;

    border:
        1px solid
        rgba(0,0,0,.04);

    box-shadow:
        0 10px 30px
        rgba(0,0,0,.06);

    animation:
        slideUp .9s ease;
}

.table-header {
    padding:
        22px 25px;

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;

    border-bottom:
        1px solid #edf0f2;
}

.table-header-left {
    display: flex;

    align-items: center;

    gap: 12px;
}

.table-header-icon {
    width: 48px;
    height: 48px;

    border-radius: 15px;

    display: flex;

    align-items: center;
    justify-content: center;

    background:
        linear-gradient(
            135deg,
            #e8f1ff,
            #e9f8f1
        );

    font-size: 22px;
}

.table-title {
    font-size: 18px;

    font-weight: 800;

    color: #212529;
}

.table-subtitle {
    margin-top: 3px;

    color: #6c757d;

    font-size: 13px;
}

.table-badge {
    padding:
        7px 13px;

    border-radius: 999px;

    background:
        #e7f7ef;

    color:
        #198754;

    font-size: 11px;

    font-weight: 800;
}


/* =====================================================
   TABLE
===================================================== */

.table-wrapper {
    overflow-x: auto;
}

.payments-table {
    width: 100%;

    border-collapse: collapse;

    min-width: 800px;
}

.payments-table thead {
    background:
        linear-gradient(
            90deg,
            #f7fbff,
            #f5fff9
        );
}

.payments-table th {
    padding:
        16px 22px;

    text-align: left;

    color: #6c757d;

    font-size: 11px;

    font-weight: 800;

    text-transform: uppercase;

    letter-spacing: .5px;

    white-space: nowrap;
}

.payments-table td {
    padding:
        19px 22px;

    border-top:
        1px solid #f0f0f0;

    vertical-align: middle;

    font-size: 14px;
}

.payment-row {
    transition: .3s;
}

.payment-row:hover {
    background:
        linear-gradient(
            90deg,
            #f6faff,
            #f5fff9
        );
}


/* =====================================================
   DATE
===================================================== */

.date-cell {
    display: flex;

    align-items: center;

    gap: 10px;

    color: #495057;

    white-space: nowrap;
}

.date-icon {
    width: 38px;
    height: 38px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 12px;

    background: #eef5ff;

    font-size: 17px;
}


/* =====================================================
   USER
===================================================== */

.user-cell {
    display: flex;

    align-items: center;

    gap: 10px;

    color: #212529;

    font-weight: 700;

    white-space: nowrap;
}

.user-avatar {
    width: 38px;
    height: 38px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 12px;

    color: white;

    background:
        linear-gradient(
            135deg,
            #0d6efd,
            #198754
        );

    font-size: 15px;
}


/* =====================================================
   TYPE
===================================================== */

.type-badge {
    display: inline-flex;

    align-items: center;

    gap: 7px;

    padding:
        7px 11px;

    border-radius: 10px;

    background:
        #f4f7fa;

    color:
        #495057;

    font-size: 12px;

    font-weight: 700;

    text-transform: capitalize;
}


/* =====================================================
   MONTANT
===================================================== */

.amount {
    color:
        #198754;

    font-size: 15px;

    font-weight: 800;

    white-space: nowrap;
}


/* =====================================================
   STATUT
===================================================== */

.payment-status {
    display: inline-flex;

    align-items: center;

    gap: 7px;

    padding:
        7px 12px;

    border-radius: 999px;

    font-size: 11px;

    font-weight: 800;

    white-space: nowrap;
}

.payment-status-dot {
    width: 7px;
    height: 7px;

    border-radius: 50%;
}

.status-paid {
    color: #198754;

    background:
        #e7f7ef;
}

.status-paid .payment-status-dot {
    background: #198754;
}

.status-pending {
    color: #b45309;

    background:
        #fff6db;
}

.status-pending .payment-status-dot {
    background: #f59e0b;
}


/* =====================================================
   EMPTY
===================================================== */

.empty-state {
    padding:
        65px 20px;

    text-align: center;

    color: #6c757d;
}

.empty-icon {
    width: 72px;
    height: 72px;

    margin:
        auto auto 15px;

    border-radius: 22px;

    display: flex;

    align-items: center;
    justify-content: center;

    background:
        linear-gradient(
            135deg,
            #edf5ff,
            #ecfff5
        );

    font-size: 30px;
}

.empty-state strong {
    display: block;

    color: #212529;

    font-size: 15px;
}

.empty-state p {
    margin-top: 6px;

    font-size: 13px;
}


/* =====================================================
   PAGINATION
===================================================== */

.pagination-container {
    margin-top: 22px;
}


/* =====================================================
   RESPONSIVE
===================================================== */

@media(max-width: 768px) {

    .payments-page {
        padding:
            20px 14px;
    }

    .payments-hero {
        padding:
            25px 20px;
    }

    .hero-content {
        flex-direction: column;

        align-items: stretch;
    }

    .hero-title {
        font-size: 25px;
    }

    .dashboard-button {
        width: 100%;
    }

    .filter-card {
        padding: 20px;
    }

    .filter-form {
        flex-direction: column;

        align-items: stretch;
    }

    .filter-select,
    .filter-button {
        width: 100%;
    }

    .table-header {
        padding: 20px;
    }
}

@media(max-width: 500px) {

    .hero-title {
        font-size: 22px;
    }

    .hero-subtitle {
        font-size: 14px;
    }

    .table-title {
        font-size: 16px;
    }

    .table-badge {
        display: none;
    }
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
            translateY(30px);
    }

    to {
        opacity: 1;

        transform:
            translateY(0);
    }
}

@keyframes floating {

    0%, 100% {
        transform:
            translateY(0);
    }

    50% {
        transform:
            translateY(25px);
    }
}

@media(prefers-reduced-motion: reduce) {

    *,
    *::before,
    *::after {
        animation-duration: .01ms !important;

        animation-iteration-count: 1 !important;

        transition-duration: .01ms !important;
    }
}

</style>


<div class="payments-page">

    <div class="payments-container">


        {{-- =====================================================
             HERO
        ===================================================== --}}

        <section class="payments-hero">

            <div class="hero-content">

                <div class="hero-left">

                    <div class="hero-badge">
                        💳 Administration
                    </div>

                    <h1 class="hero-title">
                        Paiements
                    </h1>

                    <p class="hero-subtitle">
                        Consultez et surveillez les paiements
                        effectués sur la plateforme CHEZMW.
                    </p>

                </div>


                <a
                    href="{{ route('admin.dashboard') }}"
                    class="dashboard-button"
                >
                    ← Dashboard
                </a>

            </div>

        </section>


        {{-- =====================================================
             FILTRE
        ===================================================== --}}

        <section class="filter-card">

            <div class="filter-header">

                <div class="filter-icon">
                    🔎
                </div>

                <div>

                    <div class="filter-title">
                        Filtrer les paiements
                    </div>

                    <div class="filter-subtitle">
                        Affichez les paiements selon leur statut.
                    </div>

                </div>

            </div>


            {{-- =================================================
                 LOGIQUE ORIGINALE CONSERVÉE
            ================================================== --}}

            <form>

                <div class="filter-form">

                    <select
                        name="statut"
                        class="filter-select"
                    >

                        <option value="">
                            Tous les statuts
                        </option>

                        <option value="paye">
                            Payé
                        </option>

                        <option value="en_attente">
                            En attente
                        </option>

                    </select>


                    <button
                        type="submit"
                        class="filter-button"
                    >
                        🔎 Filtrer
                    </button>

                </div>

            </form>

        </section>


        {{-- =====================================================
             TABLEAU
        ===================================================== --}}

        <section class="table-card">


            <div class="table-header">

                <div class="table-header-left">

                    <div class="table-header-icon">
                        💳
                    </div>

                    <div>

                        <div class="table-title">
                            Historique des paiements
                        </div>

                        <div class="table-subtitle">
                            Consultez les transactions enregistrées.
                        </div>

                    </div>

                </div>


                <div class="table-badge">
                    💰 Transactions
                </div>

            </div>


            <div class="table-wrapper">

                <table class="payments-table">

                    <thead>

                        <tr>

                            <th>
                                Date
                            </th>

                            <th>
                                Utilisateur
                            </th>

                            <th>
                                Type
                            </th>

                            <th>
                                Montant
                            </th>

                            <th>
                                Statut
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        {{-- =================================================
                             LOGIQUE ORIGINALE CONSERVÉE À 100 %
                        ================================================== --}}

                        @forelse($paiements as $paiement)

                            <tr class="payment-row">


                                {{-- DATE --}}

                                <td>

                                    <div class="date-cell">

                                        <div class="date-icon">
                                            📅
                                        </div>

                                        <span>

                                            {{
                                                ($paiement->paye_le ?? $paiement->created_at)
                                                ->format('d/m/Y H:i')
                                            }}

                                        </span>

                                    </div>

                                </td>


                                {{-- UTILISATEUR --}}

                                <td>

                                    <div class="user-cell">

                                        <div class="user-avatar">
                                            👤
                                        </div>

                                        <span>

                                            {{
                                                $paiement->user?->name
                                                ?? 'Compte supprimé'
                                            }}

                                        </span>

                                    </div>

                                </td>


                                {{-- TYPE --}}

                                <td>

                                    <span class="type-badge">

                                        💳

                                        {{
                                            str_replace(
                                                '_',
                                                ' ',
                                                $paiement->type
                                            )
                                        }}

                                    </span>

                                </td>


                                {{-- MONTANT --}}

                                <td>

                                    <span class="amount">

                                        {{
                                            number_format(
                                                $paiement->montant,
                                                0,
                                                ',',
                                                ' '
                                            )
                                        }}

                                        FCFA

                                    </span>

                                </td>


                                {{-- STATUT --}}

                                <td>

                                    <span
                                        class="payment-status
                                        {{
                                            $paiement->statut === 'paye'
                                                ? 'status-paid'
                                                : 'status-pending'
                                        }}"
                                    >

                                        <span
                                            class="payment-status-dot"
                                        ></span>


                                        {{
                                            ucfirst(
                                                str_replace(
                                                    '_',
                                                    ' ',
                                                    $paiement->statut
                                                )
                                            )
                                        }}

                                    </span>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="5"
                                    style="padding:0;"
                                >

                                    <div class="empty-state">

                                        <div class="empty-icon">
                                            💳
                                        </div>

                                        <strong>
                                            Aucun paiement.
                                        </strong>

                                        <p>
                                            Aucun paiement ne correspond
                                            aux critères actuels.
                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </section>


        {{-- =====================================================
             PAGINATION
        ===================================================== --}}

        <div class="pagination-container">

            {{ $paiements->links() }}

        </div>

    </div>

</div>

</x-app-layout>