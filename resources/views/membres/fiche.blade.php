@extends('layouts.app')
@section('title', 'Fiche Membre - ' . $membre->nom_complet)

@section('content')
    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-4xl mx-auto px-4">

            <div class="flex justify-between items-center mb-6">
                <a href="{{ route('membres.index') }}" class="text-gray-600 hover:text-blue-600 flex items-center transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Retour à la liste
                </a>
                <div class="flex space-x-3">
                    <button onclick="window.print()"
                        class="bg-white border border-gray-300 px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-50 flex items-center shadow-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2z" />
                        </svg>
                        Imprimer la fiche
                    </button>
                    <a href="{{ route('membres.edit', $membre) }}"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 shadow-sm">
                        Modifier le profil
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">

                <div
                    class="h-32 {{ $membre->type_membre == 'Membre effectif' ? 'bg-green-600' : ($membre->type_membre == 'Membre d’honneur' ? 'bg-purple-600' : 'bg-blue-600') }}">
                </div>

                <div class="px-8 pb-8">
                    <div
                        class="relative -mt-16 flex flex-col md:flex-row items-end md:items-center space-y-4 md:space-y-0 md:space-x-6 mb-8">
                        <img src="{{ $membre->photo_url }}"
                            class="w-40 h-40 rounded-2xl object-cover border-4 border-white shadow-lg bg-white"
                            alt="{{ $membre->nom_complet }}">

                        <div class="flex-1">
                            <div class="flex items-center space-x-3">
                                <h1 class="text-3xl font-black text-gray-900">{{ $membre->nom_complet }}</h1>
                                <span
                                    class="px-3 py-1 bg-gray-100 text-gray-600 text-xs font-bold rounded-full uppercase tracking-widest">
                                    {{ $membre->numero_membre }}
                                </span>
                            </div>
                            <p class="text-blue-600 font-bold text-lg">{{ $membre->fonction }}</p>
                            <div
                                class="mt-2 inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-opacity-10 
                            {{ $membre->type_membre == 'Membre effectif' ? 'bg-green-600 text-green-700' : 'bg-blue-600 text-blue-700' }}">
                                {{ $membre->type_membre }}
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                        <div class="space-y-6">
                            <h2 class="text-sm font-black text-gray-400 uppercase tracking-widest border-b pb-2">
                                Informations Personnelles</h2>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs text-gray-400">Date de naissance</label>
                                    <p class="text-gray-800 font-semibold">{{ $membre->date_naissance->format('d/m/Y') }}
                                    </p>
                                </div>
                                <div>
                                    <label class="block text-xs text-gray-400">Lieu de naissance</label>
                                    <p class="text-gray-800 font-semibold">{{ $membre->lieu_naissance ?? 'Non renseigné' }}
                                    </p>
                                </div>
                                <div>
                                    <label class="block text-xs text-gray-400">Genre</label>
                                    <p class="text-gray-800 font-semibold">{{ $membre->genre }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs text-gray-400">Profession</label>
                                    <p class="text-gray-800 font-semibold">{{ $membre->profession ?? 'N/A' }}</p>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs text-gray-400">Adresse complète</label>
                                <p class="text-gray-800 font-semibold leading-relaxed">
                                    {{ $membre->adresse_membre }}
                                </p>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <h2 class="text-sm font-black text-gray-400 uppercase tracking-widest border-b pb-2">Détails
                                Administratifs</h2>

                            <div class="space-y-4">
                                <div class="flex items-start space-x-3">
                                    <div class="p-2 bg-blue-50 rounded-lg text-blue-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-400">Date d'adhésion</label>
                                        <p class="text-gray-800 font-bold">
                                            {{ $membre->date_adhesion ? $membre->date_adhesion->format('d F Y') : 'Non définie' }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-start space-x-3">
                                    <div class="p-2 bg-green-50 rounded-lg text-green-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-400">Ancienneté</label>
                                        <p class="text-gray-800 font-bold">{{ $membre->anciennete ?? 'Non définie' }}</p>
                                    </div>
                                </div>

                                <div class="flex items-start space-x-3">
                                    <div class="p-2 bg-yellow-50 rounded-lg text-yellow-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <label class="block text-xs text-gray-400">Qualité / Titre</label>
                                        <p class="text-gray-800 font-bold">{{ $membre->qualite ?? 'Membre standard' }}</p>
                                    </div>
                                </div>

                                @if ($membre->piece_jointe)
                                    <div class="mt-6 p-4 bg-gray-50 rounded-xl border border-dashed border-gray-200">
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm text-gray-600 font-medium">Document d'identité</span>
                                            <a href="{{ asset('storage/' . $membre->piece_jointe) }}" target="_blank"
                                                class="text-blue-600 text-sm font-bold hover:underline">Voir le fichier</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

                <div class="bg-gray-50 px-8 py-4 border-t border-gray-100 flex justify-between items-center">
                    <span class="text-xs text-gray-400 italic font-light italic">Dernière mise à jour :
                        {{ $membre->updated_at->format('d/m/Y H:i') }}</span>
                    <span class="text-xs font-bold text-gray-300">KAZWAZWA ONG</span>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media print {

            .no-print,
            nav,
            button,
            a {
                display: none !important;
            }

            .bg-gray-50 {
                background-color: white !important;
            }

            .shadow-xl {
                box-shadow: none !important;
                border: 1px solid #eee;
            }
        }
    </style>
@endsection
