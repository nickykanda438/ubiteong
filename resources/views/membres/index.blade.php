@extends('layouts.app')

@section('title', 'Liste des Membres')

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-kzz-black uppercase">Liste des Membres</h1>
        <p class="text-sm text-gray-500 font-sans">Gestion des adhérents de la Fondation KAZWAZWA</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 text-gray-600 uppercase text-[11px] font-bold">
                <tr>
                    <th class="px-6 py-4">Nom Complet</th>
                    <th class="px-6 py-4">Type</th>
                    <th class="px-6 py-4">Genre</th>
                    <th class="px-6 py-4">Qualité</th>
                    <th class="px-6 py-4 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-bold text-kzz-black">Nicky (Exemple)</td>
                    <td class="px-6 py-4 text-gray-600">Effectif</td>
                    <td class="px-6 py-4 text-gray-600">Masculin</td>
                    <td class="px-6 py-4 text-gray-600">Membre d'honneur</td>
                    <td class="px-6 py-4 text-center">
                        <button class="text-kzz-blue font-bold">Voir</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection