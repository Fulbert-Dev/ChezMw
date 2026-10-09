<x-app-layout>

    <x-app-sidebar />

    <div class="container py-5">

        <div class="text-center mb-5">

            <h1 class="fw-bold">
                🚀 Mettre en avant votre logement
            </h1>

            <p class="text-muted">
                Augmentez la visibilité de votre annonce
                auprès des locataires.
            </p>

        </div>


        <div class="row g-4">


            {{-- PREMIUM --}}

            <div class="col-md-4">

                <div class="card h-100 shadow-sm border-0 rounded-4 p-4">

                    <div class="fs-1">
                        ⭐
                    </div>

                    <h3 class="fw-bold mt-3">
                        Premium
                    </h3>

                    <p class="text-muted">
                        Votre logement bénéficie d'une
                        meilleure visibilité.
                    </p>

                    <h2 class="fw-bold text-primary">
                        1 500 FCFA
                    </h2>

                    <p>
                        Pendant 7 jours
                    </p>

                    <a
                        href="{{ route(
                            'paiement.visibilite',
                            [
                                'logement' => $logement,
                                'niveau' => 1
                            ]
                        ) }}"
                        class="btn btn-primary w-100"
                    >
                        Choisir
                    </a>

                </div>

            </div>


            {{-- MISE EN AVANT --}}

            <div class="col-md-4">

                <div class="card h-100 shadow border-0 rounded-4 p-4">

                    <div class="fs-1">
                        🔥
                    </div>

                    <h3 class="fw-bold mt-3">
                        Mise en avant
                    </h3>

                    <p class="text-muted">
                        Votre logement apparaît davantage
                        dans les résultats.
                    </p>

                    <h2 class="fw-bold text-success">
                        2 500 FCFA
                    </h2>

                    <p>
                        Pendant 7 jours
                    </p>

                    <a
                        href="{{ route(
                            'paiement.visibilite',
                            [
                                'logement' => $logement,
                                'niveau' => 2
                            ]
                        ) }}"
                        class="btn btn-success w-100"
                    >
                        Mettre en avant
                    </a>

                </div>

            </div>


            {{-- TÊTE DES RÉSULTATS --}}

            <div class="col-md-4">

                <div class="card h-100 shadow border-0 rounded-4 p-4">

                    <div class="fs-1">
                        🚀
                    </div>

                    <h3 class="fw-bold mt-3">
                        Tête des résultats
                    </h3>

                    <p class="text-muted">
                        Votre logement apparaît en priorité
                        dans les résultats.
                    </p>

                    <h2 class="fw-bold text-danger">
                        5 000 FCFA
                    </h2>

                    <p>
                        Pendant 7 jours
                    </p>

                    <a
                        href="{{ route(
                            'paiement.visibilite',
                            [
                                'logement' => $logement,
                                'niveau' => 3
                            ]
                        ) }}"
                        class="btn btn-danger w-100"
                    >
                        🚀 Acheter
                    </a>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>