@extends('layouts.app')

@section('title', 'Gestion des Crédits')

@section('content')
    <div class="p-4 bg-gray-50 min-h-screen">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('finance.index') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-kzz-blue">
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
                            <span class="ml-1 text-sm font-bold text-kzz-blue uppercase md:ml-2">Gestion des Crédits</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <button data-modal-target="credit-modal" data-modal-toggle="credit-modal"
                class="flex items-center justify-center text-white bg-kzz-blue hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-bold rounded-lg text-sm px-5 py-2.5 transition transform hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
                Octroyer un Crédit
            </button>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                <p class="text-sm text-gray-500">Total Encours</p>
                <p class="text-2xl font-bold text-kzz-blue">2,450,000 FCFA</p>
            </div>
        </div>

        <div class="bg-white relative shadow-md sm:rounded-2xl overflow-hidden border border-gray-200">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="w-full md:w-1/2">
                    <form class="flex items-center">
                        <label for="simple-search" class="sr-only">Rechercher un membre</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewbox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" id="simple-search"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-kzz-blue focus:border-kzz-blue block w-full pl-10 p-2"
                                placeholder="Nom du membre, N° dossier..." required="">
                        </div>
                    </form>
                </div>
                <div
                    class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                    <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown"
                        class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-kzz-blue focus:z-10 focus:ring-4 focus:ring-gray-200"
                        type="button">
                        <svg class="h-4 w-4 mr-2 text-gray-400" fill="currentColor" viewbox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                                clip-rule="evenodd" />
                        </svg>
                        Filtres Avancés
                        <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div id="filterDropdown" class="z-10 hidden w-48 p-3 bg-white rounded-lg shadow border border-gray-100">
                        <h6 class="mb-3 text-sm font-bold text-gray-900 italic">Statut</h6>
                        <ul class="space-y-2 text-sm">
                            <li class="flex items-center"><input type="checkbox"
                                    class="w-4 h-4 text-kzz-blue bg-gray-100 border-gray-300 rounded focus:ring-kzz-blue"><label
                                    class="ml-2 text-gray-700">En cours</label></li>
                            <li class="flex items-center"><input type="checkbox"
                                    class="w-4 h-4 text-kzz-blue bg-gray-100 border-gray-300 rounded focus:ring-kzz-blue"><label
                                    class="ml-2 text-gray-700">Soldé</label></li>
                            <li class="flex items-center"><input type="checkbox"
                                    class="w-4 h-4 text-kzz-blue bg-gray-100 border-gray-300 rounded focus:ring-kzz-blue"><label
                                    class="ml-2 text-gray-700">En retard</label></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 font-sans">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 font-title italic">
                        <tr>
                            <th scope="col" class="px-4 py-3">Membre</th>
                            <th scope="col" class="px-4 py-3">Montant Prêté</th>
                            <th scope="col" class="px-4 py-3">Intérêts (20%)</th>
                            <th scope="col" class="px-4 py-3">Échéance Finale</th>
                            <th scope="col" class="px-4 py-3">Statut</th>
                            <th scope="col" class="px-4 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($credits as $credit)
                            <tr class="hover:bg-gray-50 transition">
                                <th scope="row" class="px-4 py-4 font-bold text-gray-900 whitespace-nowrap">
                                    {{ $credit->membre->nom_complet }}
                                </th>
                                <td class="px-4 py-4">{{ number_format($credit->montant_principal, 0, ',', ' ') }} FCFA
                                </td>
                                <td class="px-4 py-4 text-kzz-blue font-semibold">+
                                    {{ number_format($credit->montant_principal * 0.2, 0, ',', ' ') }}</td>
                                <td class="px-4 py-4 italic">
                                    {{ \Carbon\Carbon::parse($credit->date_echeance_finale)->format('d/m/Y') }}</td>
                                <td class="px-4 py-4">
                                    <span
                                        class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full border border-blue-400">Actif</span>
                                </td>
                                <td class="px-4 py-4 text-right">
                                    <button class="font-medium text-kzz-blue hover:underline">Détails</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-8 text-center text-gray-400">Aucun crédit trouvé.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="credit-modal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-2xl shadow-2xl border border-gray-100">
                <div class="flex items-start justify-between p-6 border-b rounded-t bg-gray-50">
                    <div>
                        <h3 class="text-xl font-bold text-kzz-blue uppercase font-title italic">
                            Octroi de Nouveau Crédit
                        </h3>
                        <p class="text-xs text-gray-500 mt-1">Taux mensuel : <span
                                class="font-bold text-kzz-blue">20%</span></p>
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
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="md:col-span-2">
                                <label
                                    class="block mb-2 text-sm font-bold text-gray-700 uppercase font-title italic">Sélectionner
                                    le Membre</label>
                                <select name="membre_id" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-kzz-blue focus:border-kzz-blue block w-full p-3">
                                    <option value="" selected disabled>Choisir un membre...</option>
                                    @foreach ($membres as $membre)
                                        <option value="{{ $membre->id }}">{{ $membre->nom_complet }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label
                                    class="block mb-2 text-sm font-bold text-gray-700 uppercase font-title italic">Montant
                                    (FCFA)</label>
                                <input type="number" id="modal_montant" name="montant_principal" required
                                    placeholder="Ex: 50000"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-kzz-blue focus:border-kzz-blue block w-full p-3">
                            </div>

                            <div>
                                <label
                                    class="block mb-2 text-sm font-bold text-gray-700 uppercase font-title italic">Échéance
                                    Finale</label>
                                <input type="date" name="date_echeance_finale" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-kzz-blue focus:border-kzz-blue block w-full p-3">
                            </div>
                        </div>

                        <div class="bg-blue-50 p-4 rounded-xl border border-blue-100 flex justify-between items-center">
                            <div>
                                <p class="text-xs text-blue-600 font-bold uppercase">Total à rembourser</p>
                                <p id="modal_total" class="text-xl font-black text-kzz-blue">0 FCFA</p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gray-500 italic">Intérêts inclus</p>
                                <p id="modal_int" class="text-sm font-bold text-kzz-blue">+ 0 FCFA</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-end p-6 space-x-3 border-t border-gray-200">
                        <button data-modal-hide="credit-modal" type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5">Annuler</button>
                        <button type="submit"
                            class="text-white bg-kzz-blue hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center transition transform hover:scale-105">Confirmer
                            l'Octroi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Script de simulation mis à jour pour le modal
        const inputM = document.getElementById('modal_montant');
        const displayI = document.getElementById('modal_int');
        const displayT = document.getElementById('modal_total');

        inputM.addEventListener('input', function() {
            let val = parseFloat(this.value) || 0;
            let interet = val * 0.20;
            let total = val + interet;

            displayI.innerText = '+ ' + interet.toLocaleString() + ' FCFA';
            displayT.innerText = total.toLocaleString() + ' FCFA';
        });
    </script>
@endsection
