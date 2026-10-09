<x-app-layout>

    <x-app-sidebar />

    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800">
                    {{ $offre['icone'] }} {{ $offre['nom'] }}
                </h2>
                <p class="mt-1 text-sm text-gray-500">Choisissez le logement dont vous souhaitez augmenter la visibilité.</p>
            </div>

            <a
                href="{{ route('bailleur.offres') }}"
                class="rounded-lg bg-white px-4 py-2 text-sm font-semibold text-blue-600 shadow-sm ring-1 ring-gray-200 transition hover:bg-gray-50"
            >
                ← Retour aux offres
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">

            <div class="mb-7 rounded-2xl border border-blue-100 bg-gradient-to-r from-blue-50 to-emerald-50 p-5 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="font-bold text-gray-900">{{ $offre['nom'] }}</p>
                    <p class="mt-1 text-sm text-gray-600">{{ number_format($offre['montant'], 0, ',', ' ') }} FCFA · valable {{ $offre['duree'] }} jours</p>
                </div>
                <span class="mt-3 inline-flex rounded-full bg-white px-4 py-2 text-sm font-bold text-blue-700 shadow-sm sm:mt-0">
                    Étape 1 sur 2 : choisir le logement
                </span>
            </div>

            @forelse($logements as $logement)
                @php
                    $photo = $logement->photos->firstWhere('principale', true) ?? $logement->photos->first();
                @endphp

                <div class="mb-4 overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-100 sm:flex">
                    <div class="flex h-44 shrink-0 items-center justify-center bg-slate-100 sm:w-60">
                        @if($photo)
                            <img
                                src="{{ asset('storage/' . $photo->chemin) }}"
                                alt="{{ $logement->titre }}"
                                class="h-full w-full object-cover"
                            >
                        @else
                            <span class="text-5xl">🏠</span>
                        @endif
                    </div>

                    <div class="flex flex-1 flex-col justify-between p-5">
                        <div>
                            <div class="flex flex-wrap items-start justify-between gap-3">
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900">{{ $logement->titre }}</h3>
                                    <p class="mt-1 text-sm text-gray-500">📍 {{ $logement->quartier }}, {{ $logement->ville }}</p>
                                </div>

                                @if($logement->niveau_visibilite > 0 && (! $logement->date_fin_visibilite || $logement->date_fin_visibilite->isFuture()))
                                    <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-bold text-amber-800">Visibilité active</span>
                                @endif
                            </div>

                            <p class="mt-4 font-bold text-emerald-700">
                                {{ number_format($logement->prix, 0, ',', ' ') }} FCFA / mois
                            </p>
                        </div>

                        <form
                            method="POST"
                            action="{{ route('bailleur.visibilite.acheter', $logement) }}"
                            class="mt-5"
                        >
                            @csrf
                            <input type="hidden" name="niveau" value="{{ $niveau }}">

                            <button
                                type="submit"
                                class="w-full rounded-xl bg-gradient-to-r from-blue-600 to-emerald-600 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:opacity-90 sm:w-auto"
                            >
                                {{ $offre['icone'] }} {{ $offre['action'] }}
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="rounded-2xl bg-white px-6 py-16 text-center shadow-sm">
                    <div class="text-5xl">🏠</div>
                    <h3 class="mt-5 text-xl font-bold text-gray-900">Aucun logement actif</h3>
                    <p class="mx-auto mt-2 max-w-md text-gray-500">Publiez et activez d’abord un logement avant de lui donner plus de visibilité.</p>
                    <a
                        href="{{ route('bailleur.logements.create') }}"
                        class="mt-6 inline-flex rounded-lg bg-blue-600 px-5 py-3 font-semibold text-white transition hover:bg-blue-700"
                    >
                        Ajouter un logement
                    </a>
                </div>
            @endforelse
        </div>
    </div>

</x-app-layout>
