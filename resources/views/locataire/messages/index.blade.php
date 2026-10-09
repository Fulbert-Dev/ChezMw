<x-app-layout>
    <x-app-sidebar />
<style>

/* =====================================================
   GLOBAL
===================================================== */

.messages-page {
    min-height: calc(100vh - 65px);

    background:
        radial-gradient(
            circle at 10% 15%,
            rgba(13,110,253,.10),
            transparent 30%
        ),
        radial-gradient(
            circle at 90% 85%,
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

.messages-container {
    max-width: 1100px;
    margin: auto;
}


/* =====================================================
   HEADER
===================================================== */

.messages-header {
    position: relative;
    overflow: hidden;

    padding: 28px 30px;

    margin-bottom: 25px;

    border-radius: 24px;

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

    animation:
        slideDown .7s ease;
}

.messages-header::before {
    content: "";

    position: absolute;

    width: 240px;
    height: 240px;

    border-radius: 50%;

    right: -80px;
    top: -130px;

    background:
        rgba(255,255,255,.08);

    animation:
        floating 6s ease-in-out infinite;
}

.messages-header::after {
    content: "";

    position: absolute;

    width: 150px;
    height: 150px;

    border-radius: 50%;

    left: 45%;
    bottom: -110px;

    background:
        rgba(255,255,255,.06);
}

.messages-header-content {
    position: relative;

    z-index: 2;

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 20px;
}

.header-left {
    display: flex;

    align-items: center;

    gap: 15px;
}

.header-icon {
    width: 58px;
    height: 58px;

    flex-shrink: 0;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 17px;

    background:
        rgba(255,255,255,.16);

    font-size: 27px;

    backdrop-filter: blur(5px);
}

.header-title {
    margin: 0;

    font-size: 27px;

    font-weight: 800;
}

.header-subtitle {
    margin: 6px 0 0;

    font-size: 14px;

    opacity: .9;

    line-height: 1.5;
}

.dashboard-link {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    gap: 8px;

    padding: 11px 17px;

    border-radius: 12px;

    background: white;

    color: #0d6efd;

    text-decoration: none;

    font-size: 14px;

    font-weight: 700;

    white-space: nowrap;

    transition: .3s;
}

.dashboard-link:hover {
    color: #198754;

    transform:
        translateY(-3px);

    box-shadow:
        0 10px 25px
        rgba(0,0,0,.15);
}


/* =====================================================
   SUCCESS
===================================================== */

.success-message {
    display: flex;

    align-items: center;

    gap: 12px;

    margin-bottom: 20px;

    padding: 16px 20px;

    border-radius: 16px;

    border:
        1px solid #b7e4c7;

    background:
        linear-gradient(
            135deg,
            #f0fff6,
            #e9f8f1
        );

    color: #198754;

    font-size: 14px;

    font-weight: 700;

    box-shadow:
        0 7px 20px
        rgba(25,135,84,.06);

    animation:
        slideUp .5s ease;
}

.success-icon {
    width: 35px;
    height: 35px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 10px;

    background: #198754;

    color: white;

    font-size: 17px;
}


/* =====================================================
   CONVERSATION LIST
===================================================== */

.conversations-list {
    display: flex;

    flex-direction: column;

    gap: 16px;
}


/* =====================================================
   CONVERSATION CARD
===================================================== */

.conversation-card {
    position: relative;

    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;

    overflow: hidden;

    padding: 21px 23px;

    border-radius: 21px;

    background:
        rgba(255,255,255,.96);

    border:
        1px solid rgba(0,0,0,.04);

    box-shadow:
        0 9px 28px
        rgba(0,0,0,.06);

    text-decoration: none;

    transition:
        transform .3s,
        box-shadow .3s,
        border-color .3s;

    animation:
        slideUp .6s ease both;
}

.conversation-card::before {
    content: "";

    position: absolute;

    left: 0;
    top: 0;
    bottom: 0;

    width: 4px;

    background:
        linear-gradient(
            180deg,
            #0d6efd,
            #198754
        );

    opacity: 0;

    transition: .3s;
}

.conversation-card:hover {
    transform:
        translateY(-5px);

    border-color:
        rgba(13,110,253,.15);

    box-shadow:
        0 18px 40px
        rgba(13,110,253,.10);
}

.conversation-card:hover::before {
    opacity: 1;
}


/* =====================================================
   CONVERSATION CONTENT
===================================================== */

.conversation-content {
    display: flex;

    align-items: flex-start;

    gap: 17px;

    flex: 1;
    min-width: 0;
}

.conversation-actions {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-shrink: 0;
}

.conversation-open-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 9px 12px;
    border-radius: 10px;
    background: #eef5ff;
    color: #0d6efd;
    font-size: 12px;
    font-weight: 700;
    text-decoration: none;
    transition: .3s;
}

.conversation-open-link:hover {
    background: #e1edff;
    transform: translateY(-1px);
}

.delete-message-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 9px 12px;
    border: 1px solid rgba(220, 53, 69, 0.25);
    border-radius: 10px;
    background: #fff5f5;
    color: #dc3545;
    font-size: 12px;
    font-weight: 700;
    cursor: pointer;
    transition: .3s;
}

