{{-- Modal Création Compte Épargne --}}
<div id="create-epargne-modal" tabindex="-1" aria-hidden="true"
    class="fixed inset-0 z-50 hidden overflow-y-auto overflow-x-hidden">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-lg shadow-xl">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-xl font-semibold text-kzz-black">Créer un Compte d'Épargne</h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-hide="create-epargne-modal">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 14 14">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>

            <form action="{{ route('finance.epargnes.store') }}" method="POST" class="p-4 md:p-5 space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-2 text-sm font-bold text-gray-700">Nom</label>
                        <input type="text" name="nom"
                            class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-kzz-blue focus:border-kzz-blue"
                            required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold text-gray-700">Postnom</label>
                        <input type="text" name="postnom"
                            class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-kzz-blue focus:border-kzz-blue"
                            required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold text-gray-700">Prénom</label>
                        <input type="text" name="prenom"
                            class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-kzz-blue focus:border-kzz-blue"
                            required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold text-gray-700">Téléphone</label>
                        <input type="tel" name="telephone"
                            class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-kzz-blue focus:border-kzz-blue"
                            required>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700">Adresse</label>
                        <textarea name="adresse" rows="3"
                            class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-kzz-blue focus:border-kzz-blue"
                            required></textarea>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold text-gray-700">Montant Cible (FC)</label>
                        <input type="number" name="montant_cible" min="0"
                            class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-kzz-blue focus:border-kzz-blue"
                            required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold text-gray-700">Fréquence d'Engagement</label>
                        <select name="frequence_engagement"
                            class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-kzz-blue focus:border-kzz-blue"
                            required>
                            <option value="journalier">Journalier</option>
                            <option value="mensuel">Mensuel</option>
                        </select>
                    </div>
                </div>

                <div class="flex items-center justify-end pt-4 border-t">
                    <button type="button"
                        class="px-5 py-2.5 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:ring-4 focus:outline-none focus:ring-gray-200 mr-3"
                        data-modal-hide="create-epargne-modal">Annuler</button>
                    <button type="submit"
                        class="px-5 py-2.5 text-sm font-medium text-white bg-kzz-green rounded-lg hover:bg-opacity-90 focus:ring-4 focus:outline-none focus:ring-green-300">Créer
                        le Compte</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modals pour Dépôt et Retrait --}}
@foreach ($epargnes as $epargne)
    {{-- Modal Dépôt --}}
    <div id="depot-modal-{{ $epargne->id }}" tabindex="-1" aria-hidden="true"
        class="fixed inset-0 z-50 hidden overflow-y-auto overflow-x-hidden">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow-xl">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-lg font-semibold text-kzz-black">Dépôt - {{ $epargne->nom_complet }}</h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="depot-modal-{{ $epargne->id }}">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 14 14">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>

                <form action="{{ route('finance.epargnes.depose') }}" method="POST" class="p-4 md:p-5 space-y-4">
                    @csrf
                    <input type="hidden" name="numero_carte" value="{{ $epargne->numero_carte }}">

                    <div>
                        <label class="block mb-2 text-sm font-bold text-gray-700">Montant à Déposer (FC)</label>
                        <input type="number" name="montant_depose" min="1"
                            class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-kzz-blue focus:border-kzz-blue"
                            required>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-bold text-gray-700">Nom du Déposant</label>
                        <input type="text" name="nom_deposant"
                            class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-kzz-blue focus:border-kzz-blue"
                            required>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-bold text-gray-700">Lien avec le Compte</label>
                        <select name="lien_deposant"
                            class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-kzz-blue focus:border-kzz-blue"
                            required>
                            <option value="proprietaire">Propriétaire</option>
                            <option value="delegue">Délégué</option>
                        </select>
                    </div>

                    <div class="flex items-center justify-end pt-4 border-t">
                        <button type="button"
                            class="px-5 py-2.5 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:ring-4 focus:outline-none focus:ring-gray-200 mr-3"
                            data-modal-hide="depot-modal-{{ $epargne->id }}">Annuler</button>
                        <button type="submit"
                            class="px-5 py-2.5 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300">Effectuer
                            le Dépôt</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Retrait --}}
    <div id="retrait-modal-{{ $epargne->id }}" tabindex="-1" aria-hidden="true"
        class="fixed inset-0 z-50 hidden overflow-y-auto overflow-x-hidden">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow-xl">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-lg font-semibold text-kzz-black">Retrait - {{ $epargne->nom_complet }}</h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="retrait-modal-{{ $epargne->id }}">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 14 14">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>

                <form action="{{ route('finance.epargnes.decaisse', $epargne) }}" method="POST"
                    class="p-4 md:p-5 space-y-4">
                    @csrf
                    @method('POST')

                    <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-yellow-800">Attention</h3>
                                <p class="text-sm text-yellow-700 mt-1">Un seul décaissement est autorisé par mois.
                                    Solde actuel: {{ number_format($epargne->solde_actuel, 0, ',', ' ') }} FC</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end pt-4 border-t">
                        <button type="button"
                            class="px-5 py-2.5 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:ring-4 focus:outline-none focus:ring-gray-200 mr-3"
                            data-modal-hide="retrait-modal-{{ $epargne->id }}">Annuler</button>
                        <button type="submit"
                            class="px-5 py-2.5 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300">Effectuer
                            le Retrait</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
