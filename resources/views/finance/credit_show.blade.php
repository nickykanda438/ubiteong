@extends('layouts.app')

@section('title', 'Reçu de Crédit')

@section('content')
    <div class="p-8 bg-gray-100 min-h-screen flex flex-col items-center">

        <div class="w-full max-w-md mb-4 text-left">
            <a href="{{ route('finance.credit') }}"
                class="inline-flex items-center text-xs font-bold text-gray-500 hover:text-kzz-blue transition-colors">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M15 19l-7-7 7-7"></path>
                </svg>
                RETOUR À LA LISTE
            </a>
        </div>

        <div class="relative w-full max-w-md bg-white shadow-2xl rounded-t-xl overflow-hidden">

            <div class="bg-kzz-blue p-6 text-center text-white relative">
                <div class="absolute -bottom-3 left-0 right-0 flex justify-center">
                    <div class="w-6 h-6 bg-white rounded-full"></div>
                </div>
                <h2 class="text-xs font-black tracking-widest uppercase opacity-80 mb-1">Reçu d'Octroi</h2>
                <p class="text-3xl font-black italic font-title uppercase">FLUXRH FINANCE</p>
            </div>

            <div class="p-8 pt-10 space-y-6">

                <div class="text-center pb-6 border-b border-dashed border-gray-300">
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">Bénéficiaire</p>
                    <h3 class="text-xl font-extrabold text-gray-800 leading-tight uppercase">
                        {{ $credit->membre->nom_complet }}</h3>
                    <p class="text-xs text-gray-500 mt-1 italic">ID Membre :
                        #{{ str_pad($credit->membre_id, 5, '0', STR_PAD_LEFT) }}</p>
                </div>

                <div class="space-y-4 py-4">
                    @php
                        $paiement_mensuel = $credit->paiement_mensuel;
                        $penalite_retard = $credit->interet_total;
                        $montant_total_du = $credit->montant_total_du;
                    @endphp

                    <div class="flex justify-between items-center">
                        <span class="text-xs font-bold text-gray-400 uppercase">Montant Principal</span>
                        <span class="font-mono text-lg font-bold text-gray-700">
                            {{ number_format($credit->montant_principal, 0, ',', ' ') }} {{ $credit->devise }}
                        </span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-xs font-bold text-gray-400 uppercase">Paiement mensuel fixe</span>
                        <span class="font-mono text-lg font-bold text-blue-700">
                            {{ number_format($paiement_mensuel, 0, ',', ' ') }} {{ $credit->devise }}
                        </span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-xs font-bold text-gray-400 uppercase">Pénalité de retard</span>
                        <span
                            class="font-mono text-lg font-bold {{ $credit->estEnDepassement() ? 'text-red-600' : 'text-gray-700' }}">
                            @if ($penalite_retard > 0)
                                + {{ number_format($penalite_retard, 0, ',', ' ') }} {{ $credit->devise }}
                            @else
                                Aucun
                            @endif
                        </span>
                    </div>

                    <div
                        class="flex justify-between items-center p-3 bg-gray-50 rounded-lg border-l-4 {{ $credit->estEnDepassement() ? 'border-red-500' : 'border-kzz-blue' }}">
                        <span
                            class="text-xs font-black {{ $credit->estEnDepassement() ? 'text-red-600' : 'text-kzz-blue' }} uppercase">
                            Total à Rembourser
                            @if ($credit->estEnDepassement())
                                <span class="text-xs font-bold">(Pénalité 40%)</span>
                            @endif
                        </span>
                        <span
                            class="font-mono text-xl font-black {{ $credit->estEnDepassement() ? 'text-red-600' : 'text-kzz-blue' }}">
                            {{ number_format($montant_total_du, 0, ',', ' ') }} {{ $credit->devise }}
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 text-xs pt-4 border-t border-dashed border-gray-300">
                    <div>
                        <p class="text-gray-400 font-bold uppercase mb-1">Date Déblocage</p>
                        <p class="font-bold text-gray-700">
                            {{ \Carbon\Carbon::parse($credit->date_deblocage)->format('d/m/Y') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-gray-400 font-bold uppercase mb-1">Échéance Finale</p>
                        <p class="font-bold {{ $credit->estEnDepassement() ? 'text-red-600' : 'text-gray-700' }}">
                            {{ \Carbon\Carbon::parse($credit->date_echeance_finale)->format('d/m/Y') }}
                            @if ($credit->estEnDepassement())
                                <span class="text-xs text-red-500 font-bold">(EXPIRÉ)</span>
                            @endif
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-400 font-bold uppercase mb-1">Statut Dossier</p>
                        <span
                            class="px-2 py-0.5 rounded font-black text-[10px] {{ $credit->statut_actuel === 'en_retard' ? 'bg-red-100 text-red-800' : ($credit->statut_actuel === 'solde' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800') }}">
                            {{ strtoupper(str_replace('_', ' ', $credit->statut_actuel)) }}
                        </span>
                    </div>
                    <div class="text-right">
                        <p class="text-gray-400 font-bold uppercase mb-1">Reste à payer</p>
                        <p
                            class="font-mono font-black {{ $credit->reste_a_payer > 0 ? 'text-orange-600' : 'text-green-600' }}">
                            {{ number_format($credit->reste_a_payer, 0, ',', ' ') }} {{ $credit->devise }}</p>
                    </div>
                </div>

                {{-- Conditions du Crédit --}}
                <div class="mt-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                    <h4 class="text-xs font-black text-blue-800 uppercase mb-3 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Conditions Applicables
                    </h4>
                    <div class="space-y-2 text-xs">
                        <div class="flex items-start">
                            <span class="text-blue-600 mr-2">•</span>
                            <span class="text-blue-700">Durée maximale : <strong>6 mois</strong> à compter de la date de
                                déblocage</span>
                        </div>
                        <div class="flex items-start">
                            <span class="text-blue-600 mr-2">•</span>
                            <span class="text-blue-700">Paiement mensuel fixe : <strong>20% du capital</strong></span>
                        </div>
                        <div class="flex items-start">
                            <span class="text-red-600 mr-2">•</span>
                            <span class="text-red-700">Pénalité de retard : <strong>40% du capital</strong></span>
                        </div>
                        @if ($credit->estEnDepassement())
                            <div class="mt-3 p-2 bg-red-100 rounded border border-red-300">
                                <span class="text-red-800 font-bold text-xs">⚠️ RETARD DÉTECTÉ : </span>
                                <span class="text-red-700 text-xs">La pénalité de 40% est appliquée sur le capital</span>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Historique des Remboursements --}}
                <div class="mt-6 p-4 bg-emerald-50 rounded-lg border border-emerald-200">
                    <h4 class="text-xs font-black text-emerald-800 uppercase mb-4 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Historique des Remboursements
                    </h4>

                    @if ($credit->remboursements->count() > 0)
                        <div class="space-y-3">
                            @foreach ($credit->remboursements->sortByDesc('date_paiement') as $remboursement)
                                <div
                                    class="flex items-center justify-between p-3 bg-white rounded-lg border border-emerald-100">
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-3">
                                            <div
                                                class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center">
                                                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-bold text-gray-900">
                                                    {{ number_format($remboursement->montant_paye, 0, ',', ' ') }}
                                                    {{ $credit->devise }}
                                                </p>
                                                <p class="text-xs text-gray-500">
                                                    {{ \Carbon\Carbon::parse($remboursement->date_paiement)->format('d/m/Y') }}
                                                    • {{ $remboursement->mode_paiement }}
                                                    @if ($remboursement->commentaire)
                                                        • {{ Str::limit($remboursement->commentaire, 30) }}
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-xs text-gray-500">Reste après</span>
                                        <p class="text-sm font-bold text-emerald-700">
                                            {{ number_format($remboursement->reste_apres, 0, ',', ' ') }}
                                            {{ $credit->devise }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4 pt-3 border-t border-emerald-200">
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-bold text-emerald-800">Total remboursé :</span>
                                <span class="text-lg font-black text-emerald-800">
                                    {{ number_format($credit->remboursements->sum('montant_paye'), 0, ',', ' ') }}
                                    {{ $credit->devise }}
                                </span>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 text-emerald-300 mx-auto mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            <p class="text-sm text-emerald-600 font-medium">Aucun remboursement effectué</p>
                            <p class="text-xs text-emerald-500 mt-1">L'historique des paiements apparaîtra ici une fois les
                                premiers versements effectués.</p>
                        </div>
                    @endif
                </div>

                <div class="flex flex-col items-center justify-center pt-6 opacity-30">
                    <div
                        class="w-full h-12 bg-[repeating-linear-gradient(90deg,black,black_2px,transparent_2px,transparent_4px)]">
                    </div>
                    <p class="text-[10px] font-mono mt-2 tracking-widest uppercase">
                        CR-{{ $credit->id }}-{{ date('Y') }}</p>
                </div>
            </div>

            <div class="w-full">
                <svg class="fill-current text-white" viewBox="0 0 100 10" preserveAspectRatio="none">
                    <polygon
                        points="0,0 5,10 10,0 15,10 20,0 25,10 30,0 35,10 40,0 45,10 50,0 55,10 60,0 65,10 70,0 75,10 80,0 85,10 90,0 95,10 100,0 100,10 0,10" />
                </svg>
            </div>
        </div>

        <div class="mt-8 flex space-x-4">
            <button onclick="window.print()"
                class="px-6 py-2 bg-gray-900 text-white rounded-xl font-bold text-sm hover:bg-black transition shadow-lg flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                    </path>
                </svg>
                IMPRIMER LE REÇU
            </button>
        </div>
    </div>

    <style>
        @media print {
            body * {
                visibility: hidden;
                background: white !important;
            }

            .relative.w-full.max-w-md,
            .relative.w-full.max-w-md * {
                visibility: visible;
            }

            .relative.w-full.max-w-md {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                box-shadow: none !important;
            }

            .mt-8 {
                display: none;
            }
        }

        /* Police monospacée pour l'aspect financier */
        .font-mono {
            font-family: 'Courier New', Courier, monospace;
        }
    </style>
@endsection