.delete-message-button:hover {
    background: #ffe8e8;
    transform: translateY(-1px);
}

.conversation-icon {
    width: 54px;
    height: 54px;

    flex-shrink: 0;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 16px;

    background:
        linear-gradient(
            135deg,
            #0d6efd,
            #198754
        );

    color: white;

    font-size: 23px;

    box-shadow:
        0 8px 20px
        rgba(13,110,253,.15);

    transition: .3s;
}

.conversation-card:hover
.conversation-icon {
    transform:
        rotate(-5deg)
        scale(1.05);
}

.conversation-body {
    min-width: 0;

    flex: 1;
}

.conversation-top {
    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 15px;
}

.interlocuteur {
    margin: 0;

    color: #212529;

    font-size: 17px;

    font-weight: 800;

    overflow: hidden;

    text-overflow: ellipsis;

    white-space: nowrap;
}

.conversation-date {
    flex-shrink: 0;

    color: #9ca3af;

    font-size: 12px;

    font-weight: 600;
}

.logement-info {
    display: flex;

    align-items: center;

    gap: 6px;

    margin-top: 6px;

    color: #198754;

    font-size: 13px;

    font-weight: 700;

    overflow: hidden;

    text-overflow: ellipsis;

    white-space: nowrap;
}

.message-preview {
    margin: 11px 0 0;

    color: #6c757d;

    font-size: 14px;

    line-height: 1.55;

    display: -webkit-box;

    -webkit-line-clamp: 2;

    -webkit-box-orient: vertical;

    overflow: hidden;
}


/* =====================================================
   NOUVEAU
===================================================== */

.new-badge {
    flex-shrink: 0;

    display: inline-flex;

    align-items: center;

    gap: 6px;

    padding: 7px 11px;

    border-radius: 20px;

    background:
        #e8f1ff;

    color: #0d6efd;

    font-size: 11px;

    font-weight: 800;

    box-shadow:
        0 4px 12px
        rgba(13,110,253,.08);
}

.new-badge::before {
    content: "";

    width: 7px;
    height: 7px;

    border-radius: 50%;

    background: #0d6efd;

    animation:
        pulse 1.6s infinite;
}


/* =====================================================
   EMPTY STATE
===================================================== */

.empty-card {
    padding: 65px 25px;

    text-align: center;

    border-radius: 24px;

    background:
        rgba(255,255,255,.96);

    box-shadow:
        0 12px 35px
        rgba(0,0,0,.06);

    border:
        1px solid rgba(0,0,0,.04);

    animation:
        slideUp .7s ease;
}

.empty-icon {
    width: 85px;
    height: 85px;

    margin: auto;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 27px;

    background:
        linear-gradient(
            135deg,
            #edf5ff,
            #ecfff5
        );

    font-size: 38px;

    box-shadow:
        0 10px 25px
        rgba(13,110,253,.08);
}

.empty-title {
    margin-top: 20px;

    color: #212529;

    font-size: 22px;

    font-weight: 800;
}

.empty-text {
    max-width: 480px;

    margin: 9px auto 0;

    color: #6c757d;

    font-size: 14px;

    line-height: 1.6;
}

.search-button {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    gap: 8px;

    margin-top: 23px;

    padding: 12px 20px;

    border-radius: 12px;

    color: white;

    background:
        linear-gradient(
            135deg,
            #0d6efd,
            #198754
        );

    text-decoration: none;

    font-size: 14px;

    font-weight: 700;

    transition: .3s;
}

.search-button:hover {
    color: white;

    transform:
        translateY(-3px);

    box-shadow:
        0 10px 25px
        rgba(13,110,253,.20);
}


/* =====================================================
   RESPONSIVE
===================================================== */

@media(max-width: 768px) {

    .messages-page {
        padding:
            20px 14px;
    }

    .messages-header {
        padding:
            23px 20px;
    }

    .messages-header-content {
        flex-direction: column;

        align-items: stretch;
    }

    .dashboard-link {
        width: 100%;
    }

    .header-title {
        font-size: 23px;
    }

    .conversation-card {
        padding:
            18px;
    }

    .conversation-content {
        gap: 13px;
    }

    .conversation-icon {
        width: 48px;
        height: 48px;

        font-size: 20px;
    }

    .conversation-top {
        align-items: flex-start;

        flex-direction: column;

        gap: 4px;
    }

    .conversation-date {
        font-size: 11px;
    }

    .new-badge {
        position: absolute;

        right: 15px;
        top: 15px;
    }

    .empty-card {
        padding:
            50px 20px;
    }
}


