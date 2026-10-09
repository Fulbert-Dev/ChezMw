<x-app-layout>

    <x-app-sidebar />

    <style>

        /* =========================================================
           PAGE
        ========================================================= */

        .paiement-page {

            min-height: calc(100vh - 65px);

            padding: 55px 20px;

            display: flex;

            align-items: center;

            background:
                radial-gradient(
                    circle at 10% 10%,
                    rgba(37, 99, 235, .06),
                    transparent 30%
                ),
                radial-gradient(
                    circle at 90% 90%,
                    rgba(22, 163, 74, .06),
                    transparent 30%
                ),
                #f8fafc;

        }


        .paiement-container {

            width: 100%;

            max-width: 650px;

            margin: auto;

        }


        /* =========================================================
           CARTE
        ========================================================= */

        .paiement-card {

            width: 100%;

            box-sizing: border-box;

            padding: 38px;

            background: #ffffff;

            border: 1px solid #e2e8f0;

            border-radius: 24px;

            box-shadow:
                0 20px 60px rgba(15, 23, 42, .08);

        }


        /* =========================================================
           HEADER
        ========================================================= */

        .paiement-header {

            text-align: center;

            margin-bottom: 30px;

        }


        .paiement-icon {

            width: 72px;

            height: 72px;

            margin: 0 auto 20px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 20px;

            background: #eff6ff;

            border: 1px solid #dbeafe;

            font-size: 32px;

        }


        .paiement-header h1 {

            margin: 0;

            color: #172033;

            font-size: 28px;

            line-height: 1.25;

            font-weight: 800;

            letter-spacing: -.4px;

        }


        .paiement-header p {

            margin: 10px 0 0;

            color: #64748b;

            font-size: 15px;

            line-height: 1.6;

        }


        /* =========================================================
           INFORMATIONS
        ========================================================= */

        .paiement-info {

            padding: 10px 0;

            margin-bottom: 24px;

            border-top: 1px solid #e2e8f0;

            border-bottom: 1px solid #e2e8f0;

        }


        .info-row {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 25px;

            padding: 14px 0;

        }


        .info-label {

            color: #64748b;

            font-size: 14px;

            font-weight: 600;

        }


        .info-value {

            color: #172033;

            font-size: 14px;

            font-weight: 700;

            text-align: right;

        }


        /* =========================================================
           MONTANT
        ========================================================= */

        .info-value.montant {

            color: #16a34a;

            font-size: 18px;

            font-weight: 800;

        }


        /* =========================================================
           RÉFÉRENCE
        ========================================================= */

        .reference {

            display: inline-block;

            max-width: 270px;

            overflow: hidden;

            text-overflow: ellipsis;

            white-space: nowrap;

            padding: 6px 10px;

            border-radius: 8px;

            background: #f1f5f9;

            color: #475569;

            font-family: monospace;

            font-size: 12px;

            font-weight: 600;

        }


        /* =========================================================
           STATUT
        ========================================================= */

        .statut {

            display: inline-flex;

            align-items: center;

            gap: 7px;

            padding: 6px 11px;

            border-radius: 999px;

            background: #fff7ed;

            color: #d97706;

            font-size: 12px;

            font-weight: 800;

        }


        .statut::before {

            content: "";

            width: 7px;

            height: 7px;

            border-radius: 50%;

            background: #f59e0b;

            box-shadow:
                0 0 0 4px rgba(245, 158, 11, .12);

        }


        /* =========================================================
           ALERTE
        ========================================================= */

        .paiement-alert {

            display: flex;

            align-items: center;

            gap: 10px;

            padding: 15px 17px;

            margin-bottom: 25px;

            border: 1px solid #dbeafe;

            border-radius: 14px;

            background: #eff6ff;

            color: #2563eb;

            font-size: 13px;

            font-weight: 600;

            line-height: 1.5;

        }


        .paiement-alert::before {

            content: "🔒";

            font-size: 18px;

            flex-shrink: 0;

        }


        /* =========================================================
           ACTIONS
        ========================================================= */

        .paiement-actions {

            display: flex;

            align-items: stretch;

            gap: 12px;

            margin-top: 5px;

        }


        .btn-paiement {

            min-height: 54px;

            box-sizing: border-box;

            display: flex;

            align-items: center;

            justify-content: center;

            padding: 14px 18px;

            border: none;

            border-radius: 14px;

            font-size: 14px;

            font-weight: 800;

            text-decoration: none;

            cursor: pointer;

            transition:
                transform .2s ease,
                box-shadow .2s ease,
                filter .2s ease;

        }


        /* =========================================================
           BOUTON RETOUR
        ========================================================= */

        .btn-cancel {

            flex: 0 0 130px;

            background: #f1f5f9;

            color: #475569;

            border: 1px solid #e2e8f0;

        }


        .btn-cancel:hover {

            background: #e2e8f0;

            color: #334155;

            transform: translateY(-2px);

        }


        /* =========================================================
           FORMULAIRE PAIEMENT
        ========================================================= */

        .paiement-actions form {

            flex: 1;

            display: flex;

            flex-direction: column;

            gap: 10px;

        }


        .paiement-actions form input[type="tel"] {

            width: 100%;

            height: 52px;

            box-sizing: border-box;

            padding: 0 15px;

            border: 1px solid #cbd5e1;

            border-radius: 13px;

            background: #ffffff;

            color: #172033;

            font-size: 14px;

            outline: none;

            transition: .2s;

        }


        .paiement-actions form input[type="tel"]::placeholder {

            color: #94a3b8;

        }


        .paiement-actions form input[type="tel"]:focus {

            border-color: #2563eb;

            box-shadow:
                0 0 0 4px rgba(37, 99, 235, .10);

        }


        /* =========================================================
           PAIEMENT
        ========================================================= */

        .btn-confirm {

            width: 100%;

            min-width: 150px;

            min-height: 54px;

            display: flex !important;

            visibility: visible !important;

            opacity: 1 !important;

            color: white;

            position: relative;

            overflow: hidden;

        }


        .btn-confirm {

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #1d4ed8
                );

            box-shadow:
                0 8px 20px rgba(37, 99, 235, .15);

        }


        .btn-confirm:hover {

            transform: translateY(-2px);

            filter: brightness(1.04);

        }


        .btn-confirm:hover {

            box-shadow:
                0 12px 25px rgba(37, 99, 235, .22);

        }


        .network-select {

            width: 100%;
            margin-bottom: 12px;
            padding: 13px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            background: #fff;
            color: #172033;
            font: inherit;

        }


        /* =========================================================
           ERREUR
        ========================================================= */

        .paiement-actions form .error-message {

            display: block;

            margin-top: -5px;

            color: #dc2626;

            font-size: 12px;

        }


        .paiement-actions form > small:not(.error-message) {

            display: block;

            color: #dc2626;

            font-size: 12px;

        }


        /* =========================================================
           MOBILE
        ========================================================= */

        @media(max-width: 600px) {

            .paiement-page {

                padding: 30px 15px;

            }


            .paiement-card {

                padding: 28px 20px;

                border-radius: 20px;

            }


            .paiement-header h1 {

                font-size: 23px;

            }


            .paiement-header p {

                font-size: 14px;

            }


            .info-row {

                align-items: flex-start;

                flex-direction: column;

                gap: 5px;

            }


            .info-value {

                text-align: left;

            }


            .reference {

                max-width: 100%;

            }


            .paiement-alert {

                align-items: flex-start;

            }


            .paiement-actions {

                flex-direction: column;

            }


            .btn-cancel {

                flex: none;

                width: 100%;

            }


            .paiement-actions form {

                width: 100%;

            }

        }

    </style>


    <div class="paiement-page">

        <div class="paiement-container">

            <div class="paiement-card">


                {{-- =================================================
                     HEADER
                ================================================== --}}

                <div class="paiement-header">

                    <div class="paiement-icon">
                        💳
                    </div>

                    <h1>
                        Confirmation du paiement
                    </h1>

                    <p>
                        Vérifiez les informations avant de confirmer.
                    </p>

                </div>


                {{-- =================================================
                     INFORMATIONS
                ================================================== --}}

                <div class="paiement-info">


                    <div class="info-row">

                        <span class="info-label">
                            🏠 Logement
                        </span>

                        <span class="info-value">
                            {{ $paiement->logement?->titre ?? 'Logement supprimé' }}
                        </span>

                    </div>


                    <div class="info-row">

                        <span class="info-label">
                            📦 Type
                        </span>

                        <span class="info-value">

                            @if(
                                session('visibilite_niveau') == 2
                            )

                                🚀 Tête des résultats

                            @else

                                🔥 Mise en avant

                            @endif

                        </span>

                    </div>


                    <div class="info-row">

                        <span class="info-label">
                            💰 Montant
                        </span>

                        <span class="info-value montant">

                            {{ number_format(
                                $paiement->montant,
                                0,
                                ',',
                                ' '
                            ) }}

                            FCFA

                        </span>

                    </div>


                    <div class="info-row">

                        <span class="info-label">
                            📅 Durée
                        </span>

                        <span class="info-value">

                            {{ session('visibilite_duree', 7) }}
                            jours

                        </span>

                    </div>


                    <div class="info-row">

                        <span class="info-label">
                            🔖 Référence
                        </span>

                        <span class="info-value reference">

                            {{ $paiement->reference }}

                        </span>

                    </div>


                    <div class="info-row">

                        <span class="info-label">
                            📌 Statut
                        </span>

                        <span class="info-value">

                            <span class="statut">
                                En attente
                            </span>

                        </span>

                    </div>


                </div>


                {{-- =================================================
                     MESSAGE
                ================================================== --}}

                <div class="paiement-alert">

                    Choisissez votre moyen de paiement sécurisé.

                </div>


                {{-- =================================================
                     ACTIONS
                ================================================== --}}

                <div class="paiement-actions">

                    <a
                        href="{{ route(
                            'bailleur.visibilite.index',
                            $paiement->logement
                        ) }}"
                        class="btn-paiement btn-cancel"
                    >

                        ← Retour

                    </a>


                    <form
                        method="POST"
                        action="{{ route(
                            'paygate.start',
                            $paiement
                        ) }}"
                    >

                        @csrf


                        <input
                            type="tel"
                            name="phone"
                            value="{{ old('phone') }}"
                            placeholder="Numéro de téléphone"
                            required
                        >

                        <input type="hidden" name="network" data-network-field value="{{ old('network') }}">


                        @error('phone')

                            <small class="error-message">
                                {{ $message }}
                            </small>

                        @enderror


                        <button type="submit" class="btn-paiement btn-confirm">
                            Payer
                        </button>

                    </form>


                </div>

                <script>
                    (() => {
                        const form = document.querySelector('form[action*="paygate/start"]');
                        const phone = form?.querySelector('input[name="phone"]');
                        const network = form?.querySelector('[data-network-field]');
                        const prefixes = {
                            flooz: ['79', '96', '97', '98', '99'],
                            tmoney: ['70', '71', '72', '73', '90', '91', '92', '93']
                        };

                        const detectNetwork = () => {
                            const value = (phone?.value || '').replace(/\s/g, '').replace(/^\+228/, '');
                            network.value = Object.keys(prefixes).find((name) =>
                                prefixes[name].some((prefix) => value.startsWith(prefix))
                            ) || '';
                        };

                        if (form && phone && network) {
                            phone.addEventListener('input', detectNetwork);
                            detectNetwork();
                        }
                    })();
                </script>

            </div>

        </div>

    </div>

</x-app-layout>
