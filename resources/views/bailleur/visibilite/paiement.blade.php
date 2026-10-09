<x-app-layout>

    <x-app-sidebar />

    <div class="container py-5">

        <div class="card shadow-lg border-0 rounded-4">

            <div class="card-body p-5 text-center">

                <h2 class="fw-bold mb-3">
                    💳 Paiement de visibilité
                </h2>

                <h4 class="mb-3">
                    {{ $logement->titre }}
                </h4>

                <p class="text-muted">
                    {{ $description }}
                </p>

                <div class="my-4">

                    <span class="display-5 fw-bold text-success">

                        {{ number_format(
                            $paiement->montant,
                            0,
                            ',',
                            ' '
                        ) }}

                        FCFA

                    </span>

                </div>

                <div class="alert alert-info">

                    ⏱️ Durée :
                    <strong>
                        {{ $duree }} jours
                    </strong>

                </div>

                <div class="alert alert-warning">

                    Référence :
                    <strong>
                        {{ $paiement->reference }}
                    </strong>

                </div>


                {{-- TEMPORAIRE --}}
                <form
                    action="{{ route(
                        'bailleur.visibilite.confirmer',
                        $paiement
                    ) }}"
                    method="POST"
                >

                    @csrf

                    <button
                        type="submit"
                        class="btn btn-success btn-lg px-5"
                    >

                        ✅ Simuler le paiement

                    </button>

                </form>


                <a
                    href="{{ route(
                        'bailleur.visibilite.show',
                        $logement
                    ) }}"
                    class="btn btn-light mt-3"
                >

                    ← Annuler

                </a>

            </div>

        </div>

    </div>

</x-app-layout>