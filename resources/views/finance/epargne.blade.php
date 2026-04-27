@extends('layouts.app')

@section('title', 'Gestion des Épargnes')

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
                            <span class="ml-1 text-sm font-bold text-kzz-blue uppercase md:ml-2">Gestion des Épargnes</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <div class="flex gap-3">
                <a href="{{ route('finance.index') }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Retour au tableau de bord
                </a>
            </div>
        </div>

        {{-- Statistiques --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="p-5 bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-gray-500 uppercase">Total Épargnes</span>
                    <div class="p-2 bg-green-100 rounded-lg">
                        <svg class="w-6 h-6 text-kzz-green" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4zM18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="text-2xl font-bold text-kzz-black">{{ number_format($totalEpargne, 0, ',', ' ') }} FC</div>
                <p class="text-xs text-kzz-green font-medium mt-1">Fonds disponibles en caisse</p>
            </div>

            <div class="p-5 bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-gray-500 uppercase">Nombre d'Épargnants</span>
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <svg class="w-6 h-6 text-kzz-blue" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class="text-2xl font-bold text-kzz-black">{{ $nombreEpargnants }}</div>
                <p class="text-xs text-kzz-blue font-medium mt-1">Comptes actifs</p>
            </div>

            <div class="p-5 bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-gray-500 uppercase">Transactions Récentes</span>
                    <div class="p-2 bg-purple-100 rounded-lg">
                        <svg class="w-6 h-6 text-kzz-purple" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.293l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
                <div class="text-2xl font-bold text-kzz-black">{{ $transactionsRecentes->count() }}</div>
                <p class="text-xs text-kzz-purple font-medium mt-1">Derniers mouvements</p>
            </div>

            <div class="p-5 bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-gray-500 uppercase">Épargne Moyenne</span>
                    <div class="p-2 bg-yellow-100 rounded-lg">
                        <svg class="w-6 h-6 text-kzz-yellow" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z">
                            </path>
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
                <div class="text-2xl font-bold text-kzz-black">
                    {{ $nombreEpargnants > 0 ? number_format($totalEpargne / $nombreEpargnants, 0, ',', ' ') : 0 }} FC
                </div>
                <p class="text-xs text-kzz-yellow font-medium mt-1">Par épargnant</p>
            </div>
        </div>

        {{-- Liste des épargnes --}}
        <div class="bg-white relative shadow-xl rounded-2xl overflow-hidden border border-gray-100">
            <div
                class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-6 bg-white">
                <div class="w-full md:w-1/2">
                    <h2 class="text-xl font-bold text-kzz-black">Comptes d'Épargne</h2>
                    <p class="text-gray-500 text-sm">Gestion des comptes épargne et transactions</p>
                </div>
                <div class="w-full md:w-auto">
                    <button type="button" data-modal-target="create-epargne-modal" data-modal-toggle="create-epargne-modal"
                        class="w-full flex items-center justify-center text-white bg-kzz-green hover:bg-opacity-90 font-bold rounded-xl text-sm px-6 py-3.5 transition-all shadow-md uppercase tracking-wider">
                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
                        </svg>
                        Nouveau Compte
                    </button>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-white uppercase bg-kzz-blue font-title tracking-widest">
                        <tr>
                            <th scope="col" class="px-6 py-4">Épargnant</th>
                            <th scope="col" class="px-6 py-4">N° Carte</th>
                            <th scope="col" class="px-6 py-4">Solde Actuel</th>
                            <th scope="col" class="px-6 py-4">Objectif</th>
                            <th scope="col" class="px-6 py-4">Fréquence</th>
                            <th scope="col" class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($epargnes as $epargne)
                            <tr class="bg-white hover:bg-blue-50/40 transition-colors">
                                <th scope="row" class="px-6 py-4 font-semibold text-gray-900 whitespace-nowrap">
                                    <div class="flex flex-col">
                                        <span class="text-base text-gray-800 font-bold">{{ $epargne->nom_complet }}</span>
                                        <span class="text-xs text-gray-500">{{ $epargne->telephone }}</span>
                                    </div>
                                </th>
                                <td class="px-6 py-4 font-mono text-sm">{{ $epargne->numero_carte }}</td>
                                <td class="px-6 py-4 font-bold text-green-600">
                                    {{ number_format($epargne->solde_actuel, 0, ',', ' ') }} FC</td>
                                <td class="px-6 py-4">{{ number_format($epargne->montant_cible, 0, ',', ' ') }} FC</td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-2 py-1 rounded-full text-xs font-medium
                                        {{ $epargne->frequence_engagement == 'journalier' ? 'bg-blue-100 text-blue-700' : 'bg-purple-100 text-purple-700' }}">
                                        {{ ucfirst($epargne->frequence_engagement) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 flex items-center justify-end space-x-2">
                                    <button data-modal-target="depot-modal-{{ $epargne->id }}"
                                        data-modal-toggle="depot-modal-{{ $epargne->id }}"
                                        class="p-2 text-green-600 hover:text-white hover:bg-green-600 rounded-lg transition-all transform hover:scale-110">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                    </button>
                                    <button data-modal-target="retrait-modal-{{ $epargne->id }}"
                                        data-modal-toggle="retrait-modal-{{ $epargne->id }}"
                                        class="p-2 text-red-600 hover:text-white hover:bg-red-600 rounded-lg transition-all transform hover:scale-110">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 12H4" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-16 h-16 text-gray-200 mb-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        <p class="text-gray-400 text-lg font-medium">Aucun compte épargne</p>
                                        <p class="text-gray-300 text-sm">Créez le premier compte pour commencer</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Transactions récentes --}}
        @if ($transactionsRecentes->count() > 0)
            <div class="mt-8 bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-kzz-black">Transactions Récentes</h3>
                    <p class="text-gray-500 text-sm">Derniers mouvements sur les comptes épargne</p>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        @foreach ($transactionsRecentes as $transaction)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <div class="flex items-center space-x-4">
                                    <div
                                        class="p-2 rounded-full {{ $transaction->montant_depose > 0 ? 'bg-green-100' : 'bg-red-100' }}">
                                        <svg class="w-5 h-5 {{ $transaction->montant_depose > 0 ? 'text-green-600' : 'text-red-600' }}"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="{{ $transaction->montant_depose > 0 ? 'M12 4v16m8-8H4' : 'M20 12H4' }}" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $transaction->epargne->nom_complet }}
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            {{ $transaction->date_transaction->format('d/m/Y H:i') }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p
                                        class="font-bold {{ $transaction->montant_depose > 0 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $transaction->montant_depose > 0 ? '+' : '' }}{{ number_format($transaction->montant_depose, 0, ',', ' ') }}
                                        FC
                                    </p>
                                    <p class="text-xs text-gray-500">{{ $transaction->nom_deposant }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        {{-- Modals pour création et transactions --}}
        @include('finance.modals.epargne-modals')
    </div>
@endsection