@media(max-width: 500px) {

    .header-left {
        align-items: flex-start;
    }

    .header-icon {
        width: 48px;
        height: 48px;

        font-size: 22px;
    }

    .header-title {
        font-size: 20px;
    }

    .header-subtitle {
        font-size: 13px;
    }

    .interlocuteur {
        max-width: 180px;
    }

    .logement-info {
        max-width: 220px;
    }

    .message-preview {
        font-size: 13px;
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
            translateY(25px);
    }

    to {
        opacity: 1;

        transform:
            translateY(0);
    }
}


@keyframes floating {

    0%,
    100% {
        transform:
            translateY(0);
    }

    50% {
        transform:
            translateY(22px);
    }
}


@keyframes pulse {

    0% {
        box-shadow:
            0 0 0 0
            rgba(13,110,253,.35);
    }

    70% {
        box-shadow:
            0 0 0 7px
            rgba(13,110,253,0);
    }

    100% {
        box-shadow:
            0 0 0 0
            rgba(13,110,253,0);
    }
}


@media(prefers-reduced-motion: reduce) {

    *,
    *::before,
    *::after {
        animation-duration:
            .01ms !important;

        animation-iteration-count:
            1 !important;

        transition-duration:
            .01ms !important;
    }
}

</style>


<div class="messages-page">

    <div class="messages-container">


        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <div class="messages-header">

            <div class="messages-header-content">

                <div class="header-left">

                    <div class="header-icon">
                        💬
                    </div>

                    <div>

                        <h2 class="header-title">
                            Mes conversations
                        </h2>

                        <p class="header-subtitle">
                            Échangez avec les bailleurs au sujet
                            des logements qui vous intéressent.
                        </p>

                    </div>

                </div>


                <a
                    href="{{ route('locataire.dashboard') }}"
                    class="dashboard-link"
                >
                    ← Tableau de bord
                </a>

            </div>

        </div>


        {{-- =====================================================
             MESSAGE SUCCESS
        ====================================================== --}}

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
             CONVERSATIONS
        ====================================================== --}}

        <div class="conversations-list">

            @forelse($conversations as $conversation)

                @php

                    $interlocuteur =
                        $conversation->expediteur_id === auth()->id()
                            ? $conversation->destinataire
                            : $conversation->expediteur;

                    $messageNonLu =
                        $conversation->destinataire_id === auth()->id()
                        && ! $conversation->lu;

                @endphp


                <div class="conversation-card">

                    <a
                        href="{{ route(
                            'locataire.messages.show',
                            $conversation
                        ) }}"
                        class="conversation-content"
                        style="text-decoration: none; color: inherit;"
                    >

                        {{-- ICON --}}

                        <div class="conversation-icon">
                            💬
                        </div>


                        {{-- CONTENU --}}

                        <div class="conversation-body">

                            <div class="conversation-top">

                                <h3 class="interlocuteur">

                                    {{ $interlocuteur->name ?? 'Bailleur' }}

                                </h3>


                                <span class="conversation-date">

                                    {{ $conversation->created_at->format(
                                        'd/m/Y à H:i'
                                    ) }}

                                </span>

                            </div>


                            <div class="logement-info">

                                🏠

                                <span>

                                    {{ $conversation->logement?->titre
                                        ?? 'Logement indisponible' }}

                                </span>

                            </div>


                            <p class="message-preview">

                                {{ \Illuminate\Support\Str::limit(
                                    $conversation->contenu,
                                    160
                                ) }}

                            </p>

                        </div>


                        {{-- NOUVEAU --}}

                        @if($messageNonLu)

                            <span class="new-badge">
                                Nouveau
                            </span>

                        @endif


                    </a>

                    <div class="conversation-actions">
                        <a href="{{ route('locataire.messages.show', $conversation) }}" class="conversation-open-link">
                            Ouvrir
                        </a>
                    </div>

                </div>

            @empty


                {{-- =================================================
                     AUCUNE CONVERSATION
                ================================================== --}}

                <div class="empty-card">

                    <div class="empty-icon">
                        💬
                    </div>


                    <h3 class="empty-title">
                        Aucune conversation
                    </h3>


                    <p class="empty-text">

                        Consultez les logements et contactez
                        un bailleur lorsque vous êtes intéressé.

                    </p>


                    <a
                        href="{{ route(
                            'locataire.logements.index'
                        ) }}"
                        class="search-button"
                    >

                        🔎

                        Rechercher un logement

                    </a>

                </div>


            @endforelse

        </div>


    </div>

</div>

</x-app-layout>