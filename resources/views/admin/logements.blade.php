<x-app-layout>

<style>

/* =====================================================
   GLOBAL
===================================================== */

* {
    box-sizing: border-box;
}

.moderation-page {
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

.moderation-container {
    max-width: 1400px;
    margin: auto;
}


/* =====================================================
   HERO
===================================================== */

.moderation-hero {
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

.moderation-hero::before {
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

.moderation-hero::after {
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

    padding:
        7px 12px;

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

    padding:
        13px 20px;

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
   FILTER CARD
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
    display: grid;

    grid-template-columns:
        1.5fr 1fr auto;

    gap: 12px;
}

.filter-input,
.filter-select {
    width: 100%;

    height: 45px;

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

.filter-input:focus,
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
   SUCCESS
===================================================== */

.success-message {
    display: flex;

    align-items: center;

    gap: 12px;

    margin-bottom: 20px;

    padding:
        15px 18px;

    border-radius: 15px;

    background: #e7f7ef;

    color: #198754;

    border:
        1px solid
        rgba(25,135,84,.10);

    font-size: 14px;

    font-weight: 700;

    animation:
        slideDown .5s ease;
}

.success-icon {
    width: 36px;
    height: 36px;

    display: flex;

    align-items: center;
    justify-content: center;

    flex-shrink: 0;

    border-radius: 11px;

    background: white;

    font-size: 17px;
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
        #eef5ff;

    color:
        #0d6efd;

    font-size: 11px;

    font-weight: 800;
}


/* =====================================================
   TABLE
===================================================== */

.table-wrapper {
    overflow-x: auto;
}

.moderation-table {
    width: 100%;

    border-collapse: collapse;

    min-width: 900px;
}

.moderation-table thead {
    background:
        linear-gradient(
            90deg,
            #f7fbff,
            #f5fff9
        );
}

.moderation-table th {
    padding:
        16px 22px;

    text-align: left;

    color: #6c757d;

    font-size: 11px;

    font-weight: 800;

    text-transform: uppercase;

    letter-spacing: .5px;
}

.moderation-table td {
    padding:
        19px 22px;

    border-top:
        1px solid #f0f0f0;

    vertical-align: middle;
}

.moderation-row {
    transition: .3s;
}

.moderation-row:hover {
    background:
        linear-gradient(
            90deg,
            #f6faff,
            #f5fff9
        );
}


/* =====================================================
   ANNONCE
===================================================== */

.property-cell {
    display: flex;

    align-items: center;

    gap: 14px;
}

.property-icon {
    width: 48px;
    height: 48px;

    flex-shrink: 0;

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

.property-title {
    color: #212529;

    font-weight: 800;

    max-width: 280px;

    overflow: hidden;

    text-overflow: ellipsis;

    white-space: nowrap;
}

.property-location {
    color: #6c757d;

    font-size: 12px;

    margin-top: 4px;
}


/* =====================================================
   BAILLEUR
===================================================== */

.owner-cell {
    display: flex;

    align-items: center;

    gap: 9px;

    color: #343a40;

    font-weight: 600;

    white-space: nowrap;
}

.owner-avatar {
    width: 36px;
    height: 36px;

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
   PRICE
===================================================== */

.price-value {
    color: #198754;

    font-weight: 800;

    white-space: nowrap;
}


/* =====================================================
   STATUS
===================================================== */

.status-badge {
    display: inline-flex;

    align-items: center;

    gap: 6px;

    padding:
        7px 12px;

    border-radius: 999px;

    font-size: 11px;

    font-weight: 800;

    white-space: nowrap;
}

.status-dot {
    width: 6px;
    height: 6px;

    border-radius: 50%;
}

.status-brouillon {
    color: #b45309;

    background: #fff6db;
}

.status-brouillon .status-dot {
    background: #f59e0b;
}

.status-actif {
    color: #198754;

    background: #e7f7ef;
}

.status-actif .status-dot {
    background: #198754;
}

.status-loue {
    color: #0d6efd;

    background: #e8f1ff;
}

.status-loue .status-dot {
    background: #0d6efd;
}

.status-archive {
    color: #dc3545;

    background: #ffecef;
}

.status-archive .status-dot {
    background: #dc3545;
}


/* =====================================================
   MODERATION
===================================================== */

.moderation-form {
    display: flex;

    align-items: center;

    gap: 8px;
}

.moderation-select {
    height: 39px;

    padding:
        0 11px;

    border:
        1px solid #dfe5eb;

    border-radius: 10px;

    background: white;

    color: #343a40;

    font-size: 12px;

    font-weight: 600;

    outline: none;

    cursor: pointer;

    transition: .3s;
}

.moderation-select:focus {
    border-color: #0d6efd;

    box-shadow:
        0 0 0 3px
        rgba(13,110,253,.08);
}

.moderation-button {
    height: 39px;

    padding:
        0 15px;

    border: none;

    border-radius: 10px;

    background:
        linear-gradient(
            135deg,
            #0d6efd,
            #198754
        );

    color: white;

    font-size: 12px;

    font-weight: 800;

    cursor: pointer;

    white-space: nowrap;

    transition: .3s;
}

.moderation-button:hover {
    transform:
        translateY(-2px);

    box-shadow:
        0 7px 16px
        rgba(13,110,253,.20);
}


/* =====================================================
   EMPTY
===================================================== */

.empty-state {
    padding:
        60px 20px;

    text-align: center;

    color: #6c757d;
}

.empty-icon {
    width: 70px;
    height: 70px;

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

@media(max-width: 1000px) {

    .filter-form {
        grid-template-columns:
            1fr 1fr;
    }

    .filter-button {
        width: 100%;
    }
}

@media(max-width: 768px) {

    .moderation-page {
        padding:
            20px 14px;
    }

    .moderation-hero {
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
        grid-template-columns: 1fr;
    }

    .table-header {
        padding: 20px;
    }

    .moderation-table th,
    .moderation-table td {
        padding:
            15px 18px;
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


<div class="moderation-page">

    <div class="moderation-container">


        {{-- =====================================================
             HERO
        ===================================================== --}}

        <section class="moderation-hero">

            <div class="hero-content">

                <div class="hero-left">

                    <div class="hero-badge">
                        🛡️ Administration
                    </div>

                    <h1 class="hero-title">
                        Modération des logements
                    </h1>

                    <p class="hero-subtitle">
                        Vérifiez, validez ou masquez les annonces
                        publiées sur CHEZMW.
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
             FILTRES
        ===================================================== --}}

        <section class="filter-card">

            <div class="filter-header">

                <div class="filter-icon">
                    🔎
                </div>

                <div>

                    <div class="filter-title">
                        Rechercher une annonce
                    </div>

                    <div class="filter-subtitle">
                        Filtrez par titre, ville, quartier ou statut.
                    </div>

                </div>

            </div>


            <form
                method="GET"
                class="filter-form"
            >

                {{-- DONNÉE CONSERVÉE --}}

                <input
                    name="q"
                    value="{{ request('q') }}"
                    placeholder="Titre, ville, quartier"
                    class="filter-input"
                >


                {{-- DONNÉE CONSERVÉE --}}

                <select
                    name="statut"
                    class="filter-select"
                >

                    <option value="">
                        Tous les statuts
                    </option>

                    <option
                        value="brouillon"
                        {{ request('statut') == 'brouillon' ? 'selected' : '' }}
                    >
                        En attente
                    </option>

                    <option
                        value="actif"
                        {{ request('statut') == 'actif' ? 'selected' : '' }}
                    >
                        Actif
                    </option>

                    <option
                        value="loue"
                        {{ request('statut') == 'loue' ? 'selected' : '' }}
                    >
                        Loué
                    </option>

                    <option
                        value="archive"
                        {{ request('statut') == 'archive' ? 'selected' : '' }}
                    >
                        Refusé / masqué
                    </option>

                </select>


                <button
                    type="submit"
                    class="filter-button"
                >
                    🔎 Filtrer
                </button>

            </form>

        </section>


        {{-- =====================================================
             MESSAGE SUCCESS
        ===================================================== --}}

        @if(session('success'))

            <div class="success-message">

                <div class="success-icon">
                    ✓
                </div>

                <span>
                    {{ session('success') }}
                </span>

            </div>

        @endif


        {{-- =====================================================
             TABLEAU
        ===================================================== --}}

        <section class="table-card">


            <div class="table-header">

                <div class="table-header-left">

                    <div class="table-header-icon">
                        🏠
                    </div>

                    <div>

                        <div class="table-title">
                            Modération des logements
                        </div>

                        <div class="table-subtitle">
                            Gérez les annonces présentes sur CHEZMW.
                        </div>

                    </div>

                </div>


                <div class="table-badge">
                    🛡️ Modération
                </div>

            </div>


            <div class="table-wrapper">

                @if($logements->count() > 0)

                    <table class="moderation-table">

                        <thead>

                            <tr>

                                <th>
                                    Annonce
                                </th>

                                <th>
                                    Bailleur
                                </th>

                                <th>
                                    Prix
                                </th>

                                <th>
                                    Statut
                                </th>

                                <th>
                                    Modération
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($logements as $logement)

                                <tr class="moderation-row">


                                    {{-- =================================================
                                         ANNONCE
                                    ================================================== --}}

                                    <td>

                                        <div class="property-cell">

                                            <div class="property-icon">
                                                🏠
                                            </div>

                                            <div>

                                                <div class="property-title">
                                                    {{ $logement->titre }}
                                                </div>

                                                <div class="property-location">

                                                    {{ $logement->quartier }},
                                                    {{ $logement->ville }}

                                                </div>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- =================================================
                                         BAILLEUR
                                    ================================================== --}}

                                    <td>

                                        <div class="owner-cell">

                                            <div class="owner-avatar">
                                                👤
                                            </div>

                                            <span>
                                                {{ $logement->bailleur?->name }}
                                            </span>

                                        </div>

                                    </td>


                                    {{-- =================================================
                                         PRIX
                                    ================================================== --}}

                                    <td>

                                        <span class="price-value">

                                            {{ number_format(
                                                $logement->prix,
                                                0,
                                                ',',
                                                ' '
                                            ) }}

                                            FCFA

                                        </span>

                                    </td>


                                    {{-- =================================================
                                         STATUT
                                    ================================================== --}}

                                    <td>

                                        @php

                                            $statusClass = match($logement->statut) {

                                                'actif' =>
                                                    'status-actif',

                                                'loue' =>
                                                    'status-loue',

                                                'archive' =>
                                                    'status-archive',

                                                default =>
                                                    'status-brouillon',

                                            };

                                        @endphp


                                        <span
                                            class="status-badge {{ $statusClass }}"
                                        >

                                            <span class="status-dot"></span>

                                            {{ ucfirst($logement->statut) }}

                                        </span>

                                    </td>


                                    {{-- =================================================
                                         MODÉRATION
                                    ================================================== --}}

                                    <td>

                                        <form
                                            method="POST"
                                            action="{{ route(
                                                'admin.logements.update',
                                                $logement
                                            ) }}"
                                            class="moderation-form"
                                        >

                                            @csrf

                                            @method('PATCH')


                                            <select
                                                name="statut"
                                                class="moderation-select"
                                            >

                                                <option value="brouillon">
                                                    En attente
                                                </option>

                                                <option value="actif">
                                                    Valider
                                                </option>

                                                <option value="archive">
                                                    Refuser / masquer
                                                </option>

                                                <option value="loue">
                                                    Loué
                                                </option>

                                            </select>


                                            <button
                                                type="submit"
                                                class="moderation-button"
                                            >
                                                Appliquer
                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>


                @else


                    {{-- =================================================
                         AUCUN LOGEMENT
                    ================================================== --}}

                    <div class="empty-state">

                        <div class="empty-icon">
                            🏠
                        </div>

                        <strong>
                            Aucun logement trouvé
                        </strong>

                        <p>
                            Aucune annonce ne correspond aux critères actuels.
                        </p>

                    </div>


                @endif

            </div>

        </section>


        {{-- =====================================================
             PAGINATION
        ===================================================== --}}

        <div class="pagination-container">

            {{ $logements->links() }}

        </div>

    </div>

</div>

</x-app-layout>