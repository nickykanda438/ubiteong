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
                    <div class="flex justify-between items-center">
                        <span class="text-xs font-bold text-gray-400 uppercase">Montant Principal</span>
                        <span class="font-mono text-lg font-bold text-gray-700">
                            {{ number_format($credit->montant_principal, 0, ',', ' ') }} {{ $credit->devise }}
                        </span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-xs font-bold text-gray-400 uppercase">Intérêts (Cumulés)</span>
                        @php
                            $total_interets = $credit->montant_principal * 0.2; // Exemple base 1 mois
                        @endphp
                        <span class="font-mono text-lg font-bold text-gray-700">
                            + {{ number_format($total_interets, 0, ',', ' ') }} {{ $credit->devise }}
                        </span>
                    </div>

                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg border-l-4 border-kzz-blue">
                        <span class="text-xs font-black text-kzz-blue uppercase">Total à Rembourser</span>
                        <span class="font-mono text-xl font-black text-kzz-blue">
                            {{ number_format($credit->montant_principal + $total_interets, 0, ',', ' ') }}
                            {{ $credit->devise }}
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
                        <p class="font-bold text-red-600">
                            {{ \Carbon\Carbon::parse($credit->date_echeance_finale)->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 font-bold uppercase mb-1">Statut Dossier</p>
                        <span class="px-2 py-0.5 rounded bg-gray-900 text-white font-black text-[10px]">
                            {{ strtoupper($credit->statut) }}
                        </span>
                    </div>
                    <div class="text-right">
                        <p class="text-gray-400 font-bold uppercase mb-1">Reste à payer</p>
                        <p class="font-mono font-black text-orange-600">
                            {{ number_format($credit->reste_a_payer, 0, ',', ' ') }} {{ $credit->devise }}</p>
                    </div>
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
