{{-- Modal Création Compte Épargne --}}
<div id="create-epargne-modal" tabindex="-1" aria-hidden="true"
    class="fixed inset-0 z-50 hidden overflow-y-auto overflow-x-hidden flex items-center justify-center bg-black bg-opacity-50">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-xl shadow-2xl">

            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t bg-gray-50">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-kzz-blue bg-opacity-10 rounded-lg">
                        <svg class="w-6 h-6 text-kzz-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Nouveau Compte Épargne</h3>
                </div>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-hide="create-epargne-modal">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 14 14">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>

            <form action="{{ route('finance.epargnes.store') }}" method="POST" class="p-6 space-y-6">
                @csrf

                {{-- Section Identité --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Nom <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="nom"
                            class="w-full p-2.5 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-kzz-blue focus:border-kzz-blue outline-none transition-all"
                            placeholder="Ex: KABAMBA" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Postnom <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="postnom"
                            class="w-full p-2.5 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-kzz-blue focus:border-kzz-blue outline-none transition-all"
                            placeholder="Ex: MUKENDI" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Prénom <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="prenom"
                            class="w-full p-2.5 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-kzz-blue focus:border-kzz-blue outline-none transition-all"
                            placeholder="Ex: Jean" required>
                    </div>
                </div>

                {{-- Section Contact & Objectif --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Téléphone <span
                                class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z">
                                    </path>
                                </svg>
                            </div>
                            <input type="tel" name="telephone"
                                class="ps-10 w-full p-2.5 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-kzz-blue focus:border-kzz-blue outline-none"
                                placeholder="0810000000" required>
                        </div>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Objectif Journalier (FC)</label>
                        <div class="relative">
                            <div
                                class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none font-bold text-gray-500">
                                FC</div>
                            <input type="number" name="montant_reference" min="0" step="500"
                                class="ps-10 w-full p-2.5 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-kzz-blue focus:border-kzz-blue outline-none"
                                placeholder="Ex: 5000">
                        </div>
                        <p class="mt-1 text-xs text-gray-500 italic">Cet objectif est indicatif et non obligatoire.</p>
                    </div>
                </div>

                {{-- Adresse --}}
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-700">Adresse de résidence</label>
                    <textarea name="adresse" rows="2"
                        class="w-full p-2.5 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-kzz-blue focus:border-kzz-blue outline-none"
                        placeholder="Commune, Quartier, Avenue, N°..."></textarea>
                </div>

                <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 flex items-start gap-3">
                    <svg class="w-5 h-5 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        <span class="font-bold">Info :</span> Le numéro de carte sera généré automatiquement à la
                        validation. Le système enregistrera la date actuelle ({{ date('d/m/Y') }}) comme date de
                        création.
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t">
                    <button type="button"
                        class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-200"
                        data-modal-hide="create-epargne-modal">
                        Annuler
                    </button>
                    <button type="submit"
                        class="px-5 py-2.5 text-sm font-medium text-white bg-kzz-blue rounded-lg hover:bg-opacity-90 focus:ring-4 focus:ring-blue-300 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Confirmer la Création
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
