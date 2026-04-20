<div id="credit-modal" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-2xl shadow-2xl border border-gray-100">
            <div class="flex items-start justify-between p-6 border-b rounded-t bg-gray-50">
                <div>
                    <h3 class="text-xl font-bold text-kzz-blue uppercase font-title italic">
                        Octroi de Nouveau Crédit
                    </h3>
                    <p class="text-xs text-gray-500 mt-1">Taux mensuel : <span class="font-bold text-kzz-blue">20%</span>
                    </p>
                </div>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                    data-modal-hide="credit-modal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            <form action="{{ route('finance.credits.store') }}" method="POST">
                @csrf
                <div class="p-6 space-y-5">

                    @if ($errors->any())
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="md:col-span-2">
                            <label
                                class="block mb-2 text-sm font-bold text-gray-700 uppercase font-title italic">Sélectionner
                                le Membre</label>
                            <select name="membre_id" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-kzz-blue focus:border-kzz-blue block w-full p-3">
                                <option value="" selected disabled>Choisir un membre...</option>
                                @foreach ($membres as $membre)
                                    <option value="{{ $membre->id }}"
                                        {{ old('membre_id') == $membre->id ? 'selected' : '' }}>
                                        {{ $membre->nom_complet }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label
                                class="block mb-2 text-sm font-bold text-gray-700 uppercase font-title italic">Montant
                                (FC)</label>
                            <input type="number" id="modal_montant" name="montant_principal"
                                value="{{ old('montant_principal') }}" required placeholder="Ex: 50000"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-kzz-blue focus:border-kzz-blue block w-full p-3">
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-bold text-gray-700 uppercase font-title italic">Date
                                de Déblocage</label>
                            <input type="date" name="date_deblocage" required
                                value="{{ old('date_deblocage', date('Y-m-d')) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-kzz-blue focus:border-kzz-blue block w-full p-3">
                        </div>

                        <div class="md:col-span-2">
                            <label
                                class="block mb-2 text-sm font-bold text-gray-700 uppercase font-title italic">Échéance
                                Finale (Max 6 mois)</label>
                            <input type="date" name="date_echeance_finale" value="{{ old('date_echeance_finale') }}"
                                required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-kzz-blue focus:border-kzz-blue block w-full p-3">
                        </div>
                    </div>

                    <div class="bg-blue-50 p-4 rounded-xl border border-blue-100 flex justify-between items-center">
                        <div>
                            <p class="text-xs text-blue-600 font-bold uppercase">Total à rembourser</p>
                            <p id="modal_total" class="text-xl font-black text-kzz-blue">0 FC</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-500 italic">Intérêts inclus (20%)</p>
                            <p id="modal_int" class="text-sm font-bold text-kzz-blue">+ 0 FC</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end p-6 space-x-3 border-t border-gray-200">
                    <button data-modal-hide="credit-modal" type="button"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5">Annuler</button>
                    <button type="submit"
                        class="text-white bg-kzz-blue hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center transition transform hover:scale-105">
                        Confirmer l'Octroi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputMontant = document.getElementById('modal_montant');
        const displayInt = document.getElementById('modal_int');
        const displayTotal = document.getElementById('modal_total');

        inputMontant.addEventListener('input', function() {
            const montant = parseFloat(this.value) || 0;
            const interets = montant * 0.20;
            const total = montant + interets;

            displayInt.innerText = '+ ' + interets.toLocaleString('fr-FR') + ' FC';
            displayTotal.innerText = total.toLocaleString('fr-FR') + ' FC';
        });
    });
</script>
