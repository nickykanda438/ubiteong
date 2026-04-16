@extends('layouts.app')

@section('title', 'Octroyer un Crédit')

@section('content')
    <div class="p-4 bg-kzz-gray min-h-screen">
        <nav class="flex mb-5" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('finance.index') }}"
                        class="inline-flex items-center text-sm font-medium text-kzz-blue hover:underline">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                            </path>
                        </svg>
                        Finance
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-bold text-gray-500 md:ml-2 uppercase font-title">Nouveau
                            Crédit</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="max-w-4xl mx-auto">
            <div class="mb-6">
                <h2 class="text-2xl font-title font-bold text-kzz-blue uppercase">Formulaire d'octroi de crédit</h2>
                <p class="text-sm text-gray-600 font-sans mt-1">Veuillez renseigner les informations relatives au prêt. Taux
                    mensuel applicable : <span class="font-bold text-kzz-blue">20%</span>.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <div class="lg:col-span-2">
                    <form action="{{ route('finance.credits.store') }}" method="POST"
                        class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
                        @csrf

                        <div class="space-y-6">
                            <div>
                                <label for="membre_id"
                                    class="block mb-2 text-sm font-bold text-kzz-black uppercase font-title italic">Sélectionner
                                    le Membre</label>
                                <select id="membre_id" name="membre_id" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-kzz-blue focus:border-kzz-blue block w-full p-2.5">
                                    <option value="" selected disabled>Choisir un membre...</option>
                                    @foreach ($membres as $membre)
                                        <option value="{{ $membre->id }}">{{ $membre->nom_complet }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="montant_principal"
                                    class="block mb-2 text-sm font-bold text-kzz-black uppercase font-title italic">Montant
                                    à Prêter (FCFA)</label>
                                <input type="number" id="montant_principal" name="montant_principal" required
                                    min="1" placeholder="Ex: 50000"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-kzz-blue focus:border-kzz-blue block w-full p-2.5">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="date_deblocage"
                                        class="block mb-2 text-sm font-bold text-kzz-black uppercase font-title italic">Date
                                        de Déblocage</label>
                                    <input type="date" id="date_deblocage" name="date_deblocage"
                                        value="{{ date('Y-m-d') }}" required
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-kzz-blue focus:border-kzz-blue block w-full p-2.5">
                                </div>
                                <div>
                                    <label for="date_echeance_finale"
                                        class="block mb-2 text-sm font-bold text-kzz-black uppercase font-title italic">Échéance
                                        Finale (Max 6 mois)</label>
                                    <input type="date" id="date_echeance_finale" name="date_echeance_finale" required
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-kzz-blue focus:border-kzz-blue block w-full p-2.5">
                                </div>
                            </div>

                            <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-100">
                                <a href="{{ route('finance.index') }}"
                                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5">Annuler</a>
                                <button type="submit"
                                    class="text-white bg-kzz-blue hover:bg-opacity-90 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center transition transform hover:scale-105">
                                    Valider le Crédit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="space-y-4">
                    <div class="bg-kzz-blue text-white p-6 rounded-2xl shadow-lg">
                        <h3 class="font-title font-bold text-lg mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Conditions KAZWAZWA
                        </h3>
                        <ul class="text-xs space-y-3 opacity-90 font-sans">
                            <li class="flex items-start"><span class="mr-2">•</span><span>Remboursement **Mensuel**
                                    obligatoire.</span></li>
                            <li class="flex items-start"><span class="mr-2">•</span><span>Taux de base : **20% par
                                    mois**.</span></li>
                            <li class="flex items-start"><span class="mr-2">•</span><span>Durée maximale : **6
                                    mois**.</span></li>
                            <li class="flex items-start"><span class="mr-2">•</span><span>En cas de retard : Le taux est
                                    **doublé (40%)**.</span></li>
                        </ul>
                    </div>

                    <div id="simulator" class="bg-white p-5 rounded-2xl border border-kzz-green border-dashed">
                        <h4 class="text-sm font-bold text-kzz-green uppercase mb-2">Estimation Rapide</h4>
                        <div class="space-y-2">
                            <div class="flex justify-between text-xs">
                                <span>Intérêts mensuels:</span>
                                <span id="int_mensuel" class="font-bold">0 FCFA</span>
                            </div>
                            <div class="flex justify-between text-sm border-t pt-2 mt-2">
                                <span class="font-bold">Total à rembourser:</span>
                                <span id="total_estim" class="font-bold text-kzz-blue">0 FCFA</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Petit script pour calculer le total en temps réel
        const inputMontant = document.getElementById('montant_principal');
        const displayInt = document.getElementById('int_mensuel');
        const displayTotal = document.getElementById('total_estim');

        inputMontant.addEventListener('input', function() {
            let val = parseFloat(this.value) || 0;
            let interet = val * 0.20;
            let total = val + interet; // Estimation sur 1 mois par défaut

            displayInt.innerText = interet.toLocaleString() + ' FC';
            displayTotal.innerText = total.toLocaleString() + ' FC';
        });
    </script>
@endsection
