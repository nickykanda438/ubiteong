<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>

<div id="repayment-modal" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-2xl shadow-2xl border border-gray-100">

            <div class="flex items-start justify-between p-6 border-b rounded-t bg-emerald-50">
                <div>
                    <h3 class="text-xl font-bold text-emerald-700 uppercase font-title italic">
                        Remboursement de Crédit
                    </h3>
                    <p class="text-xs text-gray-600 mt-1">
                        Paiement mensuel fixe : <span class="font-bold text-emerald-700">20% du capital</span> |
                        Retard : <span class="font-bold text-red-600">40% du capital</span>
                    </p>
                </div>
                <button type="button" data-modal-hide="repayment-modal"
                    class="text-gray-400 bg-transparent hover:bg-emerald-100 hover:text-emerald-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            <form action="{{ route('finance.repayments.store') }}" method="POST" id="form-repayment">
                @csrf
                <div class="p-6 space-y-5">

                    <div id="js-error-container-repayment"
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
                                le Crédit</label>
                            <select id="select-credit" name="credit_id" required placeholder="Rechercher un crédit...">
                                <option value="">Rechercher un crédit...</option>
                                @foreach ($credits ?? [] as $credit)
                                    <option value="{{ $credit->id }}" data-membre="{{ $credit->membre->nom_complet }}"
                                        data-reste="{{ $credit->reste_a_payer }}" data-devise="{{ $credit->devise }}"
                                        data-statut="{{ $credit->statut_actuel }}">
                                        {{ $credit->membre->nom_complet }} -
                                        {{ number_format($credit->montant_principal, 0, ',', ' ') }}
                                        {{ $credit->devise }}
                                        (Reste: {{ number_format($credit->reste_a_payer, 0, ',', ' ') }}
                                        {{ $credit->devise }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <div id="credit-info" class="p-4 bg-gray-50 rounded-xl border border-gray-200 hidden">
                                <div class="grid grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <span class="text-xs font-bold text-gray-500 uppercase italic">Membre :</span>
                                        <span id="info-membre"
                                            class="text-sm font-black text-gray-900 italic ml-2">--</span>
                                    </div>
                                    <div>
                                        <span class="text-xs font-bold text-gray-500 uppercase italic">Reste à solder
                                            :</span>
                                        <span id="info-reste"
                                            class="text-sm font-black text-emerald-700 ml-2">0.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label
                                class="block mb-2 text-sm font-bold text-gray-700 uppercase font-title italic">Montant
                                à verser</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                        </path>
                                    </svg>
                                </div>
                                <input type="number" name="montant_paye" id="repay_amount" required step="any"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block w-full pl-10 p-3"
                                    placeholder="0.00">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <span id="repay_devise_label"
                                        class="text-xs font-black text-gray-400 uppercase">USD</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-bold text-gray-700 uppercase font-title italic">Date
                                de paiement</label>
                            <input type="date" name="date_paiement" id="date_paiement" required
                                value="{{ date('Y-m-d') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block w-full p-3">
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-bold text-gray-700 uppercase font-title italic">Mode
                                de paiement</label>
                            <select name="mode_paiement" id="mode_paiement" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block w-full p-3">
                                <option value="Espece">Espèce</option>
                                <option value="Banque">Banque</option>
                                <option value="Mobile Money">Mobile Money</option>
                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <label
                                class="block mb-2 text-sm font-bold text-gray-700 uppercase font-title italic">Référence
                                ou Commentaire</label>
                            <textarea name="commentaire" id="commentaire" rows="2"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block w-full p-3"
                                placeholder="Ex: N° Bordereau, Nom du déposant..."></textarea>
                        </div>
                    </div>

                    <div class="p-3 bg-slate-900 rounded-xl">
                        <div class="flex justify-between items-center">
                            <span class="text-[10px] font-black text-slate-400 uppercase">Solde après versement :</span>
                            <span id="new_balance" class="text-sm font-mono font-black text-emerald-400">0.00</span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end p-6 space-x-3 border-t border-gray-100 bg-gray-50">
                    <button data-modal-hide="repayment-modal" type="button"
                        class="text-gray-500 bg-white hover:bg-gray-100 rounded-xl border border-gray-200 text-sm font-bold px-5 py-2.5 transition">
                        Annuler
                    </button>
                    <button type="submit"
                        class="text-white bg-emerald-600 hover:bg-emerald-700 font-black rounded-xl text-sm px-8 py-2.5 shadow-lg shadow-emerald-100 transform transition active:scale-95">
                        Valider le Remboursement
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Initialisation TomSelect pour la recherche de crédit
        new TomSelect("#select-credit", {
            create: false,
            placeholder: "Rechercher un crédit...",
            render: {
                option: function(data, escape) {
                    return '<div>' +
                        '<div class="font-bold">' + escape(data.text) + '</div>' +
                        '</div>';
                },
                item: function(data, escape) {
                    return '<div>' + escape(data.text) + '</div>';
                }
            }
        });

        const el = {
            selectCredit: document.getElementById('select-credit'),
            creditInfo: document.getElementById('credit-info'),
            infoMembre: document.getElementById('info-membre'),
            infoReste: document.getElementById('info-reste'),
            repayAmount: document.getElementById('repay_amount'),
            deviseLabel: document.getElementById('repay_devise_label'),
            newBalance: document.getElementById('new_balance'),
            error: document.getElementById('js-error-container-repayment'),
            btn: document.querySelector('#form-repayment button[type="submit"]')
        };

        // Gestionnaire de changement de sélection de crédit
        el.selectCredit.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            if (selectedOption.value) {
                const membre = selectedOption.getAttribute('data-membre');
                const reste = parseFloat(selectedOption.getAttribute('data-reste')) || 0;
                const devise = selectedOption.getAttribute('data-devise') || 'USD';

                // Afficher les informations du crédit
                el.creditInfo.classList.remove('hidden');
                el.infoMembre.textContent = membre;
                el.infoReste.textContent = reste.toLocaleString('fr-FR') + ' ' + devise;
                el.deviseLabel.textContent = devise;

                // Calculer le nouveau solde
                updateNewBalance();
            } else {
                el.creditInfo.classList.add('hidden');
                el.newBalance.textContent = '0.00';
            }
        });

        // Gestionnaire de changement du montant
        el.repayAmount.addEventListener('input', updateNewBalance);

        function updateNewBalance() {
            const selectedOption = el.selectCredit.options[el.selectCredit.selectedIndex];
            if (selectedOption && selectedOption.value) {
                const reste = parseFloat(selectedOption.getAttribute('data-reste')) || 0;
                const montant = parseFloat(el.repayAmount.value) || 0;
                const nouveauSolde = Math.max(0, reste - montant);

                el.newBalance.textContent = nouveauSolde.toLocaleString('fr-FR') + ' ' + selectedOption
                    .getAttribute('data-devise');
            }
        }

        // Validation du formulaire
        document.getElementById('form-repayment').addEventListener('submit', function(e) {
            const selectedCredit = el.selectCredit.value;
            const montant = parseFloat(el.repayAmount.value) || 0;

            if (!selectedCredit) {
                e.preventDefault();
                el.error.textContent = "Veuillez sélectionner un crédit.";
                el.error.classList.remove('hidden');
                return;
            }

            if (montant <= 0) {
                e.preventDefault();
                el.error.textContent = "Le montant doit être supérieur à 0.";
                el.error.classList.remove('hidden');
                return;
            }

            const selectedOption = el.selectCredit.options[el.selectCredit.selectedIndex];
            const reste = parseFloat(selectedOption.getAttribute('data-reste')) || 0;

            if (montant > reste) {
                e.preventDefault();
                el.error.textContent = "Le montant ne peut pas dépasser le reste à payer.";
                el.error.classList.remove('hidden');
                return;
            }

            el.error.classList.add('hidden');
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
        border-color: #059669 !important;
        /* emerald-600 */
    }

    .ts-dropdown {
        border-radius: 0.75rem !important;
        margin-top: 5px !important;
    }
</style>
