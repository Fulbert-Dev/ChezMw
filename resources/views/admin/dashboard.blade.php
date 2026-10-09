<x-app-layout>

<style>

/* =====================================================
   GLOBAL
===================================================== */

* {
    box-sizing: border-box;
}

.admin-page {
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

.admin-container {
    max-width: 1400px;
    margin: auto;
}


/* =====================================================
   HERO
===================================================== */

.admin-hero {
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

    margin-bottom: 30px;

    animation: slideDown .7s ease;
}

.admin-hero::before {
    content: "";

    position: absolute;

    width: 300px;
    height: 300px;

    border-radius: 50%;

    background:
        rgba(255,255,255,.08);

    right: -100px;
    top: -145px;

    animation:
        floating 6s ease-in-out infinite;
}

.admin-hero::after {
    content: "";

    position: absolute;

    width: 190px;
    height: 190px;

    border-radius: 50%;

    background:
        rgba(255,255,255,.06);

    left: 42%;
    bottom: -135px;

    animation:
        floating 7s ease-in-out infinite reverse;
}

.admin-hero-content {
    position: relative;
    z-index: 2;

    display: flex;

    align-items: center;
    justify-content: space-between;

    gap: 25px;
}

.admin-hero-title {
    font-size: 30px;

    font-weight: 800;

    margin: 0;
}

.admin-hero-subtitle {
    margin-top: 7px;

    opacity: .9;

    font-size: 15px;
}

.admin-badge {
    display: inline-flex;

    align-items: center;

    gap: 8px;

    padding: 8px 13px;

    margin-bottom: 8px;

    border-radius: 10px;

    background:
        rgba(255,255,255,.12);

    border:
        1px solid
        rgba(255,255,255,.15);

    font-size: 12px;

    font-weight: 800;

    letter-spacing: 1px;

    text-transform: uppercase;
}

.revenue-card {
    position: relative;
    z-index: 2;

    min-width: 220px;

    padding: 18px 22px;

    border-radius: 18px;

    background:
        rgba(255,255,255,.12);

    border:
        1px solid
        rgba(255,255,255,.12);

    backdrop-filter: blur(10px);

    box-shadow:
        0 10px 30px
        rgba(0,0,0,.10);
}

.revenue-label {
    font-size: 12px;

    font-weight: 700;

    text-transform: uppercase;

    letter-spacing: .8px;

    opacity: .85;
}

.revenue-value {
    margin-top: 5px;

    font-size: 25px;

    font-weight: 800;
}


/* =====================================================
   STATISTIQUES
===================================================== */

.admin-stats-grid {
    display: grid;

    grid-template-columns:
        repeat(4, 1fr);

    gap: 20px;

    margin-bottom: 30px;
}

.admin-stat-card {
    position: relative;

    overflow: hidden;

    background:
        rgba(255,255,255,.94);

    border-radius: 22px;

    padding: 25px;

    border:
        1px solid
        rgba(0,0,0,.04);

    box-shadow:
        0 10px 30px
        rgba(0,0,0,.06);

    transition:
        transform .3s,
        box-shadow .3s;

    animation:
        slideUp .7s ease both;
}

.admin-stat-card:hover {
    transform:
        translateY(-7px);

    box-shadow:
        0 18px 40px
        rgba(0,0,0,.11);
}

.admin-stat-card::after {
    content: "";

    position: absolute;

    width: 110px;
    height: 110px;

    border-radius: 50%;

    right: -45px;
    bottom: -50px;

    background:
        rgba(13,110,253,.05);
}

.admin-stat-content {
    position: relative;

    z-index: 2;

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;
}

.admin-stat-label {
    color: #6c757d;

    font-size: 14px;

    font-weight: 600;
}

.admin-stat-number {
    font-size: 34px;

    font-weight: 800;

    margin-top: 7px;

    line-height: 1;

    color: #212529;
}

.admin-stat-description {
    color: #6c757d;

    font-size: 12px;

    margin-top: 9px;

    line-height: 1.5;
}

.admin-stat-icon {
    width: 58px;
    height: 58px;

    flex-shrink: 0;

    border-radius: 17px;

    display: flex;

    align-items: center;
    justify-content: center;

    font-size: 27px;
}

.icon-blue {
    background: #e8f1ff;
}

.icon-green {
    background: #e7f7ef;
}

.icon-purple {
    background: #f0e8ff;
}

.icon-yellow {
    background: #fff6db;
}

.blue-number {
    color: #0d6efd;
}

.green-number {
    color: #198754;
}

.purple-number {
    color: #7b2cbf;
}


/* =====================================================
   ACTIONS RAPIDES
===================================================== */

.quick-card {
    position: relative;

    overflow: hidden;

    background:
        rgba(255,255,255,.94);

    border-radius: 22px;

    padding: 25px;

    border:
        1px solid
        rgba(0,0,0,.04);

    box-shadow:
        0 10px 30px
        rgba(0,0,0,.06);

    animation:
        slideUp .75s ease both;
}

.quick-header {
    display: flex;

    align-items: center;

    gap: 13px;

    margin-bottom: 18px;
}

.quick-icon {
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

.quick-title {
    font-size: 18px;

    font-weight: 800;

    color: #212529;
}

.quick-subtitle {
    color: #6c757d;

    font-size: 13px;

    margin-top: 3px;
}

.quick-actions {
    display: flex;

    flex-wrap: wrap;

    gap: 12px;
}

.quick-action {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    gap: 8px;

    padding: 11px 17px;

    border-radius: 12px;

    text-decoration: none;

    font-size: 14px;

    font-weight: 700;

    transition: .3s;

    border: 1px solid transparent;
}

.quick-action:hover {
    transform:
        translateY(-3px);

    box-shadow:
        0 8px 20px
        rgba(0,0,0,.08);
}

.action-violet {
    color: #7b2cbf;

    background: #f4edff;

    border-color:
        rgba(123,44,191,.08);
}

.action-blue {
    color: #0d6efd;

    background: #eef5ff;

    border-color:
        rgba(13,110,253,.08);
}

.action-green {
    color: #198754;

    background: #eaf8f1;

    border-color:
        rgba(25,135,84,.08);
}


/* =====================================================
   CONTENT GRID
===================================================== */

.admin-content-grid {
    display: grid;

    grid-template-columns:
        1fr 1fr;

    gap: 25px;

    margin-top: 30px;
}

.admin-card {
    background:
        rgba(255,255,255,.96);

    border-radius: 23px;

    overflow: hidden;

    box-shadow:
        0 10px 30px
        rgba(0,0,0,.06);

    border:
        1px solid
        rgba(0,0,0,.04);

    animation:
        slideUp .9s ease;
}

.admin-card-header {
    padding: 22px 25px;

    border-bottom:
        1px solid #edf0f2;

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;
}

.admin-card-header-left {
    display: flex;

    align-items: center;

    gap: 12px;
}

.admin-card-icon {
    width: 43px;
    height: 43px;

    border-radius: 13px;

    display: flex;

    align-items: center;
    justify-content: center;

    font-size: 20px;

    background:
        linear-gradient(
            135deg,
            #e8f1ff,
            #e9f8f1
        );
}

.admin-card-title {
    font-size: 18px;

    font-weight: 800;

    color: #212529;
}

.admin-card-subtitle {
    color: #6c757d;

    font-size: 12px;

    margin-top: 3px;
}

.card-badge {
    padding: 7px 12px;

    border-radius: 999px;

    font-size: 11px;

    font-weight: 800;
}

.badge-green {
    color: #198754;

    background: #e7f7ef;
}

.badge-blue {
    color: #0d6efd;

    background: #e8f1ff;
}


/* =====================================================
   PAIEMENTS
===================================================== */

.payment-item {
    padding: 20px 25px;

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;

    border-bottom:
        1px solid #f0f0f0;

    transition: .3s;
}

.payment-item:last-child {
    border-bottom: none;
}

.payment-item:hover {
    background:
        linear-gradient(
            90deg,
            #f5f9ff,
            #f3fff8
        );

    padding-left: 30px;
}

.payment-left {
    display: flex;

    align-items: center;

    gap: 13px;

    min-width: 0;
}

.payment-icon {
    width: 45px;
    height: 45px;

    flex-shrink: 0;

    border-radius: 14px;

    display: flex;

    align-items: center;
    justify-content: center;

    background: #e7f7ef;

    font-size: 20px;
}

.payment-user {
    color: #212529;

    font-weight: 700;

    white-space: nowrap;

    overflow: hidden;

    text-overflow: ellipsis;
}

.payment-info {
    color: #6c757d;

    font-size: 12px;

    margin-top: 4px;
}

.payment-amount {
    flex-shrink: 0;

    color: #198754;

    font-size: 14px;

    font-weight: 800;
}


/* =====================================================
   LOGEMENTS
===================================================== */

.admin-property-item {
    padding: 20px 25px;

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;

    border-bottom:
        1px solid #f0f0f0;

    transition: .3s;
}

.admin-property-item:last-child {
    border-bottom: none;
}

.admin-property-item:hover {
    background:
        linear-gradient(
            90deg,
            #f5f9ff,
            #f3fff8
        );

    padding-left: 30px;
}

.admin-property-left {
    display: flex;

    align-items: center;

    gap: 13px;

    min-width: 0;
}

.admin-property-icon {
    width: 45px;
    height: 45px;

    flex-shrink: 0;

    border-radius: 14px;

    display: flex;

    align-items: center;
    justify-content: center;

    background:
        linear-gradient(
            135deg,
            #e8f1ff,
            #e9f8f1
        );

    font-size: 20px;
}

.admin-property-title {
    color: #212529;

    font-weight: 700;

    white-space: nowrap;

    overflow: hidden;

    text-overflow: ellipsis;
}

.admin-property-info {
    color: #6c757d;

    font-size: 12px;

    margin-top: 4px;
}

.status-badge {
    flex-shrink: 0;

    padding: 7px 12px;

    border-radius: 999px;

    font-size: 11px;

    font-weight: 800;
}

.status-active {
    color: #198754;

    background: #e7f7ef;
}

.status-pending {
    color: #b45309;

    background: #fff6db;
}


/* =====================================================
   EMPTY STATE
===================================================== */

.admin-empty {
    padding: 55px 20px;

    text-align: center;

    color: #6c757d;
}

.admin-empty-icon {
    width: 70px;
    height: 70px;

    margin:
        auto auto 15px;

    border-radius: 22px;

    display: flex;

    align-items: center;
    justify-content: center;

    font-size: 30px;

    background:
        linear-gradient(
            135deg,
            #edf5ff,
            #ecfff5
        );
}


/* =====================================================
   RESPONSIVE
===================================================== */

@media(max-width: 1200px) {

    .admin-stats-grid {
        grid-template-columns:
            repeat(2, 1fr);
    }
}

@media(max-width: 1000px) {

    .admin-content-grid {
        grid-template-columns: 1fr;
    }

    .admin-hero-content {
        align-items: stretch;
    }
}

@media(max-width: 768px) {

    .admin-page {
        padding: 20px 14px;
    }

    .admin-hero {
        padding: 25px 20px;
    }

    .admin-hero-content {
        flex-direction: column;
    }

    .admin-hero-title {
        font-size: 25px;
    }

    .revenue-card {
        width: 100%;

        min-width: 0;
    }

    .admin-stats-grid {
        grid-template-columns:
            repeat(2, 1fr);

        gap: 15px;
    }

    .admin-stat-card {
        padding: 20px;
    }

    .quick-card {
        padding: 20px;
    }

    .quick-actions {
        flex-direction: column;
    }

    .quick-action {
        width: 100%;
    }

    .admin-card-header {
        padding: 20px;
    }

    .payment-item,
    .admin-property-item {
        padding: 18px;
    }

    .payment-item:hover,
    .admin-property-item:hover {
        padding-left: 20px;
    }
}

@media(max-width: 500px) {

    .admin-hero-title {
        font-size: 22px;
    }

    .admin-hero-subtitle {
        font-size: 14px;
    }

    .admin-stats-grid {
        grid-template-columns: 1fr;
    }

    .admin-stat-number {
        font-size: 30px;
    }

    .admin-property-item,
    .payment-item {
        align-items: flex-start;
    }

    .admin-property-left,
    .payment-left {
        align-items: flex-start;
    }

    .admin-property-title,
    .payment-user {
        max-width: 180px;
    }

    .admin-card-title {
        font-size: 16px;
    }

    .admin-card-header {
        align-items: flex-start;
    }

    .card-badge {
        font-size: 10px;

        padding: 6px 9px;
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


<div class="admin-page">

    <div class="admin-container">


        {{-- =====================================================
             HERO
        ===================================================== --}}

        <section class="admin-hero">

            <div class="admin-hero-content">

                <div>

                    <div class="admin-badge">
                        🛡️ Administration
                    </div>

                    <h1 class="admin-hero-title">
                        Bonjour, {{ auth()->user()->name }}.
                    </h1>

                    <p class="admin-hero-subtitle">
                        Surveillez les annonces, l'activité des utilisateurs
                        et les revenus de la plateforme.
                    </p>

                </div>


                <div class="revenue-card">

                    <div class="revenue-label">
                        Revenus ce mois
                    </div>

                    <div class="revenue-value">
                        {{ number_format($statistiques['revenusMois'], 0, ',', ' ') }}
                        FCFA
                    </div>

                </div>

            </div>

        </section>


        {{-- =====================================================
             STATISTIQUES
        ===================================================== --}}

        <section class="admin-stats-grid">


            {{-- UTILISATEURS --}}

            <article class="admin-stat-card">

                <div class="admin-stat-content">

                    <div>

                        <div class="admin-stat-label">
                            Utilisateurs
                        </div>

                        <div class="admin-stat-number blue-number">
                            {{ number_format($statistiques['utilisateurs']) }}
                        </div>

                        <div class="admin-stat-description">
                            {{ $statistiques['bailleurs'] }} bailleurs
                            ·
                            {{ $statistiques['locataires'] }} locataires
                        </div>

                    </div>

                    <div class="admin-stat-icon icon-blue">
                        👥
                    </div>

                </div>

            </article>


            {{-- LOGEMENTS --}}

            <article class="admin-stat-card">

                <div class="admin-stat-content">

                    <div>

                        <div class="admin-stat-label">
                            Logements publiés
                        </div>

                        <div class="admin-stat-number blue-number">
                            {{ number_format($statistiques['logements']) }}
                        </div>

                        <div class="admin-stat-description"
                             style="color:#198754;font-weight:700;">
                            {{ $statistiques['logementsActifs'] }}
                            actifs
                        </div>

                    </div>

                    <div class="admin-stat-icon icon-green">
                        🏠
                    </div>

                </div>

            </article>


            {{-- PAIEMENTS --}}

            <article class="admin-stat-card">

                <div class="admin-stat-content">

                    <div>

                        <div class="admin-stat-label">
                            Paiements confirmés
                        </div>

                        <div class="admin-stat-number purple-number">
                            {{ number_format($statistiques['paiementsConfirmes']) }}
                        </div>

                        <div class="admin-stat-description">
                            Toutes périodes confondues
                        </div>

                    </div>

                    <div class="admin-stat-icon icon-purple">
                        💳
                    </div>

                </div>

            </article>


            {{-- ACTIONS RAPIDES --}}

            <article class="quick-card">

                <div class="quick-header">

                    <div class="quick-icon">
                        ⚡
                    </div>

                    <div>

                        <div class="quick-title">
                            Actions rapides
                        </div>

                        <div class="quick-subtitle">
                            Accédez rapidement aux outils
                        </div>

                    </div>

                </div>


                <div class="quick-actions">

                    <a
                        href="{{ route('admin.users') }}"
                        class="quick-action action-violet"
                    >
                        👥
                        Utilisateurs
                    </a>

                    <a
                        href="#logements"
                        class="quick-action action-blue"
                    >
                        🏠
                        Logements
                    </a>

                    <a
                        href="{{ route('admin.logements') }}"
                        class="quick-action action-blue"
                    >
                        🛡️
                        Modérer
                    </a>

                    <a
                        href="{{ route('admin.payments') }}"
                        class="quick-action action-green"
                    >
                        💳
                        Paiements
                    </a>

                </div>

            </article>

        </section>


        {{-- =====================================================
             CONTENU
        ===================================================== --}}

        <section class="admin-content-grid">


            {{-- =================================================
                 PAIEMENTS
            ================================================== --}}

            <div
                id="paiements"
                class="admin-card"
            >

                <div class="admin-card-header">

                    <div class="admin-card-header-left">

                        <div class="admin-card-icon">
                            💳
                        </div>

                        <div>

                            <div class="admin-card-title">
                                Derniers paiements
                            </div>

                            <div class="admin-card-subtitle">
                                Activité financière récente
                            </div>

                        </div>

                    </div>


                    <span class="card-badge badge-green">
                        Confirmés
                    </span>

                </div>


                <div>

                    @forelse($paiementsRecents as $paiement)

                        <div class="payment-item">

                            <div class="payment-left">

                                <div class="payment-icon">
                                    💰
                                </div>

                                <div>

                                    <div class="payment-user">
                                        {{ $paiement->user?->name ?? 'Utilisateur supprimé' }}
                                    </div>

                                    <div class="payment-info">

                                        {{ str_replace('_', ' ', $paiement->type) }}

                                        <span>•</span>

                                        {{ $paiement->paye_le?->format('d/m/Y') }}

                                    </div>

                                </div>

                            </div>


                            <strong class="payment-amount">

                                {{ number_format(
                                    $paiement->montant,
                                    0,
                                    ',',
                                    ' '
                                ) }}

                                FCFA

                            </strong>

                        </div>

                    @empty

                        <div class="admin-empty">

                            <div class="admin-empty-icon">
                                💳
                            </div>

                            <strong>
                                Aucun paiement confirmé
                            </strong>

                            <p>
                                Aucun paiement confirmé pour le moment.
                            </p>

                        </div>

                    @endforelse

                </div>

            </div>


            {{-- =================================================
                 LOGEMENTS
            ================================================== --}}

            <div
                id="logements"
                class="admin-card"
            >

                <div class="admin-card-header">

                    <div class="admin-card-header-left">

                        <div class="admin-card-icon">
                            🏠
                        </div>

                        <div>

                            <div class="admin-card-title">
                                Dernières annonces
                            </div>

                            <div class="admin-card-subtitle">
                                Activité récente des logements
                            </div>

                        </div>

                    </div>


                    <span class="card-badge badge-blue">
                        À surveiller
                    </span>

                </div>


                <div>

                    @forelse($logementsRecents as $logement)

                        <div class="admin-property-item">

                            <div class="admin-property-left">

                                <div class="admin-property-icon">
                                    🏠
                                </div>

                                <div>

                                    <div class="admin-property-title">
                                        {{ $logement->titre }}
                                    </div>

                                    <div class="admin-property-info">

                                        {{ $logement->bailleur?->name ?? 'Bailleur inconnu' }}

                                        <span>•</span>

                                        {{ $logement->ville }}

                                    </div>

                                </div>

                            </div>


                            <span
                                class="status-badge
                                {{ $logement->statut === 'actif'
                                    ? 'status-active'
                                    : 'status-pending'
                                }}"
                            >

                                {{ ucfirst($logement->statut) }}

                            </span>

                        </div>

                    @empty

                        <div class="admin-empty">

                            <div class="admin-empty-icon">
                                🏠
                            </div>

                            <strong>
                                Aucune annonce
                            </strong>

                            <p>
                                Aucune annonce publiée pour le moment.
                            </p>

                        </div>

                    @endforelse

                </div>

            </div>

        </section>

    </div>

</div>

</x-app-layout>