@extends('layouts.app')

@section('title', 'Détails du Crédit')

@section('content')
    <div class="p-6 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-md overflow-hidden p-6 border border-gray-200">
            <h1 class="text-2xl font-bold text-gray-800 mb-4">Détails du Crédit #{{ $credit->id }}</h1>

            <div class="grid grid-cols-2 gap-4">
                <div class="p-4 bg-gray-100 rounded-lg">
                    <p class="text-sm text-gray-500">Membre</p>
                    <p class="text-lg font-bold">{{ $credit->membre->nom_complet }}</p>
                </div>
                <div class="p-4 bg-gray-100 rounded-lg">
                    <p class="text-sm text-gray-500">Statut actuel</p>
                    <span
                        class="px-2 py-1 rounded text-white font-bold {{ $credit->statut == 'solde' ? 'bg-green-500' : 'bg-blue-500' }}">
                        {{ strtoupper($credit->statut) }}
                    </span>
                </div>
                <div class="p-4 border border-blue-200 rounded-lg">
                    <p class="text-sm text-gray-500">Montant Principal</p>
                    <p class="text-xl font-black">{{ number_format($credit->montant_principal, 0, ',', ' ') }} FC</p>
                </div>
                <div class="p-4 border border-orange-200 rounded-lg">
                    <p class="text-sm text-gray-500">Reste à payer</p>
                    <p class="text-xl font-black text-orange-600">{{ number_format($credit->reste_a_payer, 0, ',', ' ') }}
                        FC</p>
                </div>
            </div>

            <div class="mt-8">
                <a href="{{ route('finance.credit') }}" class="text-kzz-blue hover:underline font-bold">
                    ← Retour à la liste
                </a>
            </div>
        </div>
    </div>
@endsection
