<x-app-layout>

    <x-app-sidebar />

    <div class="visibility-payment-page">

        <div class="visibility-payment-card">

            {{-- ICÔNE --}}
            <div class="visibility-icon">
                🔥
            </div>

            {{-- TITRE --}}
            <h1>
                Mettre votre logement en avant
            </h1>

            <p class="subtitle">
                Donnez plus de visibilité à votre logement
                et augmentez vos chances de trouver rapidement
                un locataire.
            </p>


            {{-- LOGEMENT --}}
            <div class="logement-box">

                <div class="logement-icon">
                    🏠
                </div>

                <div class="logement-content">

                    <span>
                        Logement concerné
                    </span>

                    <strong>
                        {{ $logement->titre }}
                    </strong>

                    <small>
                        📍 {{ $logement->quartier }},
                        {{ $logement->ville }}
                    </small>

                </div>

            </div>


            {{-- PRIX --}}
            <div class="price-box">

                <span>
                    Mise en avant
                </span>

                <strong>
                    {{ number_format(
                        $paiement->montant,
                        0,
                        ',',
                        ' '
                    ) }}
                    FCFA
                </strong>

                <small>
                    Visibilité renforcée pendant 7 jours
                </small>

            </div>


            {{-- INFORMATIONS --}}
            <div class="payment-info">

                <div>

                    <span>
                        Type
                    </span>

                    <strong>
                        Mise en avant
                    </strong>

                </div>


                <div>

                    <span>
                        Durée
                    </span>

                    <strong>
                        7 jours
                    </strong>

                </div>


                <div>

                    <span>
                        Référence
                    </span>

                    <strong>
                        {{ $paiement->reference }}
                    </strong>

                </div>


                <div>

                    <span>
                        Statut
                    </span>

                    <strong class="status">
                        {{ ucfirst(
                            str_replace(
                                '_',
                                ' ',
                                $paiement->statut
                            )
                        ) }}
                    </strong>

                </div>

            </div>


            {{-- MOYENS DE PAIEMENT --}}
            <div class="payment-methods">

                <h3>
                    Choisissez votre moyen de paiement
                </h3>


                <form method="POST" action="{{ route('paygate.start', $paiement) }}">
                    @csrf
                    <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="Numéro de téléphone" required>
                    @error('phone') <small>{{ $message }}</small> @enderror
                    <input type="hidden" name="network" data-network-field value="{{ old('network') }}">
                    <button type="submit" class="confirm-payment">Payer</button>
                </form>

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


            {{-- RETOUR --}}
            <a
                href="{{ route(
                    'bailleur.logements.index'
                ) }}"
                class="back-button"
            >

                ← Retour à mes logements

            </a>

        </div>

    </div>


    <style>

        .visibility-payment-page {

            min-height: calc(100vh - 65px);

            display: flex;

            align-items: center;

            justify-content: center;

            padding: 40px 20px;

            background:
                linear-gradient(
                    135deg,
                    #fff8e8,
                    #f0fff6
                );

        }


        .visibility-payment-card {

            width: 100%;

            max-width: 620px;

            background: white;

            border-radius: 25px;

            padding: 40px;

            text-align: center;

            box-shadow:
                0 20px 50px
                rgba(0,0,0,.10);

        }


        .visibility-icon {

            width: 80px;

            height: 80px;

            margin:
                0 auto 20px;

            border-radius: 23px;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 38px;

            background:
                linear-gradient(
                    135deg,
                    #fff3cd,
                    #ffe69c
                );

        }


        .visibility-payment-card h1 {

            font-size: 28px;

            font-weight: 800;

            color: #212529;

            margin-bottom: 10px;

        }


        .subtitle {

            color: #6c757d;

            line-height: 1.6;

            margin-bottom: 25px;

        }


        /* LOGEMENT */

        .logement-box {

            display: flex;

            align-items: center;

            gap: 15px;

            padding: 18px;

            border-radius: 17px;

            background: #f8f9fa;

            border: 1px solid #e9ecef;

            text-align: left;

            margin-bottom: 20px;

        }


        .logement-icon {

            width: 55px;

            height: 55px;

            flex-shrink: 0;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 15px;

            background:
                rgba(13,110,253,.10);

            font-size: 27px;

        }


        .logement-content span {

            display: block;

            color: #6c757d;

            font-size: 12px;

        }


        .logement-content strong {

            display: block;

            margin-top: 3px;

            font-size: 16px;

            color: #212529;

        }


        .logement-content small {

            display: block;

            margin-top: 4px;

            color: #6c757d;

        }


        /* PRIX */

        .price-box {

            padding: 25px;

            border-radius: 18px;

            background:
                linear-gradient(
                    135deg,
                    #ffb000,
                    #ff7a00
                );

            color: white;

            margin-bottom: 25px;

        }


        .price-box span {

            display: block;

            font-size: 14px;

            opacity: .9;

        }


        .price-box strong {

            display: block;

            font-size: 35px;

            font-weight: 800;

            margin: 5px 0;

        }


        .price-box small {

            opacity: .9;

        }


        /* INFORMATIONS */

        .payment-info {

            text-align: left;

            border-top: 1px solid #eee;

            border-bottom: 1px solid #eee;

            padding: 15px 0;

            margin-bottom: 25px;

        }


        .payment-info div {

            display: flex;

            justify-content: space-between;

            gap: 20px;

            padding: 8px 0;

        }


        .payment-info span {

            color: #6c757d;

        }


        .payment-info strong {

            color: #212529;

        }


        .status {

            color: #fd7e14 !important;

        }


        /* PAIEMENT */

        .payment-methods {

            text-align: left;

        }


        .payment-methods h3 {

            font-size: 18px;

            font-weight: 700;

            margin-bottom: 15px;

        }


        .payment-method {

            width: 100%;

            padding: 15px;

            margin-bottom: 10px;

            border: 1px solid #e5e7eb;

            border-radius: 14px;

            background: #f8f9fa;

            text-align: left;

            font-weight: 700;

            cursor: not-allowed;

        }


        .payment-method small {

            float: right;

            color: #198754;

            font-weight: 500;

        }


        /* MODE TEST */

        .test-payment {

            display: flex;

            align-items: flex-start;

            gap: 15px;

            padding: 15px;

            margin: 20px 0;

            border-radius: 15px;

            background: #fff8e1;

            border: 1px solid #ffe082;

            text-align: left;

        }


        .test-payment-icon {

            font-size: 25px;

        }


        .test-payment-content strong {

            display: block;

            color: #856404;

            margin-bottom: 4px;

        }


        .test-payment-content p {

            margin: 0;

            font-size: 13px;

            color: #856404;

            line-height: 1.5;

        }


        /* BOUTON */

        .confirm-payment {

            width: 100%;

            border: none;

            border-radius: 14px;

            padding: 16px 20px;

            background:
                linear-gradient(
                    135deg,
                    #ff7a00,
                    #198754
                );

            color: white;

            font-size: 16px;

            font-weight: 700;

            cursor: pointer;

            transition: .25s;

        }


        .confirm-payment:hover {

            transform:
                translateY(-2px);

            box-shadow:
                0 8px 20px
                rgba(255,122,0,.25);

        }


        /* RETOUR */

        .back-button {

            display: inline-block;

            margin-top: 20px;

            color: #0d6efd;

            text-decoration: none;

            font-weight: 600;

        }


        .back-button:hover {

            color: #198754;

        }


        /* MOBILE */

        @media(max-width: 600px) {

            .visibility-payment-card {

                padding: 25px 20px;

            }


            .visibility-payment-card h1 {

                font-size: 23px;

            }


            .payment-info div {

                flex-direction: column;

                gap: 2px;

            }


            .logement-box {

                align-items: flex-start;

            }

        }

    </style>

</x-app-layout>