@extends('layouts.app')

@section('title', 'Gestion des Documents KAZWAZWA')

@section('content')
<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
    <div class="w-full mb-1">
        <div class="mb-4">
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Gestion des Documents - KAZWAZWA</h1>
        </div>
        <div class="items-center justify-between block sm:flex md:divide-x md:divide-gray-100 dark:divide-gray-700">
            <form action="{{ route('documents.index') }}" method="GET" class="flex items-center mb-3 sm:mb-0">
                <label for="documents-search" class="sr-only">Rechercher</label>
                <div class="relative mt-1 lg:w-64 xl:w-96">
                    <input type="text" name="search" id="documents-search" value="{{ $search ?? '' }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" 
                        placeholder="Rechercher par titre, N° ou type...">
                </div>
            </form>
            
            <button type="button" data-modal-target="add-document-modal" data-modal-toggle="add-document-modal"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none">
                + Nouveau Document
            </button>
        </div>
    </div>
</div>

<div class="flex flex-col">
    <div class="overflow-x-auto">
        <div class="inline-block min-w-full align-middle">
            <div class="overflow-hidden shadow">
                <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">N° Doc</th>
                            <th class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">Type</th>
                            <th class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">Titre</th>
                            <th class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">Format</th>
                            <th class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">Date Insertion</th>
                            <th class="p-4 text-xs font-medium text-center text-gray-500 uppercase dark:text-gray-400">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        @forelse($documents as $doc)
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $doc->numero_doc }}</td>
                            <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $doc->type_doc }}</td>
                            <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                <div class="text-base font-semibold text-gray-900 dark:text-white">{{ $doc->titre }}</div>
                                <div class="text-xs text-gray-500">{{ Str::limit($doc->description, 40) }}</div>
                            </td>
                            <td class="p-4 whitespace-nowrap">
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 uppercase">
                                    {{ $doc->format }}
                                </span>
                            </td>
                            <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ \Carbon\Carbon::parse($doc->date_insertion)->format('d/m/Y') }}
                            </td>
                            <td class="p-4 space-x-2 whitespace-nowrap text-center">
                                <a href="{{ route('documents.show', $doc) }}" target="_blank" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-300">
                                    Lire
                                </a>
                                <a href="{{ route('documents.download', $doc) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                                    Télécharger
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-10 text-center text-gray-500">Aucun document trouvé.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="p-4">
    {{ $documents->links() }}
</div>

<div id="add-document-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data" class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            @csrf
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Ajouter un nouveau document</h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="add-document-modal">
                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
                </button>
            </div>
            <div class="p-6 space-y-6">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">N° Document</label>
                        <input type="text" name="numero_doc" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type Document</label>
                        <select name="type_doc" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                            <option value="Rapport">Rapport</option>
                            <option value="Statuts">Statuts</option>
                            <option value="Projet">Projet</option>
                            <option value="Autre">Autre</option>
                        </select>
                    </div>
                    <div class="col-span-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Titre du document</label>
                        <input type="text" name="titre" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>
                    <div class="col-span-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <textarea name="description" rows="3" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"></textarea>
                    </div>
                    <div class="col-span-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fichier (PDF, DOC, Image)</label>
                        <input type="file" name="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400" required>
                    </div>
                </div>
            </div>
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Enregistrer</button>
            </div>
        </form>
    </div>
</div>
@endsection