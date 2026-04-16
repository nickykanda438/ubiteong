@extends('layouts.app')

@section('title', 'Gestion des finances')

@section('content')
    <div class="p-4 bg-kzz-gray min-h-screen">
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-title font-bold text-kzz-blue uppercase tracking-tight">Tableau de Bord Financier
                </h1>
                <p class="text-kzz-black opacity-70 font-sans">Suivi des flux, crédits et épargnes des membres.</p>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('finance.credit') }}"
                    class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-kzz-blue rounded-lg hover:bg-opacity-90 focus:ring-4 focus:outline-none focus:ring-blue-300 transition transform hover:scale-105">
                    <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Octroyer un Crédit
                </a>
                <button type="button"
                    class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-kzz-green rounded-lg hover:bg-opacity-90 focus:ring-4 focus:outline-none focus:ring-green-300 transition transform hover:scale-105">
                    <svg class="w-5 h-5 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                    Enregistrer une Épargne
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="p-5 bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-gray-500 uppercase font-sans">Total Épargnes</span>
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

            <div class="p-5 bg-white rounded-2xl border border-gray-200 shadow-sm">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-gray-500 uppercase font-sans">Crédits Octroyés</span>
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <svg class="w-6 h-6 text-kzz-blue" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.363.242.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z">
                            </path>
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.692C6.603 6.265 6 7.058 6 8s.603 1.735 1.324 2.216A4.535 4.535 0 009 10.908V13.09c-.724-.48-1.324-1.273-1.324-2.215a1 1 0 10-2 0c0 1.886 1.21 3.483 2.9 4.102V16a1 1 0 102 0v-.092c1.69-.619 2.9-2.216 2.9-4.102 0-.942-.603-1.735-1.324-2.216A4.535 4.535 0 0011 8.908V6.91c.724.48 1.324 1.273 1.324 2.215a1 1 0 102 0c0-1.886-1.21-3.483-2.9-4.102V5z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
                <div class="text-2xl font-bold text-kzz-black">
                    {{ number_format($statsCredits['total_octroye'], 0, ',', ' ') }} FC</div>
                <p class="text-xs text-gray-500 mt-1">Volume global prêté</p>
            </div>

            <div class="p-5 bg-white rounded-2xl border border-gray-200 shadow-sm">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-gray-500 uppercase font-sans">Reste à Recouvrer</span>
                    <div class="p-2 bg-orange-100 rounded-lg">
                        <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="text-2xl font-bold text-kzz-black">
                    {{ number_format($statsCredits['total_restant'], 0, ',', ' ') }} FC</div>
                <p class="text-xs text-orange-600 font-medium mt-1 italic italic">Créances actives</p>
            </div>

            <div class="p-5 bg-white rounded-2xl border border-red-100 shadow-sm bg-red-50/30">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-medium text-red-700 uppercase font-sans font-bold">Cas de Retards</span>
                    <div class="p-2 bg-red-100 rounded-lg animate-pulse">
                        <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
                <div class="text-2xl font-bold text-red-700">{{ $statsCredits['nb_en_retard'] }} dossiers</div>
                <a href="{{ route('finance.credits.retard') }}"
                    class="text-xs text-red-600 underline hover:text-red-800 font-bold mt-1 block">Voir la liste noire</a>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-4 border-b border-gray-50 flex justify-between items-center bg-kzz-blue/5">
                    <h3 class="font-title font-bold text-kzz-blue uppercase text-sm tracking-widest">Derniers Crédits
                        Accordés</h3>
                    <span class="bg-blue-100 text-kzz-blue text-[10px] font-bold px-2.5 py-0.5 rounded-full">TOP 10</span>
                </div>
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 font-sans">
                            <tr>
                                <th class="px-6 py-3">Membre</th>
                                <th class="px-6 py-3 text-right">Principal</th>
                                <th class="px-6 py-3 text-center">Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($creditsRecents as $credit)
                                <tr class="bg-white border-b hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 font-medium text-kzz-black">{{ $credit->membre->nom_complet }}</td>
                                    <td class="px-6 py-4 text-right font-bold">
                                        {{ number_format($credit->montant_principal, 0, ',', ' ') }} FCFA</td>
                                    <td class="px-6 py-4 text-center">
                                        @if ($credit->statut == 'solde')
                                            <span
                                                class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full font-bold uppercase">Soldé</span>
                                        @else
                                            <span
                                                class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full font-bold uppercase">En
                                                cours</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-10 text-center italic opacity-50">Aucune donnée crédit
                                        disponible</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-4 border-b border-gray-50 flex justify-between items-center bg-kzz-green/5">
                    <h3 class="font-title font-bold text-kzz-green uppercase text-sm tracking-widest text-green-700">Flux
                        d'épargne (Dépôts)</h3>
                    <span
                        class="bg-green-100 text-green-700 text-[10px] font-bold px-2.5 py-0.5 rounded-full">Récents</span>
                </div>
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 font-sans">
                            <tr>
                                <th class="px-6 py-3">Membre</th>
                                <th class="px-6 py-3 text-right">Montant</th>
                                <th class="px-6 py-3 text-center">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($deposits as $deposit)
                                <tr class="bg-white border-b hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 font-medium text-kzz-black">{{ $deposit->membre->nom_complet }}
                                    </td>
                                    <td class="px-6 py-4 text-right font-bold text-kzz-green">+
                                        {{ number_format($deposit->montant, 0, ',', ' ') }} FCFA</td>
                                    <td class="px-6 py-4 text-center text-xs italic">
                                        {{ $deposit->created_at->format('d/m/Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-10 text-center italic opacity-50 text-kzz-black">
                                        Aucun dépôt enregistré récemment</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
