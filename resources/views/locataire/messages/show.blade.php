<x-app-layout>
    <x-app-sidebar />

    <style>
        /* =====================================================
           PAGE
        ===================================================== */

        .conversation-page {
            min-height: calc(100vh - 65px);
            padding: 35px 20px;

            background:
                radial-gradient(
                    circle at 10% 20%,
                    rgba(13, 110, 253, .08),
                    transparent 30%
                ),
                radial-gradient(
                    circle at 90% 80%,
                    rgba(25, 135, 84, .08),
                    transparent 30%
                ),
                linear-gradient(
                    135deg,
                    #f0f8ff,
                    #f0fff6
                );
        }

        .conversation-container {
            max-width: 1000px;
            margin: auto;
        }


        /* =====================================================
           HEADER
        ===================================================== */

        .conversation-header {
            position: relative;
            overflow: hidden;

            padding: 28px 30px;
            margin-bottom: 25px;

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
                rgba(13, 110, 253, .20);

            animation:
                slideDown .7s ease;
        }

        .conversation-header::before {
            content: "";

            position: absolute;

            width: 240px;
            height: 240px;

            border-radius: 50%;

            background:
                rgba(255,255,255,.08);

            right: -70px;
            top: -130px;
        }

        .conversation-header::after {
            content: "";

            position: absolute;

            width: 150px;
            height: 150px;

            border-radius: 50%;

            background:
                rgba(255,255,255,.06);

            left: 45%;
            bottom: -110px;
        }

        .conversation-header-content {
            position: relative;
            z-index: 2;

            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 20px;
        }

        .conversation-title-area {
            min-width: 0;
        }

        .conversation-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            padding: 7px 12px;

            border-radius: 50px;

            background:
                rgba(255,255,255,.14);

            border:
                1px solid
                rgba(255,255,255,.25);

            font-size: 12px;
            font-weight: 800;

            margin-bottom: 10px;
        }

        .conversation-header h2 {
            margin: 0;

            font-size: 25px;
            font-weight: 800;

            color: white;
        }

        .conversation-header p {
            margin: 8px 0 0;

            color:
                rgba(255,255,255,.88);

            font-size: 14px;
        }

        .back-button {
            flex-shrink: 0;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            gap: 7px;

            padding: 12px 18px;

            border-radius: 13px;

            background: white;

            color: #0d6efd;

            text-decoration: none;

            font-size: 13px;
            font-weight: 700;

            transition: .3s;

            position: relative;
            z-index: 5;
        }

        .back-button:hover {
            transform: translateY(-3px);

            color: #198754;

            box-shadow:
                0 10px 22px
                rgba(0,0,0,.15);
        }


        /* =====================================================
           MESSAGE DE SUCCÈS
        ===================================================== */

        .success-message {
            margin-bottom: 20px;

            padding: 16px 20px;

            border-radius: 17px;

            border:
                1px solid
                rgba(25,135,84,.18);

            background:
                rgba(25,135,84,.08);

            color: #157347;

            font-size: 14px;
            font-weight: 700;

            box-shadow:
                0 8px 22px
                rgba(25,135,84,.06);

            animation:
                slideUp .5s ease;
        }


        /* =====================================================
           CARTE PRINCIPALE
        ===================================================== */

        .conversation-card {
            overflow: hidden;

            background: white;

            border-radius: 25px;

            border:
                1px solid
                rgba(0,0,0,.04);

            box-shadow:
                0 12px 35px
                rgba(0,0,0,.07);

            animation:
                slideUp .8s ease;
        }


        /* =====================================================
           ZONE DES MESSAGES
        ===================================================== */

        .messages-area {
            max-height: 550px;

            overflow-y: auto;

            padding: 28px;

            background:
                linear-gradient(
                    135deg,
                    #f4f9ff,
                    #f5fff9
                );
        }

        .messages-area::-webkit-scrollbar {
            width: 7px;
        }

        .messages-area::-webkit-scrollbar-track {
            background: transparent;
        }

        .messages-area::-webkit-scrollbar-thumb {
            background:
                rgba(13,110,253,.20);

            border-radius: 20px;
        }

        .message-row {
            display: flex;

            margin-bottom: 18px;

            animation:
                messageAnimation .5s ease;
        }

        .message-row:last-child {
            margin-bottom: 0;
        }

        .message-row.mine {
            justify-content: flex-end;
        }

        .message-row.other {
            justify-content: flex-start;
        }


        /* =====================================================
           BULLES DE MESSAGE
        ===================================================== */

        .message-bubble {
            max-width: 75%;

            padding: 15px 17px;

            border-radius: 20px;

            box-shadow:
                0 6px 18px
                rgba(0,0,0,.06);
        }

        /* Messages du locataire */

        .message-row.mine .message-bubble {
            color: white;

            background:
                linear-gradient(
                    135deg,
                    #0d6efd,
                    #198754
                );

            border-bottom-right-radius: 6px;

            box-shadow:
                0 8px 20px
                rgba(13,110,253,.18);
        }

        /* Messages du bailleur */

        .message-row.other .message-bubble {
            color: #212529;

            background: white;

            border:
                1px solid
                rgba(0,0,0,.05);

            border-bottom-left-radius: 6px;
        }

        .message-author {
            margin-bottom: 5px;

            font-size: 11px;
            font-weight: 800;
        }

        .message-row.mine .message-author {
            color:
                rgba(255,255,255,.82);
        }

        .message-row.other .message-author {
            color: #6c757d;
        }

        .message-content {
            white-space: pre-line;
            overflow-wrap: anywhere;

            font-size: 14px;

            line-height: 1.65;
        }

        .message-meta {
            margin-top: 9px;

            font-size: 10px;
        }

        .message-row.mine .message-meta {
            color:
                rgba(255,255,255,.72);
        }

        .message-row.other .message-meta {
            color: #9ca3af;
        }


        /* =====================================================
           ACTION SUPPRIMER POUR MOI
        ===================================================== */

        .message-actions {
            display: flex;

            justify-content: flex-end;

            margin-top: 8px;
        }

        .delete-message-form {
            margin: 0;
        }

        .delete-message-button {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            gap: 5px;

            padding: 5px 8px;

            border: 0;

            border-radius: 8px;

            background: transparent;

            font-size: 10px;
            font-weight: 700;

            cursor: pointer;

            opacity: .65;

            transition:
                background .25s,
                color .25s,
                opacity .25s,
                transform .25s;
        }

        /* Bouton dans mon message */

        .message-row.mine .delete-message-button {
            color:
                rgba(255,255,255,.85);
        }

        /* Bouton dans le message du bailleur */

        .message-row.other .delete-message-button {
            color: #6c757d;
        }

        .delete-message-button:hover {
            opacity: 1;

            background:
                rgba(220,53,69,.10);

            color: #dc3545;

            transform:
                translateY(-1px);
        }


        /* =====================================================
           FORMULAIRE DE RÉPONSE
        ===================================================== */

        .reply-area {
            padding: 25px 28px;

            border-top:
                1px solid
                rgba(0,0,0,.05);

            background: white;
        }

        .reply-label {
            display: block;

            margin-bottom: 9px;

            color: #212529;

            font-size: 14px;
            font-weight: 800;
        }

        .reply-textarea {
            width: 100%;

            min-height: 120px;

            resize: vertical;

            padding: 14px 16px;

            border-radius: 15px;

            border:
                1px solid
                #dbe3ec;

            background: #fbfdff;

            color: #212529;

            font-size: 14px;

            line-height: 1.6;

            outline: none;

            transition:
                border-color .25s,
                box-shadow .25s,
                background .25s;
        }

        .reply-textarea:focus {
            border-color: #0d6efd;

            background: white;

            box-shadow:
                0 0 0 4px
                rgba(13,110,253,.10);
        }

        .reply-textarea::placeholder {
            color: #9ca3af;
        }

        .error-message {
            margin-top: 8px;

            color: #dc3545;

            font-size: 13px;
            font-weight: 600;
        }

        .reply-footer {
            display: flex;

            align-items: center;
            justify-content: space-between;

            gap: 15px;

            margin-top: 16px;
        }

        .property-link {
            display: inline-flex;
            align-items: center;

            gap: 5px;

            color: #6c757d;

            text-decoration: none;

            font-size: 13px;
            font-weight: 700;

            transition: .25s;
        }

        .property-link:hover {
            color: #0d6efd;

            transform:
                translateX(2px);
        }

        .send-button {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            gap: 8px;

            padding: 12px 20px;

            border: 0;

            border-radius: 13px;

            color: white;

            background:
                linear-gradient(
                    135deg,
                    #0d6efd,
                    #198754
                );

            font-size: 13px;
            font-weight: 800;

            cursor: pointer;

            box-shadow:
                0 8px 20px
                rgba(13,110,253,.18);

            transition:
                transform .3s,
                box-shadow .3s;
        }

        .send-button:hover {
            transform:
                translateY(-3px);

            box-shadow:
                0 12px 26px
                rgba(13,110,253,.25);
        }

        .send-button:active {
            transform:
                translateY(-1px);
        }


        /* =====================================================
           ANIMATIONS
        ===================================================== */

        @keyframes slideDown {

            from {
                opacity: 0;

                transform:
                    translateY(-30px);
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

        @keyframes messageAnimation {

            from {
                opacity: 0;

                transform:
                    translateY(12px);
            }

            to {
                opacity: 1;

                transform:
                    translateY(0);
            }
        }


        /* =====================================================
           TABLETTE / MOBILE
        ===================================================== */

        @media(max-width: 768px) {

            .conversation-page {
                padding:
                    22px 14px;
            }

            .conversation-header {
                padding:
                    24px 20px;
            }

            .conversation-header-content {
                flex-direction: column;

                align-items: flex-start;
            }

            .conversation-header h2 {
                font-size: 22px;
            }

            .back-button {
                width: 100%;
            }

            .messages-area {
                padding: 20px;
            }

            .message-bubble {
                max-width: 88%;
            }

            .reply-area {
                padding:
                    20px;
            }

            .reply-footer {
                flex-direction: column;

                align-items: stretch;
            }

            .property-link {
                justify-content: center;
            }

            .send-button {
                width: 100%;
            }
        }


        /* =====================================================
           PETIT MOBILE
        ===================================================== */

        @media(max-width: 500px) {

            .conversation-header h2 {
                font-size: 20px;
            }

            .conversation-header p {
                font-size: 13px;
            }

            .messages-area {
                max-height: 500px;

                padding: 16px;
            }

            .message-bubble {
                max-width: 92%;

                padding:
                    13px 14px;
            }

            .message-content {
                font-size: 13px;
            }

            .reply-area {
                padding:
                    18px 16px;
            }

            .delete-message-button {
                font-size: 9px;

                padding: 4px 7px;
            }
        }


        /* =====================================================
           ACCESSIBILITÉ
        ===================================================== */

        @media(prefers-reduced-motion: reduce) {

            * {
                animation-duration:
                    .01ms !important;

                animation-iteration-count:
                    1 !important;

                transition-duration:
                    .01ms !important;
            }
        }
    </style>


    <!-- =====================================================
         PAGE
    ===================================================== -->

    <div class="conversation-page">

        <div class="conversation-container">


            <!-- =================================================
                 HEADER
            ================================================== -->

            <div class="conversation-header">

                <div class="conversation-header-content">

                    <div class="conversation-title-area">

                        <span class="conversation-badge">
                            💬 Conversation
                        </span>

                        <h2>
                            Conversation avec
                            {{ $interlocuteur->name ?? 'le bailleur' }}
                        </h2>

                        @if($message->logement)

                            <p>
                                🏠 {{ $message->logement->titre }}
                            </p>

                        @endif

                    </div>


                    <a
                        href="{{ route('locataire.messages.index') }}"
                        class="back-button"
                    >
                        ← Mes conversations
                    </a>

                </div>

            </div>


            <!-- =================================================
                 MESSAGE DE SUCCÈS
            ================================================== -->

            @if(session('success'))

                <div class="success-message">
                    ✓ {{ session('success') }}
                </div>

            @endif


            <!-- =================================================
                 CONVERSATION
            ================================================== -->

            <div class="conversation-card">


                <!-- =================================================
                     MESSAGES
                ================================================== -->

                <div class="messages-area">

                    @forelse($messages as $conversationMessage)

                        @php

                            $estMoi =
                                $conversationMessage->expediteur_id
                                === auth()->id();

                        @endphp


                        <div
                            class="
                                message-row
                                {{ $estMoi ? 'mine' : 'other' }}
                            "
                        >

                            <div class="message-bubble">


                                <!-- =============================
                                     AUTEUR
                                ============================== -->

                                <p class="message-author">

                                    {{ $estMoi
                                        ? 'Vous'
                                        : ($conversationMessage->expediteur->name
                                            ?? 'Bailleur')
                                    }}

                                </p>


                                <!-- =============================
                                     CONTENU
                                ============================== -->

                                <p class="message-content">

                                    {{ $conversationMessage->contenu }}

                                </p>


                                <!-- =============================
                                     DATE / STATUT
                                ============================== -->

                                <p class="message-meta">

                                    {{ $conversationMessage->created_at->format('d/m/Y à H:i') }}

                                    @if($estMoi)

                                        ·

                                        {{ $conversationMessage->lu
                                            ? 'Lu'
                                            : 'Envoyé'
                                        }}

                                    @endif

                                </p>


                                <!-- =============================
                                     SUPPRIMER POUR MOI
                                ============================== -->

                                <div class="message-actions">

                                    <form
                                        method="POST"
                                        action="{{ route(
                                            'locataire.messages.supprimer',
                                            $conversationMessage
                                        ) }}"
                                        class="delete-message-form"
                                        onsubmit="return confirm(
                                            'Supprimer ce message uniquement pour vous ?'
                                        )"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="delete-message-button"
                                            title="Supprimer pour moi"
                                        >

                                            🗑️

                                            <span>
                                                Supprimer pour moi
                                            </span>

                                        </button>

                                    </form>

                                </div>


                            </div>

                        </div>

                    @empty

                        <div
                            style="
                                text-align:center;
                                padding:50px 20px;
                                color:#6c757d;
                                font-size:14px;
                                font-weight:600;
                            "
                        >

                            💬 Aucun message dans cette conversation.

                        </div>

                    @endforelse

                </div>


                <!-- =================================================
                     FORMULAIRE DE RÉPONSE
                ================================================== -->

                <form
                    method="POST"
                    action="{{ route(
                        'locataire.messages.reply',
                        $message
                    ) }}"
                    class="reply-area"
                    id="repondre"
                >

                    @csrf


                    <label
                        for="contenu"
                        class="reply-label"
                    >
                        Votre réponse
                    </label>


                    <textarea
                        id="contenu"
                        name="contenu"
                        rows="4"
                        maxlength="2000"
                        required
                        class="reply-textarea"
                        placeholder="Écrivez votre message…"
                    >{{ old('contenu') }}</textarea>


                    @error('contenu')

                        <p class="error-message">
                            {{ $message }}
                        </p>

                    @enderror


                    <div class="reply-footer">

                        @if($message->logement)

                            <a
                                href="{{ route(
                                    'locataire.logements.show',
                                    $message->logement
                                ) }}"
                                class="property-link"
                            >
                                🏠 Voir le logement
                            </a>

                        @else

                            <span></span>

                        @endif


                        <button
                            type="submit"
                            class="send-button"
                        >

                            <i class="bi bi-send-fill"></i>

                            Envoyer la réponse

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>