<x-app-layout>
    <x-app-sidebar />

    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800">
                    Supprimer un message
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Cette action supprimera uniquement ce message.
                </p>
            </div>

            <a
                href="{{ route('locataire.messages.show', $message) }}"
                class="rounded-lg bg-white px-4 py-2 text-sm font-semibold text-blue-600 shadow-sm ring-1 ring-gray-200 transition hover:bg-gray-50"
            >
                ← Retour
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">
                <div class="border-b border-gray-100 px-6 py-5">
                    <h3 class="text-lg font-bold text-gray-900">
                        Confirmer la suppression
                    </h3>
                </div>

                <div class="space-y-5 p-6">
                    <div class="rounded-xl bg-red-50 p-4 text-sm text-red-700 ring-1 ring-red-100">
                        <strong>Attention :</strong> cette action est irréversible pour ce message.
                    </div>

                    <div class="rounded-2xl border border-gray-200 bg-gray-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                            Interlocuteur
                        </p>
                        <p class="mt-2 text-base font-semibold text-gray-900">
                            {{ $interlocuteur->name ?? 'Utilisateur' }}
                        </p>
                    </div>

                    <div class="rounded-2xl border border-gray-200 bg-gray-50 p-4">
                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                            Message
                        </p>
                        <p class="mt-2 whitespace-pre-line text-sm leading-6 text-gray-700">
                            {{ $message->contenu }}
                        </p>
                    </div>

                    <div class="flex flex-wrap items-center justify-end gap-3 pt-2">
                        <a
                            href="{{ route('locataire.messages.show', $message) }}"
                            class="rounded-xl border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
                        >
                            Annuler
                        </a>

                        <form method="POST" action="{{ route('locataire.messages.supprimer', $message) }}">
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="inline-flex items-center justify-center rounded-xl bg-red-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-red-700"
                            >
                                <i class="bi bi-trash3 me-2"></i>
                                Supprimer le message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
