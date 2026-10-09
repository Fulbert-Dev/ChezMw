<x-app-layout>

    <x-app-sidebar />

    <div class="payment-page">

        <div class="payment-card">

            {{-- Icône --}}
            <div class="payment-icon">
                💳
            </div>

            {{-- En-tête --}}
            <div class="payment-header">

                <span class="payment-label">
                    PAIEMENT
                </span>

                <h1>
                    Publier une annonce supplémentaire
                </h1>

                <p class="subtitle">
                    Votre première annonce gratuite a déjà été utilisée.
                </p>

            </div>


            {{-- Prix --}}
            <div class="price-box">

                <div class="price-label">
                    Montant à payer
                </div>

                <strong>
                    {{ number_format($paiement->montant, 0, ',', ' ') }}
                    <small>FCFA</small>
                </strong>

            </div>


            {{-- Informations paiement --}}
            <div class="payment-info">

                <div class="info-row">

                    <div class="info-label">
                        <span>Type</span>
                    </div>

                    <strong>
                        Annonce supplémentaire
                    </strong>

                </div>


                <div class="info-row">

                    <div class="info-label">
                        <span>Référence</span>
                    </div>

                    <strong class="reference">
                        {{ $paiement->reference }}
                    </strong>

                </div>


                <div class="info-row">

                    <div class="info-label">
                        <span>Statut</span>
                    </div>

                    <strong class="status">
                        <span class="status-dot"></span>
                        {{ ucfirst(str_replace('_', ' ', $paiement->statut)) }}
                    </strong>

                </div>

            </div>


            {{-- Moyens de paiement --}}
            <div class="payment-methods">

                @if(session('error'))
                    <p class="error-message" role="alert">{{ session('error') }}</p>
                @endif

                <div class="methods-header">

                    <h3>
                        Choisissez votre moyen de paiement
                    </h3>

                    <p>
                        Sélectionnez votre opérateur mobile money.
                    </p>

                </div>


                <form
                    method="POST"
                    action="{{ route('paygate.start', $paiement) }}"
                >

                    @csrf


                    {{-- Numéro --}}
                    <div class="phone-group">

                        <label for="phone">
                            Numéro de téléphone
                        </label>

                        <div class="phone-input-wrapper">

                            <span class="phone-icon">
                                📱
                            </span>

                            <input
                                id="phone"
                                type="tel"
                                name="phone"
                                value="{{ old('phone') }}"
                                placeholder="Ex : 90 XX XX XX"
                                required
                            >

                        </div>

                        @error('phone')

                            <small class="error-message">
                                {{ $message }}
                            </small>

                        @enderror

                    </div>


                    {{-- Moyen de paiement --}}
                    <div class="payment-buttons">
                        <input type="hidden" name="network" data-network-field value="{{ old('network') }}">
                        <button type="submit" class="confirm-payment">Payer</button>

                    </div>

                </form>

            </div>


            {{-- Retour --}}
            <a
                href="{{ route('bailleur.dashboard') }}"
                class="back-button"
            >
                <span>←</span>
                Retour au tableau de bord
            </a>

        <script>
            (() => {
                const form = document.querySelector('form[action*="paygate/start"]');
                const phone = form?.querySelector('input[name="phone"]');
                const network = form?.querySelector('[data-network-field]');
                const prefixes = { flooz: ['79', '96', '97', '98', '99'], tmoney: ['70', '71', '72', '73', '90', '91', '92', '93'] };
                const detectNetwork = () => {
                    const value = (phone?.value || '').replace(/\s/g, '').replace(/^\+228/, '');
                    network.value = Object.keys(prefixes).find((name) => prefixes[name].some((prefix) => value.startsWith(prefix))) || '';
                };
                phone?.addEventListener('input', detectNetwork);
                detectNetwork();
            })();
        </script>

        </div>

    </div>


    <style>

        /* =====================================================
           PAGE
        ===================================================== */

        .payment-page {

            min-height: calc(100vh - 65px);

            display: flex;

            align-items: center;

            justify-content: center;

            padding: 55px 20px;

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


        /* =====================================================
           CARTE
        ===================================================== */

        .payment-card {

            width: 100%;

            max-width: 570px;

            background: #ffffff;

            border: 1px solid #e2e8f0;

            border-radius: 24px;

            padding: 38px;

            box-shadow:
                0 20px 60px rgba(15, 23, 42, .08);

            text-align: center;

        }


        /* =====================================================
           ICÔNE
        ===================================================== */

        .payment-icon {

            width: 72px;

            height: 72px;

            margin: 0 auto 20px;

            border-radius: 20px;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 32px;

            background: #eff6ff;

            border: 1px solid #dbeafe;

        }


        /* =====================================================
           HEADER
        ===================================================== */

        .payment-header {

            margin-bottom: 28px;

        }


        .payment-label {

            display: inline-flex;

            align-items: center;

            padding: 6px 12px;

            margin-bottom: 12px;

            border-radius: 999px;

            background: #eff6ff;

            color: #2563eb;

            font-size: 11px;

            font-weight: 800;

            letter-spacing: .08em;

        }


        .payment-card h1 {

            margin: 0;

            color: #172033;

            font-size: 28px;

            line-height: 1.25;

            font-weight: 800;

            letter-spacing: -.4px;

        }


        .subtitle {

            margin: 10px 0 0;

            color: #64748b;

            font-size: 15px;

            line-height: 1.6;

        }


        /* =====================================================
           PRIX
        ===================================================== */

        .price-box {

            padding: 24px;

            margin-bottom: 25px;

            border-radius: 18px;

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #16a34a
                );

            color: white;

            box-shadow:
                0 12px 25px rgba(37, 99, 235, .16);

        }


        .price-label {

            font-size: 13px;

            font-weight: 600;

            opacity: .9;

        }


        .price-box strong {

            display: block;

            margin-top: 5px;

            font-size: 34px;

            line-height: 1.2;

            font-weight: 800;

            letter-spacing: -.5px;

        }


        .price-box strong small {

            font-size: 16px;

            font-weight: 700;

        }


        /* =====================================================
           INFORMATIONS
        ===================================================== */

        .payment-info {

            padding: 8px 0;

            margin-bottom: 28px;

            border-top: 1px solid #e2e8f0;

            border-bottom: 1px solid #e2e8f0;

            text-align: left;

        }


        .info-row {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 20px;

            padding: 13px 0;

        }


        .info-row span {

            color: #64748b;

            font-size: 14px;

        }


        .info-row strong {

            color: #172033;

            font-size: 14px;

            font-weight: 700;

            text-align: right;

        }


        .reference {

            max-width: 250px;

            overflow: hidden;

            text-overflow: ellipsis;

            white-space: nowrap;

        }


        /* =====================================================
           STATUT
        ===================================================== */

        .status {

            display: inline-flex;

            align-items: center;

            gap: 7px;

            color: #d97706 !important;

        }


        .status-dot {

            width: 8px;

            height: 8px;

            border-radius: 50%;

            background: #f59e0b;

            box-shadow:
                0 0 0 4px rgba(245, 158, 11, .12);

        }


        /* =====================================================
           MÉTHODES
        ===================================================== */

        .payment-methods {

            text-align: left;

        }


        .methods-header {

            margin-bottom: 18px;

        }


        .payment-methods h3 {

            margin: 0;

            color: #172033;

            font-size: 18px;

            font-weight: 800;

        }


        .methods-header p {

            margin: 5px 0 0;

            color: #64748b;

            font-size: 13px;

        }


        /* =====================================================
           TÉLÉPHONE
        ===================================================== */

        .phone-group {

            margin-bottom: 18px;

        }


        .phone-group label {

            display: block;

            margin-bottom: 8px;

            color: #334155;

            font-size: 13px;

            font-weight: 700;

        }


        .phone-input-wrapper {

            position: relative;

            display: flex;

            align-items: center;

        }


        .phone-icon {

            position: absolute;

            left: 15px;

            font-size: 18px;

            pointer-events: none;

        }


        .phone-input-wrapper input {

            width: 100%;

            height: 52px;

            padding: 0 15px 0 46px;

            border: 1px solid #cbd5e1;

            border-radius: 13px;

            background: #ffffff;

            color: #172033;

            font-size: 15px;

            outline: none;

            transition: .2s;

            box-sizing: border-box;

        }


        .phone-input-wrapper input::placeholder {

            color: #94a3b8;

        }


        .phone-input-wrapper input:focus {

            border-color: #2563eb;

            box-shadow:
                0 0 0 4px rgba(37, 99, 235, .10);

        }


        .error-message {

            display: block;

            margin-top: 6px;

            color: #dc2626;

            font-size: 12px;

        }


        /* =====================================================
           BOUTONS
        ===================================================== */

        .payment-buttons {

            display: flex;

            flex-direction: column;

            gap: 11px;

        }


        .confirm-payment {

            width: 100%;

            min-height: 64px;

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 13px;

            padding: 10px 14px;

            border: 1px solid transparent;

            border-radius: 15px;

            background: linear-gradient(135deg, #2563eb, #16a34a);

            color: white;

            font-weight: 800;

            cursor: pointer;

            text-align: center;

            box-shadow: 0 12px 22px rgba(37, 99, 235, .18);

            transition:
                transform .2s ease,
                box-shadow .2s ease,
                filter .2s ease;

        }


        .confirm-payment:hover {

            transform: translateY(-2px);

            filter: brightness(1.03);

        }


        .confirm-payment:active {

            transform: translateY(0);

        }


        /* FLOOZ */

        .flooz-button {

            background:
                linear-gradient(
                    135deg,
                    #16a34a,
                    #15803d
                );

            box-shadow:
                0 8px 20px rgba(22, 163, 74, .16);

        }


        .flooz-button:hover {

            box-shadow:
                0 12px 25px rgba(22, 163, 74, .22);

        }


        /* MIXX */

        .mixx-button {

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #1d4ed8
                );

            box-shadow:
                0 8px 20px rgba(37, 99, 235, .16);

        }


        .mixx-button:hover {

            box-shadow:
                0 12px 25px rgba(37, 99, 235, .22);

        }


        /* ICÔNE OPÉRATEUR */

        .operator-icon {

            width: 40px;

            height: 40px;

            flex: 0 0 40px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 11px;

            background: rgba(255,255,255,.18);

            border: 1px solid rgba(255,255,255,.20);

            font-size: 17px;

            font-weight: 900;

        }


        .operator-content {

            display: flex;

            flex-direction: column;

            flex: 1;

        }


        .operator-content strong {

            font-size: 15px;

            font-weight: 800;

        }


        .operator-content small {

            margin-top: 2px;

            font-size: 11px;

            opacity: .8;

        }


        .payment-arrow {

            font-size: 22px;

            font-weight: 400;

            opacity: .85;

        }


        /* =====================================================
           RETOUR
        ===================================================== */

        .back-button {

            display: inline-flex;

            align-items: center;

            gap: 7px;

            margin-top: 24px;

            color: #2563eb;

            text-decoration: none;

            font-size: 14px;

            font-weight: 700;

            transition: .2s;

        }


        .back-button:hover {

            color: #1d4ed8;

        }


        .back-button span {

            font-size: 18px;

            transition: .2s;

        }


        .back-button:hover span {

            transform: translateX(-3px);

        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 600px) {

            .payment-page {

                padding: 30px 15px;

            }


            .payment-card {

                padding: 28px 20px;

                border-radius: 20px;

            }


            .payment-card h1 {

                font-size: 23px;

            }


            .subtitle {

                font-size: 14px;

            }


            .price-box {

                padding: 20px;

            }


            .price-box strong {

                font-size: 30px;

            }


            .info-row {

                align-items: flex-start;

                flex-direction: column;

                gap: 4px;

            }


            .info-row strong {

                text-align: left;

            }


            .reference {

                max-width: 100%;

            }

        }

    </style>

</x-app-layout>
