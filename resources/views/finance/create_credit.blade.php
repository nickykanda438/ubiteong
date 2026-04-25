<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>

<div id="credit-modal" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-2xl shadow-2xl border border-gray-100">

            <div class="flex items-start justify-between p-6 border-b rounded-t bg-gray-50">
                <div>
                    <h3 class="text-xl font-bold text-kzz-blue uppercase font-title italic">
                        Octroi de Nouveau Crédit
                    </h3>
                    <p class="text-xs text-gray-500 mt-1">
                        Taux mensuel : <span class="font-bold text-kzz-blue">20%</span> |
                        Retard : <span class="font-bold text-red-600">40%</span>
                    </p>
                </div>
                <button type="button" data-modal-hide="credit-modal"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            <form action="{{ route('finance.credits.store') }}" method="POST" id="form-credit">
                @csrf
                <div class="p-6 space-y-5">

                    <div id="js-error-container"
                        class="hidden p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 font-medium"></div>
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
                            <select id="select-membre" name="membre_id" required placeholder="Rechercher un membre...">
                                <option value="">Rechercher un membre...</option>
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
                                Principal</label>
                            <div class="relative">
                                <input type="number" id="modal_montant" name="montant_principal"
                                    value="{{ old('montant_principal') }}" required placeholder="Ex: 50000"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-kzz-blue focus:border-kzz-blue block w-full p-3 pr-20">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <select name="devise" id="modal_devise"
                                        class="bg-transparent border-none text-sm font-bold text-kzz-blue focus:ring-0 cursor-pointer">
                                        <option value="USD" {{ old('devise') == 'USD' ? 'selected' : '' }}>USD
                                        </option>
                                        <option value="CDF" {{ old('devise') == 'CDF' ? 'selected' : '' }}>CDF
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-bold text-gray-700 uppercase font-title italic">Date
                                de Déblocage</label>
                            <input type="date" id="date_deblocage" name="date_deblocage" required
                                value="{{ old('date_deblocage', date('Y-m-d')) }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-kzz-blue focus:border-kzz-blue block w-full p-3">
                        </div>

                        <div class="md:col-span-2">
                            <label
                                class="block mb-2 text-sm font-bold text-gray-700 uppercase font-title italic">Échéance
                                Finale (Max 6 mois)</label>
                            <input type="date" id="date_echeance" name="date_echeance_finale"
                                value="{{ old('date_echeance_finale') }}" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-kzz-blue focus:border-kzz-blue block w-full p-3">
                            <div class="flex justify-between mt-1 px-1">
                                <p id="duree_label" class="text-xs font-bold italic text-gray-500">Durée : 0 mois</p>
                                <p class="text-[10px] text-gray-400 uppercase tracking-tighter italic">Calcul au mois
                                    glissant</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-900 p-5 rounded-2xl border border-gray-800 shadow-inner">
                        <div class="flex justify-between items-end mb-4">
                            <div>
                                <p class="text-[10px] text-gray-400 uppercase font-bold tracking-widest">Total
                                    Remboursement</p>
                                <p id="modal_total" class="text-2xl font-black text-white leading-none">0 USD</p>
                            </div>
                            <div class="text-right">
                                <p class="text-[10px] text-gray-400 uppercase font-bold tracking-widest">Intérêts (<span
                                        id="taux_affiche" class="text-blue-400">20% x 0</span>)</p>
                                <p id="modal_int" class="text-lg font-bold text-blue-400 leading-none">+ 0 USD</p>
                            </div>
                        </div>
                        <div class="pt-3 border-t border-gray-800 flex justify-between items-center">
                            <span class="text-[10px] text-gray-500 italic">Si retard (Simulation 1 mois) :</span>
                            <span id="simul_retard" class="text-xs font-bold text-red-500">+ 0 USD</span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end p-6 space-x-3 border-t border-gray-200">
                    <button data-modal-hide="credit-modal" type="button"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5">Annuler</button>
                    <button type="submit" id="btn-submit"
                        class="text-white bg-kzz-blue hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center transition transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed">
                        Confirmer l'Octroi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Initialisation TomSelect
        new TomSelect("#select-membre", {
            create: false
        });

        const el = {
            montant: document.getElementById('modal_montant'),
            devise: document.getElementById('modal_devise'),
            debut: document.getElementById('date_deblocage'),
            fin: document.getElementById('date_echeance'),
            displayInt: document.getElementById('modal_int'),
            displayTotal: document.getElementById('modal_total'),
            displaySimul: document.getElementById('simul_retard'),
            dureeLabel: document.getElementById('duree_label'),
            tauxAffiche: document.getElementById('taux_affiche'),
            error: document.getElementById('js-error-container'),
            btn: document.getElementById('btn-submit')
        };

        function updateCalcul() {
            const montant = parseFloat(el.montant.value) || 0;
            const devise = el.devise.value;
            const dStart = new Date(el.debut.value);
            const dEnd = new Date(el.fin.value);

            if (!isNaN(dStart.getTime()) && !isNaN(dEnd.getTime()) && dEnd >= dStart) {
                // Calcul mois glissant
                let mois = (dEnd.getFullYear() - dStart.getFullYear()) * 12 + (dEnd.getMonth() - dStart
                    .getMonth());
                if (dEnd.getDate() >= dStart.getDate()) {
                    mois += 1;
                }
                mois = Math.max(1, mois);

                // Validation 6 mois & UX
                if (mois > 6) {
                    el.error.innerText = "❌ Durée maximale de 6 mois dépassée.";
                    el.error.classList.remove('hidden');
                    el.btn.disabled = true;
                    el.dureeLabel.className = "text-xs font-bold italic text-red-600";
                } else {
                    el.error.classList.add('hidden');
                    el.btn.disabled = false;
                    el.dureeLabel.className = (mois <= 3) ? "text-xs font-bold italic text-green-600" :
                        "text-xs font-bold italic text-orange-500";
                }

                el.dureeLabel.innerText = `Durée : ${mois} mois`;
                el.tauxAffiche.innerText = `20% x ${mois}`;

                const interets = montant * 0.20 * mois;
                const total = montant + interets;
                const simulRetard = montant * 0.40;

                el.displayInt.innerText = `+ ${interets.toLocaleString('fr-FR')} ${devise}`;
                el.displayTotal.innerText = `${total.toLocaleString('fr-FR')} ${devise}`;
                el.displaySimul.innerText = `+ ${simulRetard.toLocaleString('fr-FR')} ${devise}`;

            } else {
                // Reset UX si dates incohérentes
                el.error.classList.add('hidden');
                el.btn.disabled = false;
                el.dureeLabel.innerText = "Durée : 0 mois";
                el.dureeLabel.className = "text-xs font-bold italic text-gray-500";
                el.tauxAffiche.innerText = "20% x 0";
            }
        }

        [el.montant, el.devise, el.debut, el.fin].forEach(input => {
            input.addEventListener('input', updateCalcul);
            input.addEventListener('change', updateCalcul);
        });
    });
</script>

<style>
    /* Intégration TomSelect avec Tailwind */
    .ts-control {
        border-radius: 0.75rem !important;
        padding: 0.75rem !important;
        background-color: #f9fafb !important;
        border: 1px solid #d1d5db !important;
        font-size: 0.875rem !important;
    }

    .ts-wrapper.focus .ts-control {
        box-shadow: none !important;
        border-color: #1e40af !important;
        /* kzz-blue */
    }

    .ts-dropdown {
        border-radius: 0.75rem !important;
        margin-top: 5px !important;
    }
</style>
