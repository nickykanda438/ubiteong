<div id="repayment-modal" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-lg max-h-full">
        <div class="relative bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden">

            <div class="flex items-start justify-between p-6 border-b bg-emerald-50">
                <div>
                    <h3 class="text-xl font-black text-emerald-800 uppercase tracking-tight italic">
                        Formulaire de Remboursement
                    </h3>
                    <p class="text-[10px] text-emerald-600 font-bold uppercase tracking-widest mt-1">
                        Saisie d'un versement sur crédit
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

            <form action="{{ route('finance.repayments.store') }}" method="POST">
                @csrf
                <input type="hidden" name="credit_id" id="repay_credit_id">

                <div class="p-6 space-y-5">

                    <div class="p-4 bg-gray-50 rounded-xl border border-gray-200">
                        <div class="flex justify-between items-center">
                            <span class="text-xs font-bold text-gray-500 uppercase italic">Membre :</span>
                            <span id="repay_member_name" class="text-sm font-black text-gray-900 italic">--</span>
                        </div>
                        <div class="flex justify-between items-center mt-2 pt-2 border-t border-gray-200">
                            <span class="text-xs font-bold text-gray-500 uppercase italic">Reste à solder :</span>
                            <span id="repay_balance_total" class="text-sm font-black text-emerald-700">0.00</span>
                        </div>
                    </div>

                    <div>
                        <label for="repay_amount"
                            class="block mb-2 text-xs font-black text-gray-500 uppercase italic">Montant à
                            verser</label>
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
                                class="bg-white border border-gray-300 text-gray-900 text-lg font-black rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block w-full pl-10 p-3"
                                placeholder="0.00">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <span id="repay_devise_label"
                                    class="text-xs font-black text-gray-400 uppercase">USD</span>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="date_paiement"
                                class="block mb-2 text-xs font-black text-gray-500 uppercase italic">Date de
                                paiement</label>
                            <input type="date" name="date_paiement" id="date_paiement" value="{{ date('Y-m-d') }}"
                                required
                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 font-bold">
                        </div>

                        <div>
                            <label for="mode_paiement"
                                class="block mb-2 text-xs font-black text-gray-500 uppercase italic">Mode</label>
                            <select name="mode_paiement" id="mode_paiement" required
                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 font-bold">
                                <option value="Espece">Espèce</option>
                                <option value="Banque">Banque</option>
                                <option value="Mobile Money">Mobile Money</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="commentaire"
                            class="block mb-2 text-xs font-black text-gray-500 uppercase italic">Référence ou
                            Commentaire</label>
                        <textarea name="commentaire" id="commentaire" rows="2"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5"
                            placeholder="Ex: N° Bordereau, Nom du déposant..."></textarea>
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
