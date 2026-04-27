@extends('layouts.app')

@section('title', 'Gestion des Crédits')

@section('content')
    <div class="p-4 bg-gray-50 min-h-screen">
        {{-- Header & Breadcrumb --}}
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
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-bold text-kzz-blue uppercase md:ml-2">Gestion des Crédits</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <div class="flex gap-2">
                <a href="{{ route('finance.index') }}"
                    class="flex items-center justify-center text-gray-700 bg-white border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-bold rounded-lg text-sm px-5 py-2.5 transition transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Retour au tableau de bord
                </a>

                <button data-modal-target="credit-modal" data-modal-toggle="credit-modal"
                    class="flex items-center justify-center text-white bg-kzz-blue hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-bold rounded-lg text-sm px-5 py-2.5 transition transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                        </path>
                    </svg>
                    Octroyer un Crédit
                </button>

                <button data-modal-target="repayment-modal" data-modal-toggle="repayment-modal"
                    class="flex items-center justify-center text-white bg-emerald-600 hover:bg-emerald-700 focus:ring-4 focus:ring-emerald-300 font-bold rounded-lg text-sm px-5 py-2.5 transition transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                    Rembourser un Crédit
                </button>
            </div>
        </div>

        {{-- Section Statistiques --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            {{-- Total en cours --}}
            <div class="bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm">
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Total en cours</p>
                <div class="space-y-1 mt-1">
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-bold text-blue-600">USD</span>
                        <span class="text-lg font-black text-gray-900">
                            {{ number_format($stats['usd']['total_encours'] ?? 0, 0, ',', ' ') }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-bold text-blue-600">CDF</span>
                        <span class="text-lg font-black text-gray-900">
                            {{ number_format($stats['cdf']['total_encours'] ?? 0, 0, ',', ' ') }}
                        </span>
                    </div>
                </div>
                <span class="text-[10px] text-blue-600 font-semibold italic block mt-2">Capital prêté actif</span>
            </div>

            {{-- Total Remboursé --}}
            <div class="bg-white p-4 rounded-xl border-l-4 border-green-500 shadow-sm">
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Total Remboursé</p>
                <div class="space-y-1 mt-1">
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-bold text-green-600">USD</span>
                        <span class="text-lg font-black text-gray-900">
                            {{ number_format($stats['usd']['total_rembourse'] ?? 0, 0, ',', ' ') }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-bold text-green-600">CDF</span>
                        <span class="text-lg font-black text-gray-900">
                            {{ number_format($stats['cdf']['total_rembourse'] ?? 0, 0, ',', ' ') }}
                        </span>
                    </div>
                </div>
                <span class="text-[10px] text-green-600 font-semibold italic block mt-2">Paiements reçus</span>
            </div>

            {{-- Reste à percevoir --}}
            <div class="bg-white p-4 rounded-xl border-l-4 border-orange-500 shadow-sm">
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Reste à percevoir</p>
                <div class="space-y-1 mt-1">
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-bold text-orange-600">USD</span>
                        <span class="text-lg font-black text-gray-900">
                            {{ number_format($stats['usd']['reste_a_payer'] ?? 0, 0, ',', ' ') }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-bold text-orange-600">CDF</span>
                        <span class="text-lg font-black text-gray-900">
                            {{ number_format($stats['cdf']['reste_a_payer'] ?? 0, 0, ',', ' ') }}
                        </span>
                    </div>
                </div>
                <span class="text-[10px] text-orange-600 font-semibold italic block mt-2">Balance restante</span>
            </div>

            {{-- En Souffrance --}}
            <div class="bg-white p-4 rounded-xl border-l-4 border-red-500 shadow-sm">
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">En Souffrance</p>
                <div class="space-y-1 mt-1">
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-bold text-red-600">USD</span>
                        <span class="text-lg font-black text-red-600">
                            {{ number_format($stats['usd']['total_depasse'] ?? 0, 0, ',', ' ') }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-bold text-red-600">CDF</span>
                        <span class="text-lg font-black text-red-600">
                            {{ number_format($stats['cdf']['total_depasse'] ?? 0, 0, ',', ' ') }}
                        </span>
                    </div>
                </div>
                <span class="text-[10px] text-red-600 font-semibold italic block mt-2">Délai expiré - Taux 40%</span>
                @if (($stats['usd']['total_depasse'] ?? 0) + ($stats['cdf']['total_depasse'] ?? 0) > 0)
                    <div class="mt-2 flex items-center">
                        <svg class="w-3 h-3 text-red-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-[9px] text-red-600 font-bold uppercase">Attention requise</span>
                    </div>
                @endif
            </div>
        </div>

        {{-- Tableau et Filtres --}}
        <div class="bg-white relative shadow-md sm:rounded-2xl overflow-hidden border border-gray-200">
            <div
                class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4 border-b border-gray-100">
                <div class="w-full md:w-1/2">
                    <form action="{{ route('finance.credit') }}" method="GET" class="flex items-center">
                        <label for="simple-search" class="sr-only">Rechercher</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewbox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" name="search" id="simple-search" value="{{ request('search') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-kzz-blue focus:border-kzz-blue block w-full pl-10 p-2"
                                placeholder="Nom du membre, N° dossier...">
                        </div>
                    </form>
                </div>

                <div
                    class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                    {{-- Bouton Filtre --}}
                    <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown"
                        class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-kzz-blue focus:z-10 focus:ring-4 focus:ring-gray-200"
                        type="button">
                        <svg class="h-4 w-4 mr-2 text-gray-400" fill="currentColor" viewbox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                                clip-rule="evenodd" />
                        </svg>
                        Filtrer par Statut
                        <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>

                    {{-- Dropdown Filtre --}}
                    <div id="filterDropdown"
                        class="z-10 hidden w-48 p-3 bg-white rounded-lg shadow border border-gray-100">
                        <h6 class="mb-3 text-sm font-bold text-gray-900 italic">État du crédit</h6>
                        <form id="filterForm" action="{{ route('finance.credit') }}" method="GET">
                            <ul class="space-y-2 text-sm">
                                <li class="flex items-center">
                                    <input type="checkbox" name="status[]" value="en_cours"
                                        onchange="this.form.submit()"
                                        {{ is_array(request('status')) && in_array('en_cours', request('status')) ? 'checked' : '' }}
                                        class="w-4 h-4 text-kzz-blue bg-gray-100 border-gray-300 rounded focus:ring-kzz-blue">
                                    <label class="ml-2 text-gray-700">En cours</label>
                                </li>
                                <li class="flex items-center">
                                    <input type="checkbox" name="status[]" value="solde" onchange="this.form.submit()"
                                        {{ is_array(request('status')) && in_array('solde', request('status')) ? 'checked' : '' }}
                                        class="w-4 h-4 text-kzz-blue bg-gray-100 border-gray-300 rounded focus:ring-kzz-blue">
                                    <label class="ml-2 text-gray-700">Soldé</label>
                                </li>
                                <li class="flex items-center">
                                    <input type="checkbox" name="status[]" value="en_retard"
                                        onchange="this.form.submit()"
                                        {{ is_array(request('status')) && in_array('en_retard', request('status')) ? 'checked' : '' }}
                                        class="w-4 h-4 text-kzz-blue bg-gray-100 border-gray-300 rounded focus:ring-kzz-blue">
                                    <label class="ml-2 text-gray-700">En retard</label>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 font-sans">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 font-title italic">
                        <tr>
                            <th scope="col" class="px-4 py-3">Membre</th>
                            <th scope="col" class="px-4 py-3">Montant Prêté</th>
                            <th scope="col" class="px-4 py-3">Paiement mensuel (20%)</th>
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
                                <td class="px-4 py-4 font-medium">
                                    {{ number_format($credit->montant_principal, 0, ',', ' ') }} FC</td>
                                <td class="px-4 py-4 text-kzz-blue font-semibold">
                                    {{ number_format($credit->montant_principal * 0.2, 0, ',', ' ') }} FC
                                </td>
                                <td class="px-4 py-4 italic">
                                    {{ \Carbon\Carbon::parse($credit->date_echeance_finale)->format('d/m/Y') }}
                                </td>
                                <td class="px-4 py-4">
                                    @if ($credit->statut == 'en_retard')
                                        <span
                                            class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full border border-red-400">En
                                            retard</span>
                                    @elseif($credit->statut == 'solde')
                                        <span
                                            class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full border border-green-400">Soldé</span>
                                    @else
                                        <span
                                            class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full border border-blue-400">Actif</span>
                                    @endif
                                </td>
                                <td class="px-4 py-4 text-right">
                                    <a href="{{ route('finance.credits.show', $credit->id) }}"
                                        class="font-bold text-kzz-blue hover:underline">Détails</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-gray-300 mb-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                        <p class="text-gray-400">Aucun crédit trouvé dans cette catégorie.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Inclusion des Modals --}}
    @include('finance.create_credit')
    @include('finance.remboursement_credit')

    <script>
        // Script de simulation de calcul dans le modal
        document.addEventListener('DOMContentLoaded', function() {
            const inputM = document.getElementById('modal_montant');
            const displayI = document.getElementById('modal_int');
            const displayT = document.getElementById('modal_total');

            if (inputM) {
                inputM.addEventListener('input', function() {
                    let val = parseFloat(this.value) || 0;
                    let interet = val * 0.20;
                    let total = val + interet;

                    // Mise à jour en FC
                    displayI.innerText = '+ ' + interet.toLocaleString() + ' FC';
                    displayT.innerText = total.toLocaleString() + ' FC';
                });
            }
        });
    </script>
@endsection
