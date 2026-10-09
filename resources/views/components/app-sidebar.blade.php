@once
    @auth
        @php
            $user = auth()->user();

            $roleLabel = match ($user->role) {
                'admin' => 'Administration',
                'bailleur' => 'Espace bailleur',
                default => 'Espace locataire',
            };
        @endphp

        <div class="cm-app-navigation">

            {{-- Bouton menu mobile --}}
            <button
                type="button"
                class="cm-menu-toggle"
                aria-label="Ouvrir le menu"
                aria-expanded="false"
            >
                <span></span>
                <span></span>
                <span></span>
            </button>

            {{-- Overlay mobile --}}
            <div class="cm-nav-overlay" aria-hidden="true"></div>

            {{-- Sidebar --}}
            <aside class="cm-app-sidebar" aria-label="Menu de navigation">

                {{-- ================================
                     LOGO / MARQUE
                ================================= --}}
                <a href="{{ route('dashboard') }}" class="cm-app-brand">

                    {{-- Logo carré --}}
                    <span class="cm-brand-mark">
                        <img
                            src="{{ asset('images/ChatGPT Image 7 sept. 2026, 21_37_28 - Copie.png') }}"
                            alt="ChezMoi"
                        >
                    </span>

                    {{-- Nom + rôle --}}
                    <span class="cm-brand-info">

                        <img
                            src="{{ asset('images/ChatGPT Image 7 sept. 2026, 21_37_28 - Copie (2).png') }}"
                            alt="ChezMoi"
                        >

                        <small>{{ $roleLabel }}</small>

                    </span>

                </a>


                {{-- ================================
                     NAVIGATION
                ================================= --}}
                <nav class="cm-app-nav" aria-label="Navigation principale">

                    @if($user->role === 'admin')

                        <a
                            href="{{ route('admin.dashboard') }}"
                            class="{{ request()->routeIs('admin.dashboard') ? 'cm-active' : '' }}"
                        >
                            <span>▦</span>
                            Tableau de bord
                        </a>

                        <a
                            href="{{ route('admin.users') }}"
                            class="{{ request()->routeIs('admin.users*') ? 'cm-active' : '' }}"
                        >
                            <span>♙</span>
                            Utilisateurs
                        </a>

                        <a
                            href="{{ route('admin.logements') }}"
                            class="{{ request()->routeIs('admin.logements*') ? 'cm-active' : '' }}"
                        >
                            <span>⌂</span>
                            Logements
                        </a>

                        <a
                            href="{{ route('admin.payments') }}"
                            class="{{ request()->routeIs('admin.payments*') ? 'cm-active' : '' }}"
                        >
                            <span>¤</span>
                            Paiements
                        </a>

                    @elseif($user->role === 'bailleur')

                        <a
                            href="{{ route('bailleur.dashboard') }}"
                            class="{{ request()->routeIs('bailleur.dashboard') ? 'cm-active' : '' }}"
                        >
                            <span>▦</span>
                            Tableau de bord
                        </a>

                        <a
                            href="{{ route('bailleur.logements.index') }}"
                            class="{{ request()->routeIs('bailleur.logements.*') && !request()->routeIs('bailleur.logements.create') ? 'cm-active' : '' }}"
                        >
                            <span>⌂</span>
                            Mes logements
                        </a>

                        <a
                            href="{{ route('bailleur.logements.create') }}"
                            class="{{ request()->routeIs('bailleur.logements.create') ? 'cm-active' : '' }}"
                        >
                            <span>＋</span>
                            Ajouter un logement
                        </a>

                        <a
                            href="{{ route('bailleur.messages.index') }}"
                            class="{{ request()->routeIs('bailleur.messages.*') ? 'cm-active' : '' }}"
                        >
                            <span>◌</span>
                            Messages
                        </a>

                        <a
                            href="{{ route('bailleur.offres') }}"
                            class="{{ request()->routeIs('bailleur.offres') ? 'cm-active' : '' }}"
                        >
                            <span>✦</span>
                            Mes offres
                        </a>

                        <a
                            href="{{ route('bailleur.paiements.index') }}"
                            class="{{ request()->routeIs('bailleur.paiements.*') ? 'cm-active' : '' }}"
                        >
                            <span>¤</span>
                            Paiements
                        </a>

                    @else

                        <a
                            href="{{ route('locataire.dashboard') }}"
                            class="{{ request()->routeIs('locataire.dashboard') ? 'cm-active' : '' }}"
                        >
                            <span>▦</span>
                            Tableau de bord
                        </a>

                        <a
                            href="{{ route('locataire.logements.index') }}"
                            class="{{ request()->routeIs('locataire.logements.*') ? 'cm-active' : '' }}"
                        >
                            <span>⌕</span>
                            Rechercher
                        </a>

                        <a
                            href="{{ route('favoris.index') }}"
                            class="{{ request()->routeIs('favoris.*') ? 'cm-active' : '' }}"
                        >
                            <span>♡</span>
                            Mes favoris
                        </a>

                        <a
                            href="{{ route('locataire.messages.index') }}"
                            class="{{ request()->routeIs('locataire.messages.*') || request()->routeIs('messages.*') ? 'cm-active' : '' }}"
                        >
                            <span>◌</span>
                            Messages
                        </a>

                    @endif


                    {{-- Profil --}}
                    <a
                        href="{{ route('profile.edit') }}"
                        class="{{ request()->routeIs('profile.*') ? 'cm-active' : '' }}"
                    >
                        <span>◉</span>
                        Mon profil
                    </a>

                </nav>


                {{-- ================================
                     UTILISATEUR
                ================================= --}}
                <div class="cm-app-user">

                    <a href="{{ route('profile.edit') }}" class="cm-user-link">

                        <span class="cm-user-avatar">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </span>

                        <span>
                            <strong>{{ $user->name }}</strong>
                            <small>{{ $roleLabel }}</small>
                        </span>

                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit">
                            ⇥ Se déconnecter
                        </button>
                    </form>

                </div>

            </aside>

        </div>


        {{-- ================================
             JAVASCRIPT
        ================================= --}}
        <script>
            (() => {

                const navigation = document.currentScript.previousElementSibling;

                const toggle = navigation?.querySelector('.cm-menu-toggle');
                const sidebar = navigation?.querySelector('.cm-app-sidebar');
                const overlay = navigation?.querySelector('.cm-nav-overlay');

                if (!toggle || !sidebar || !overlay) {
                    return;
                }

                const closeMenu = () => {

                    sidebar.classList.remove('cm-is-open');

                    overlay.classList.remove('cm-is-visible');

                    toggle.setAttribute(
                        'aria-expanded',
                        'false'
                    );

                };

                toggle.addEventListener('click', () => {

                    const isOpen =
                        sidebar.classList.toggle('cm-is-open');

                    overlay.classList.toggle(
                        'cm-is-visible',
                        isOpen
                    );

                    toggle.setAttribute(
                        'aria-expanded',
                        String(isOpen)
                    );

                });

                overlay.addEventListener(
                    'click',
                    closeMenu
                );

                navigation
                    .querySelectorAll(
                        '.cm-app-nav a, .cm-app-brand'
                    )
                    .forEach((link) => {

                        link.addEventListener(
                            'click',
                            closeMenu
                        );

                    });

            })();
        </script>


        {{-- ================================
             CSS
        ================================= --}}
        <style>

            :root {
                --cm-sidebar-width: 272px;
            }


            /* ================================
               BODY
            ================================= */

            body {
                padding-left: var(--cm-sidebar-width) !important;
                background: #f6f8fc !important;
            }


            /* ================================
               SIDEBAR
            ================================= */

            .cm-app-sidebar {

                position: fixed;

                inset: 0 auto 0 0;

                z-index: 1100;

                display: flex;

                flex-direction: column;

                width: var(--cm-sidebar-width);

                padding: 22px 14px 16px;

                color: #e8efff;

                background:
                    linear-gradient(
                        165deg,
                        #101d3d 0%,
                        #182d5c 52%,
                        #12664f 135%
                    );

                box-shadow:
                    12px 0 35px
                    rgba(15, 23, 42, .16);

            }


            /* ================================
               MARQUE / LOGO
            ================================= */

            .cm-app-brand {

                display: flex;

                align-items: center;

                gap: 11px;

                min-width: 0;

                padding: 6px 9px 25px;

                color: inherit;

                text-decoration: none;

            }


            /* Zone contenant le logo carré */

            .cm-brand-mark {

                display: flex;

                align-items: center;

                justify-content: center;

                flex: 0 0 46px;

                width: 46px;

                height: 46px;

                overflow: hidden;

                border-radius: 13px;

                background:
                    rgba(255,255,255,.08);

            }


            /* Image du logo carré */

            .cm-brand-mark img {

                display: block;

                width: 100%;

                height: 100%;

                padding: 4px;

                object-fit: contain;

                object-position: center;

            }


            /* Zone nom + rôle */

            .cm-brand-info {

                display: flex;

                flex: 1;

                flex-direction: column;

                justify-content: center;

                min-width: 0;

            }


            /* Image contenant le nom de l'application */

            .cm-brand-info img {

                display: block;

                width: 125px;

                max-width: 100%;

                height: 30px;

                max-height: 30px;

                object-fit: contain;

                object-position: left center;

            }


            /* Rôle */

            .cm-app-brand small {

                display: block;

                margin-top: 3px;

                color: #afc4ee;

                font-size: 11px;

                line-height: 1.2;

                white-space: nowrap;

            }


            /* Sécurité images */

            .cm-app-brand img {

                max-width: 100%;

            }


            /* ================================
               NAVIGATION
            ================================= */

            .cm-app-nav {

                display: grid;

                gap: 5px;

                padding-top: 6px;

            }


            .cm-app-nav a {

                display: flex;

                align-items: center;

                gap: 13px;

                min-height: 46px;

                padding: 0 13px;

                border-radius: 12px;

                color: #cbd9f4;

                text-decoration: none;

                font-size: 14px;

                font-weight: 650;

                transition: .2s ease;

            }


            .cm-app-nav a span {

                display: inline-grid;

                place-items: center;

                width: 20px;

                color: #9fc4ff;

                font-size: 20px;

            }


            .cm-app-nav a:hover,
            .cm-app-nav .cm-active {

                color: #fff;

                background:
                    rgba(255,255,255,.13);

                transform: translateX(3px);

            }


            .cm-app-nav .cm-active {

                box-shadow:
                    inset 3px 0 #57e4ad;

            }


            /* ================================
               UTILISATEUR
            ================================= */

            .cm-app-user {

                margin-top: auto;

                padding: 15px 9px 2px;

                border-top:
                    1px solid
                    rgba(255,255,255,.13);

            }


            .cm-user-link {

                display: flex;

                align-items: center;

                gap: 11px;

                color: inherit;

                text-decoration: none;

            }


            .cm-user-avatar {

                display: grid;

                place-items: center;

                flex: 0 0 37px;

                width: 37px;

                height: 37px;

                border-radius: 50%;

                background:
                    linear-gradient(
                        135deg,
                        #39a0ff,
                        #32c48d
                    );

                color: white;

                font-size: 15px;

                font-weight: 700;

            }


            .cm-user-link strong {

                display: block;

                max-width: 164px;

                overflow: hidden;

                color: #fff;

                font-size: 13px;

                text-overflow: ellipsis;

                white-space: nowrap;

            }


            .cm-user-link small {

                display: block;

                margin-top: 2px;

                color: #afc4ee;

                font-size: 11px;

            }


            .cm-app-user form {

                margin-top: 13px;

            }


            .cm-app-user button {

                width: 100%;

                padding: 9px 10px;

                border: 0;

                border-radius: 10px;

                background:
                    rgba(255,255,255,.08);

                color: #e2ebff;

                cursor: pointer;

                font: inherit;

                font-size: 12px;

                font-weight: 700;

                text-align: left;

                transition: .2s;

            }


            .cm-app-user button:hover {

                background:
                    rgba(255,255,255,.16);

                color: white;

            }


            /* ================================
               MOBILE
            ================================= */

            .cm-menu-toggle,
            .cm-nav-overlay {

                display: none;

            }


            @media (max-width: 900px) {

                body {

                    padding-left: 0 !important;

                    padding-top: 66px !important;

                }


                .cm-app-sidebar {

                    width: min(280px, 85vw);

                    transform:
                        translateX(-105%);

                    transition:
                        transform .25s ease;

                }


                .cm-app-sidebar.cm-is-open {

                    transform:
                        translateX(0);

                }


                .cm-menu-toggle {

                    position: fixed;

                    z-index: 1200;

                    top: 12px;

                    left: 12px;

                    display: grid;

                    gap: 4px;

                    width: 42px;

                    height: 42px;

                    padding: 11px;

                    border: 0;

                    border-radius: 12px;

                    background: #132752;

                    box-shadow:
                        0 6px 18px
                        rgba(15,23,42,.18);

                    cursor: pointer;

                }


                .cm-menu-toggle span {

                    display: block;

                    height: 2px;

                    border-radius: 2px;

                    background: white;

                }


                .cm-nav-overlay {

                    position: fixed;

                    z-index: 1050;

                    inset: 0;

                    background:
                        rgba(15,23,42,.45);

                }


                .cm-nav-overlay.cm-is-visible {

                    display: block;

                }


                /* Logo mobile */

                .cm-app-brand {

                    padding-bottom: 22px;

                }


                .cm-brand-mark {

                    flex-basis: 44px;

                    width: 44px;

                    height: 44px;

                }


                .cm-brand-info img {

                    width: 115px;

                    height: 28px;

                }

            }

        </style>

    @endauth
@endonce