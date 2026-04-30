{{-- Modal Versement / Dépôt (par compte spécifique) --}}
@if (isset($epargne))
    <div id="depot-modal-{{ $epargne->id }}" tabindex="-1" aria-hidden="true"
        class="fixed inset-0 z-50 hidden overflow-y-auto overflow-x-hidden bg-black bg-opacity-50 flex items-center justify-center">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-xl shadow-2xl">

                <div class="flex items-center justify-between p-4 border-b rounded-t bg-gray-50">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-green-100 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Effectuer un Dépôt</h3>
                    </div>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="depot-modal-{{ $epargne->id }}">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 14 14">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>

                <form action="{{ route('finance.epargne.depose') }}" method="POST" class="p-6 space-y-5">
                    @csrf

                    {{-- Envoi du numéro de carte pour retrouver le compte côté serveur --}}
                    <input type="hidden" name="numero_carte" value="{{ $epargne->numero_carte }}">

                    <div class="p-4 bg-blue-50 border border-blue-100 rounded-2xl flex justify-between items-center">
                        <div>
                            <p class="text-[10px] text-blue-600 uppercase font-black tracking-widest">Épargnant</p>
                            <span class="text-sm font-bold text-gray-800">{{ $epargne->nom_complet }}</span>
                        </div>
                        <div class="text-right">
                            <p class="text-[10px] text-blue-600 uppercase font-black tracking-widest">Solde Actuel</p>
                            <span
                                class="text-sm font-mono font-bold text-blue-700">{{ number_format($epargne->solde, 0, ',', ' ') }}
                                FC</span>
                        </div>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Montant à verser (Min. 500
                            FC)</label>
                        <div class="relative">
                            <div
                                class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none font-bold text-gray-400">
                                FC</div>
                            <input type="number" name="montant" id="input_montant_{{ $epargne->id }}" min="500"
                                step="500"
                                class="ps-10 w-full p-3 bg-white border border-gray-300 text-gray-900 text-lg font-black rounded-xl focus:ring-green-500 focus:border-green-500 outline-none"
                                placeholder="0" required
                                oninput="calculerNouveauSolde({{ $epargne->id }}, {{ $epargne->solde }}, {{ $epargne->montant_reference ?? 0 }})">
                        </div>

                        <div id="alerte_objectif_{{ $epargne->id }}"
                            class="hidden mt-2 p-3 text-xs text-amber-700 bg-amber-50 rounded-2xl border border-amber-200 italic">
                            ⚠️ Ce montant est inférieur à votre objectif journalier
                            ({{ number_format($epargne->montant_reference ?? 0, 0, ',', ' ') }} FC).
                        </div>

                        <div class="mt-3 flex justify-between text-[11px]">
                            <span class="text-gray-500 italic">Objectif :
                                {{ number_format($epargne->montant_reference ?? ($epargne->montant_cible ?? 0), 0, ',', ' ') }}
                                FC</span>
                            <span class="text-green-600 font-bold uppercase"
                                id="preview_solde_{{ $epargne->id }}"></span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-gray-700">Nom du déposant</label>
                            <input type="text" name="nom_deposant" value="{{ $epargne->nom_complet }}"
                                class="w-full p-3 bg-gray-50 border border-gray-300 text-sm rounded-xl focus:ring-kzz-blue focus:border-kzz-blue outline-none"
                                required>
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-semibold text-gray-700">Lien</label>
                            <select name="lien_deposant"
                                class="w-full p-3 bg-gray-50 border border-gray-300 text-sm rounded-xl focus:ring-kzz-blue focus:border-kzz-blue">
                                <option value="proprietaire">Lui-même (Propriétaire)</option>
                                <option value="delegue">Délégué / Tiers</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t">
                        <button type="button"
                            class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-100"
                            data-modal-hide="depot-modal-{{ $epargne->id }}">
                            Annuler
                        </button>
                        <button type="submit"
                            class="px-5 py-2.5 text-sm font-bold text-white bg-green-600 rounded-xl hover:bg-green-700 shadow-lg shadow-green-100 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            Valider le Dépôt
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Retrait --}}
    <div id="retrait-modal-{{ $epargne->id }}" tabindex="-1" aria-hidden="true"
        class="fixed inset-0 z-50 hidden overflow-y-auto overflow-x-hidden bg-black bg-opacity-50 flex items-center justify-center">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-xl shadow-2xl">

                <div class="flex items-center justify-between p-4 border-b rounded-t bg-gray-50">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-red-100 rounded-lg">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Effectuer un Retrait</h3>
                    </div>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="retrait-modal-{{ $epargne->id }}">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 14 14">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>

                <form action="{{ route('finance.epargne.retrait', $epargne->id) }}" method="POST"
                    class="p-6 space-y-5">
                    @csrf
                    <input type="hidden" name="numero_carte" value="{{ $epargne->numero_carte }}">

                    <div class="p-4 bg-rose-50 border border-rose-100 rounded-2xl flex justify-between items-center">
                        <div>
                            <p class="text-[10px] text-rose-600 uppercase font-black tracking-widest">Épargnant</p>
                            <span class="text-sm font-bold text-gray-800">{{ $epargne->nom_complet }}</span>
                        </div>
                        <div class="text-right">
                            <p class="text-[10px] text-rose-600 uppercase font-black tracking-widest">Solde Actuel</p>
                            <span
                                class="text-sm font-mono font-bold text-rose-700">{{ number_format($epargne->solde, 0, ',', ' ') }}
                                FC</span>
                        </div>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Montant à retirer (Min. 500
                            FC)</label>
                        <div class="relative">
                            <div
                                class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none font-bold text-gray-400">
                                FC</div>
                            <input type="number" name="montant" id="input_retrait_{{ $epargne->id }}"
                                min="500" max="{{ $epargne->solde }}" step="500" required
                                class="ps-10 w-full p-3 bg-white border border-gray-300 text-gray-900 text-lg font-black rounded-xl focus:ring-red-500 focus:border-red-500 outline-none"
                                placeholder="0">
                        </div>
                        <p class="mt-2 text-xs text-gray-500 italic">Veuillez saisir le montant exact à retirer.</p>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t">
                        <button type="button"
                            class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-100"
                            data-modal-hide="retrait-modal-{{ $epargne->id }}">
                            Annuler
                        </button>
                        <button type="submit"
                            class="px-5 py-2.5 text-sm font-bold text-white bg-red-600 rounded-xl hover:bg-red-700 shadow-lg shadow-red-100 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5" />
                            </svg>
                            Valider le Retrait
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function calculerNouveauSolde(id, soldeActuel, objectif) {
            const input = document.getElementById('input_montant_' + id);
            const preview = document.getElementById('preview_solde_' + id);
            const alerte = document.getElementById('alerte_objectif_' + id);
            const montant = parseFloat(input.value) || 0;

            if (montant > 0) {
                const nouveauSolde = soldeActuel + montant;
                preview.innerText = "Nouveau solde : " + nouveauSolde.toLocaleString() + " FC";
            } else {
                preview.innerText = "";
            }

            if (montant > 0 && objectif > 0 && montant < objectif) {
                alerte.classList.remove('hidden');
            } else {
                alerte.classList.add('hidden');
            }
        }
    </script>
