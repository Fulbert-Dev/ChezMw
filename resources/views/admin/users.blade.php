<x-app-layout>

<style>

/* =====================================================
   GLOBAL
===================================================== */

* {
    box-sizing: border-box;
}

.users-page {
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

.users-container {
    max-width: 1400px;
    margin: auto;
}


/* =====================================================
   HERO
===================================================== */

.users-hero {
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

.users-hero::before {
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

.users-hero::after {
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

    flex-wrap: wrap;
}

.filter-input,
.filter-select {
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

.filter-input {
    min-width: 250px;
}

.filter-select {
    min-width: 180px;
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

    margin-bottom: 25px;

    padding: 16px 20px;

    border-radius: 16px;

    background:
        linear-gradient(
            135deg,
            #eaf8f1,
            #f3fff8
        );

    border:
        1px solid
        rgba(25,135,84,.10);

    color: #198754;

    font-size: 14px;

    font-weight: 700;

    box-shadow:
        0 8px 20px
        rgba(25,135,84,.06);

    animation:
        slideUp .6s ease;
}

.success-icon {
    width: 38px;
    height: 38px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 12px;

    background: white;

    font-size: 18px;
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

.users-table {
    width: 100%;

    border-collapse: collapse;

    min-width: 850px;
}

.users-table thead {
    background:
        linear-gradient(
            90deg,
            #f7fbff,
            #f5fff9
        );
}

.users-table th {
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

.users-table td {
    padding:
        19px 22px;

    border-top:
        1px solid #f0f0f0;

    vertical-align: middle;

    font-size: 14px;
}

.user-row {
    transition: .3s;
}

.user-row:hover {
    background:
        linear-gradient(
            90deg,
            #f6faff,
            #f5fff9
        );
}


/* =====================================================
   USER
===================================================== */

.user-cell {
    display: flex;

    align-items: center;

    gap: 12px;

    min-width: 210px;
}

.user-avatar {
    width: 44px;
    height: 44px;

    flex-shrink: 0;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 14px;

    color: white;

    background:
        linear-gradient(
            135deg,
            #0d6efd,
            #198754
        );

    font-size: 17px;

    font-weight: 800;
}

.user-name {
    color: #212529;

    font-weight: 800;
}

.user-email {
    margin-top: 4px;

    color: #6c757d;

    font-size: 12px;
}


/* =====================================================
   ROLE
===================================================== */

.role-badge {
    display: inline-flex;

    align-items: center;

    gap: 7px;

    padding:
        7px 12px;

    border-radius: 10px;

    background:
        #f3f5f8;

    color:
        #495057;

    font-size: 12px;

    font-weight: 800;
}


/* =====================================================
   ETAT
===================================================== */

.status-badge {
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

.status-dot {
    width: 7px;
    height: 7px;

    border-radius: 50%;
}

.status-active {
    color: #198754;

    background:
        #e7f7ef;
}

.status-active .status-dot {
    background: #198754;
}

.status-suspended {
    color: #dc3545;

    background:
        #fdebec;
}

.status-suspended .status-dot {
    background: #dc3545;
}


/* =====================================================
   DATE
===================================================== */

.date-cell {
    display: flex;

    align-items: center;

    gap: 9px;

    color: #495057;

    white-space: nowrap;
}

.date-icon {
    width: 36px;
    height: 36px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 11px;

    background:
        #eef5ff;

    font-size: 16px;
}


/* =====================================================
   ACTION
===================================================== */

.action-form {
    margin: 0;
}

.action-button {
    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 7px;

    padding:
        9px 14px;

    border: none;

    border-radius: 11px;

    font-size: 12px;

    font-weight: 800;

    cursor: pointer;

    transition: .3s;
}

.action-button:hover {
    transform:
        translateY(-2px);

    box-shadow:
        0 7px 16px
        rgba(0,0,0,.08);
}

.action-suspend {
    background:
        #fdebec;

    color:
        #dc3545;
}

.action-reactivate {
    background:
        #e7f7ef;

    color:
        #198754;
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

    .users-page {
        padding:
            20px 14px;
    }

    .users-hero {
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

    .filter-input,
    .filter-select,
    .filter-button {
        width: 100%;

        min-width: 0;
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


<div class="users-page">

    <div class="users-container">


        {{-- =====================================================
             HERO
        ===================================================== --}}

        <section class="users-hero">

            <div class="hero-content">

                <div class="hero-left">

                    <div class="hero-badge">
                        👥 Administration
                    </div>

                    <h1 class="hero-title">
                        Utilisateurs
                    </h1>

                    <p class="hero-subtitle">
                        Gérez les comptes, les rôles et l'état
                        des utilisateurs de CHEZMW.
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
                        Rechercher un utilisateur
                    </div>

                    <div class="filter-subtitle">
                        Filtrez les comptes par nom, e-mail ou rôle.
                    </div>

                </div>

            </div>


            {{-- =================================================
                 LOGIQUE ORIGINALE CONSERVÉE
            ================================================== --}}

            <form class="filter-form">

                <input
                    name="q"
                    value="{{ request('q') }}"
                    placeholder="Nom ou e-mail"
                    class="filter-input"
                >


                <select
                    name="role"
                    class="filter-select"
                >

                    <option value="">
                        Tous les rôles
                    </option>

                    <option value="bailleur">
                        Bailleur
                    </option>

                    <option value="locataire">
                        Locataire
                    </option>

                    <option value="admin">
                        Admin
                    </option>

                </select>


                <button
                    type="submit"
                    class="filter-button"
                >
                    🔎 Rechercher
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
                        👥
                    </div>

                    <div>

                        <div class="table-title">
                            Liste des utilisateurs
                        </div>

                        <div class="table-subtitle">
                            Consultez et gérez les comptes de la plateforme.
                        </div>

                    </div>

                </div>


                <div class="table-badge">
                    👤 Comptes
                </div>

            </div>


            <div class="table-wrapper">

                <table class="users-table">

                    <thead>

                        <tr>

                            <th>
                                Utilisateur
                            </th>

                            <th>
                                Rôle
                            </th>

                            <th>
                                État
                            </th>

                            <th>
                                Inscrit le
                            </th>

                            <th>
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        {{-- =================================================
                             LOGIQUE ORIGINALE CONSERVÉE À 100 %
                        ================================================== --}}

                        @foreach($users as $user)

                            <tr class="user-row">


                                {{-- UTILISATEUR --}}

                                <td>

                                    <div class="user-cell">

                                        <div class="user-avatar">
                                            👤
                                        </div>

                                        <div>

                                            <div class="user-name">
                                                {{ $user->name }}
                                            </div>

                                            <div class="user-email">
                                                {{ $user->email }}
                                            </div>

                                        </div>

                                    </div>

                                </td>


                                {{-- RÔLE --}}

                                <td>

                                    <span class="role-badge">

                                        🛡️

                                        {{ ucfirst($user->role) }}

                                    </span>

                                </td>


                                {{-- ÉTAT --}}

                                <td>

                                    @if($user->suspended_at)

                                        <span
                                            class="status-badge status-suspended"
                                        >

                                            <span
                                                class="status-dot"
                                            ></span>

                                            Suspendu

                                        </span>

                                    @else

                                        <span
                                            class="status-badge status-active"
                                        >

                                            <span
                                                class="status-dot"
                                            ></span>

                                            Actif

                                        </span>

                                    @endif

                                </td>


                                {{-- DATE --}}

                                <td>

                                    <div class="date-cell">

                                        <div class="date-icon">
                                            📅
                                        </div>

                                        <span>
                                            {{ $user->created_at->format('d/m/Y') }}
                                        </span>

                                    </div>

                                </td>


                                {{-- ACTION --}}

                                <td>

                                    @if($user->id !== auth()->id())

                                        <form
                                            method="POST"
                                            action="{{ route('admin.users.suspension',$user) }}"
                                            class="action-form"
                                        >

                                            @csrf

                                            @method('PATCH')


                                            <button
                                                type="submit"
                                                class="action-button
                                                {{
                                                    $user->suspended_at
                                                        ? 'action-reactivate'
                                                        : 'action-suspend'
                                                }}"
                                            >

                                                @if($user->suspended_at)

                                                    ✓ Réactiver

                                                @else

                                                    ⛔ Suspendre

                                                @endif

                                            </button>

                                        </form>

                                    @endif

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </section>


        {{-- =====================================================
             PAGINATION
        ===================================================== --}}

        <div class="pagination-container">

            {{ $users->links() }}

        </div>

    </div>

</div>

</x-app-layout>