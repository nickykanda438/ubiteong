@extends('layouts.app')

@section('title', 'Gestion des Documents KAZWAZWA')

@section('content')
<section class="bg-kzz-gray p-3 sm:p-5 min-h-screen">
    <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
        
        <div class="mb-6 p-4 bg-white rounded-lg shadow-sm border-l-4 border-kzz-blue">
            <h1 class="text-xl font-bold text-kzz-black mb-2">Centre de Documentation</h1>
            <p class="text-gray-600 text-sm italic">
                Retrouvez ici tous les documents officiels, rapports et ressources de l'ONG. Ces documents sont essentiels pour la transparence et le suivi de nos projets.
            </p>
        </div>

        <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden border border-gray-100 mb-6">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="w-full md:w-1/2">
                    <form action="{{ route('documents.index') }}" method="GET" class="flex items-center">
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" /></svg>
                            </div>
                            <input type="text" name="search" value="{{ $search ?? '' }}" 
                                class="bg-gray-50 border border-gray-300 text-kzz-black text-sm rounded-lg focus:ring-kzz-blue focus:border-kzz-blue block w-full pl-10 p-2" 
                                placeholder="Rechercher un titre, numéro ou type...">
                        </div>
                    </form>
                </div>
                <div class="w-full md:w-auto">
                    <button type="button" data-modal-target="add-document-modal" data-modal-toggle="add-document-modal" 
                        class="w-full flex items-center justify-center text-white bg-kzz-green hover:bg-green-700 font-medium rounded-lg text-sm px-4 py-2 transition-all">
                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" /></svg>
                        Nouveau Document
                    </button>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-white uppercase bg-kzz-blue font-title">
                        <tr>
                            <th scope="col" class="px-4 py-3">N° Doc</th>
                            <th scope="col" class="px-4 py-3">Titre</th>
                            <th scope="col" class="px-4 py-3">Type</th>
                            <th scope="col" class="px-4 py-3">Format</th>
                            <th scope="col" class="px-4 py-3">Date Insertion</th>
                            <th scope="col" class="px-4 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($documents as $doc)
                        <tr class="border-b hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3 font-semibold text-kzz-black">{{ $doc->numero_doc }}</td>
                            <td class="px-4 py-3">
                                <div class="flex flex-col">
                                    <span class="text-kzz-black font-medium">{{ $doc->titre }}</span>
                                    <span class="text-xs text-gray-400 italic">{{ Str::limit($doc->description, 50) }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3">{{ $doc->type_doc }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 rounded text-xs font-bold bg-blue-100 text-kzz-blue uppercase">
                                    {{ $doc->format }}
                                </span>
                            </td>
                            <td class="px-4 py-3">{{ \Carbon\Carbon::parse($doc->date_insertion)->format('d/m/Y') }}</td>
                            <td class="px-4 py-3 flex items-center justify-end space-x-3">
                                <a href="{{ route('documents.show', $doc) }}" target="_blank" title="Lire le document" class="text-gray-500 hover:text-kzz-green">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </a>
                                <a href="{{ route('documents.download', $doc) }}" title="Télécharger" class="text-gray-500 hover:text-kzz-blue">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-4 py-10 text-center text-gray-400 italic">
                                Aucun document trouvé.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-gray-100">
                {{ $documents->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</section>

<div id="add-document-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data" class="relative bg-white rounded-lg shadow dark:bg-gray-800">
            @csrf
            <div class="flex items-start justify-between p-4 border-b rounded-t bg-kzz-blue">
                <h3 class="text-xl font-semibold text-white">Enregistrer un Document</h3>
                <button type="button" class="text-white bg-transparent hover:bg-blue-800 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center" data-modal-hide="add-document-modal">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
                </button>
            </div>
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-1">
                        <label class="block mb-2 text-sm font-medium text-kzz-black">Numéro Document</label>
                        <input type="text" name="numero_doc" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-kzz-blue focus:border-kzz-blue block w-full p-2.5" required placeholder="Ex: KZZ-2024-001">
                    </div>
                    <div class="col-span-1">
                        <label class="block mb-2 text-sm font-medium text-kzz-black">Type</label>
                        <select name="type_doc" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-kzz-blue focus:border-kzz-blue block w-full p-2.5">
                            <option value="Rapport">Rapport</option>
                            <option value="Statuts">Statuts / Règlement</option>
                            <option value="Projet">Document de Projet</option>
                            <option value="Courrier">Courrier</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-kzz-black">Titre</label>
                    <input type="text" name="titre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-kzz-blue focus:border-kzz-blue block w-full p-2.5" required>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-kzz-black">Description</label>
                    <textarea name="description" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-kzz-blue focus:border-kzz-blue block w-full p-2.5" placeholder="Résumé du document..."></textarea>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-kzz-black">Fichier (Max 5Mo)</label>
                    <input type="file" name="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 p-1" required>
                </div>
            </div>
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                <button type="submit" class="text-white bg-kzz-green hover:bg-green-700 font-medium rounded-lg text-sm px-5 py-2.5">Enregistrer le document</button>
                <button data-modal-hide="add-document-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5">Annuler</button>
            </div>
        </form>
    </div>
</div>
@endsection