@endif

{{-- Modal Dépôt Général --}}
@if (!isset($epargne))
    <div id="depot-general-modal" tabindex="-1" aria-hidden="true"
        class="fixed inset-0 z-50 hidden overflow-y-auto overflow-x-hidden bg-black bg-opacity-50 flex items-center justify-center">
        <div class="relative p-4 w-full max-w-lg max-h-full">
            <div class="relative bg-white rounded-xl shadow-2xl">

                <div class="flex items-center justify-between p-4 border-b rounded-t bg-gray-50">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-green-100 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Effectuer un Dépôt</h3>
                    </div>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="depot-general-modal">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 14 14">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>

                <form action="{{ route('finance.epargnes.depose') }}" method="POST" class="p-6 space-y-5">
                    @csrf

                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Sélectionner le compte
                            épargne</label>
                        <select name="numero_carte"
                            class="w-full p-3 bg-gray-50 border border-gray-300 text-sm rounded-xl focus:ring-green-500 focus:border-green-500 outline-none"
                            required>
                            <option value="">-- Choisir un compte --</option>
                            @foreach ($epargnes ?? [] as $epargne)
                                <option value="{{ $epargne->numero_carte }}">
                                    {{ $epargne->numero_carte }} - {{ $epargne->nom_complet }}
                                    ({{ number_format($epargne->solde, 0, ',', ' ') }} FC)
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Montant à verser (Min. 500
                            FC)</label>
                        <div class="relative">
                            <div
                                class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none font-bold text-gray-400">
                                FC</div>
                            <input type="number" name="montant" min="500" step="500"
                                class="ps-10 w-full p-3 bg-white border border-gray-300 text-gray-900 text-lg font-black rounded-xl focus:ring-green-500 focus:border-green-500 outline-none"
                                placeholder="0" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-gray-700">Nom du déposant</label>
                            <input type="text" name="nom_deposant"
                                class="w-full p-3 bg-gray-50 border border-gray-300 text-sm rounded-xl focus:ring-green-500 focus:border-green-500 outline-none"
                                placeholder="Nom du déposant" required>
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-semibold text-gray-700">Lien</label>
                            <select name="lien_deposant"
                                class="w-full p-3 bg-gray-50 border border-gray-300 text-sm rounded-xl focus:ring-green-500 focus:border-green-500">
                                <option value="proprietaire">Lui-même (Propriétaire)</option>
                                <option value="delegue">Délégué / Tiers</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t">
                        <button type="button"
                            class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-100"
                            data-modal-hide="depot-general-modal">
                            Annuler
                        </button>
                        <button type="submit"
                            class="px-5 py-2.5 text-sm font-bold text-white bg-green-600 rounded-xl hover:bg-green-700 shadow-lg shadow-green-100 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            Valider le Dépôt
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif
