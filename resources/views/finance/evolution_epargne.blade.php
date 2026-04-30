@extends('layouts.app')

@section('content')
    <div class="p-6 bg-white min-h-screen" id="printableArea">
        {{-- Header : Masqué à l'impression si besoin, ou gardé pour le logo --}}
        <div class="flex justify-between items-center mb-8 border-b pb-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Évolution de l'Épargne</h1>
                <p class="text-gray-600">Client : <strong>{{ $epargne->nom_complet }}</strong> | Carte :
                    <code>{{ $epargne->numero_carte }}</code></p>
            </div>
            <button onclick="window.print()" class="bg-kzz-blue text-white px-4 py-2 rounded-lg shadow no-print">
                Imprimer l'historique
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Section Calendrier (Pointage) --}}
            <div class="lg:col-span-1 bg-gray-50 p-4 rounded-xl border">
                <h3 class="font-bold mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" />
                    </svg>
                    Pointage des dépôts (Mois en cours)
                </h3>
                <div class="grid grid-cols-7 gap-2 text-center text-xs">
                    @foreach (['L', 'M', 'M', 'J', 'V', 'S', 'D'] as $jour)
                        <div class="font-bold text-gray-400">{{ $jour }}</div>
                    @endforeach

                    {{-- Logique PHP pour générer les jours --}}
                    @for ($i = 1; $i <= $daysInMonth; $i++)
                        @php
                            $hasDeposited = collect($transactions)->contains(
                                'date',
                                $currentYearMonth . '-' . sprintf('%02d', $i),
                            );
                        @endphp
                        <div
                            class="h-8 w-8 flex items-center justify-center rounded-full border 
                        {{ $hasDeposited ? 'bg-green-500 text-white border-green-600 font-bold' : 'bg-white text-gray-300' }}">
                            {{ $i }}
                        </div>
                    @endfor
                </div>
            </div>

            {{-- Section Historique --}}
            <div class="lg:col-span-2 shadow-sm border rounded-xl overflow-hidden">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-3">Date</th>
                            <th class="px-4 py-3">Type</th>
                            <th class="px-4 py-3 text-right">Montant</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach ($historique as $mouvement)
                            <tr>
                                <td class="px-4 py-3">{{ date('d/m/Y H:i', strtotime($mouvement->created_at)) }}</td>
                                <td class="px-4 py-3">
                                    <span
                                        class="{{ $mouvement->type == 'depot' ? 'text-green-600' : 'text-red-600' }} font-medium">
                                        {{ ucfirst($mouvement->type) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-right font-mono">
                                    {{ number_format($mouvement->montant, 0, ',', ' ') }} FC
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            body {
                background: white;
            }

            .shadow-xl,
            .rounded-2xl {
                box-shadow: none !important;
                border: 1px solid #ddd !important;
            }
        }
    </style>
@endsection
