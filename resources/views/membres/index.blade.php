@extends('layouts.app')

@section('title', 'Gestion des Membres')

@section('content')
<section class="bg-kzz-gray p-3 sm:p-5 min-h-screen">
    <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
        
        <div class="mb-6 p-4 bg-white rounded-lg shadow-sm border-l-4 border-kzz-blue">
            <h1 class="text-xl font-bold text-kzz-black mb-2">Importance de nos membres</h1>
            <p class="text-gray-600 text-sm italic">
                Les membres sont le moteur de notre ONG. Leur engagement permet de concrétiser nos projets sur le terrain et d'assurer la pérennité de nos actions sociales.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="flex items-center p-4 bg-white rounded-lg shadow border border-gray-100">
                <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path></svg>
                </div>
                <div>
                    <p class="mb-1 text-sm font-medium text-gray-600">Total Membres</p>
                    <p class="text-lg font-semibold text-gray-700">{{ number_format($stats['total']) }}</p>
                </div>
            </div>
            <div class="flex items-center p-4 bg-white rounded-lg shadow border border-gray-100">
                <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path></svg>
                </div>
                <div>
                    <p class="mb-1 text-sm font-medium text-gray-600">Effectifs</p>
                    <p class="text-lg font-semibold text-gray-700">{{ number_format($stats['effectifs']) }}</p>
                </div>
            </div>
            <div class="flex items-center p-4 bg-white rounded-lg shadow border border-gray-100">
                <div class="p-3 mr-4 text-yellow-500 bg-yellow-100 rounded-full">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path></svg>
                </div>
                <div>
                    <p class="mb-1 text-sm font-medium text-gray-600">Sympathisants</p>
                    <p class="text-lg font-semibold text-gray-700">{{ number_format($stats['sympathisants']) }}</p>
                </div>
            </div>
            <div class="flex items-center p-4 bg-white rounded-lg shadow border border-gray-100">
                <div class="p-3 mr-4 text-purple-500 bg-purple-100 rounded-full">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a4 4 0 00-4 4v2H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-1V6a4 4 0 00-4-4zm-2 6V6a2 2 0 114 0v2H8z"></path></svg>
                </div>
                <div>
                    <p class="mb-1 text-sm font-medium text-gray-600">Honneurs</p>
                    <p class="text-lg font-semibold text-gray-700">{{ number_format($stats['honneurs']) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden border border-gray-100">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="w-full md:w-1/2">
                    <form action="{{ route('membres.index') }}" method="GET" class="flex items-center">
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" /></svg>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}" class="bg-gray-50 border border-gray-300 text-kzz-black text-sm rounded-lg focus:ring-kzz-blue focus:border-kzz-blue block w-full pl-10 p-2" placeholder="Rechercher par nom ou numéro...">
                        </div>
                    </form>
                </div>
                <div class="w-full md:w-auto">
                    <a href="{{ route('membres.create') }}" class="flex items-center justify-center text-white bg-kzz-green hover:bg-green-700 font-medium rounded-lg text-sm px-4 py-2 transition-all">
                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" /></svg>
                        Ajouter un membre
                    </a>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-white uppercase bg-kzz-blue font-title">
                        <tr>
                            <th scope="col" class="px-4 py-3">Nom Complet</th>
                            <th scope="col" class="px-4 py-3">Type Membre</th>
                            <th scope="col" class="px-4 py-3">Genre</th>
                            <th scope="col" class="px-4 py-3">Qualité / Fonction</th>
                            <th scope="col" class="px-4 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($membres as $membre)
                        <tr class="border-b hover:bg-gray-50 transition-colors">
                            <th scope="row" class="px-4 py-3 font-semibold text-kzz-black whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($membre->photo_membre)
                                        <img class="w-8 h-8 rounded-full mr-3 object-cover" src="{{ asset('storage/'.$membre->photo_membre) }}" alt="{{ $membre->nom_complet }}">
                                    @else
                                        <div class="w-8 h-8 rounded-full bg-blue-100 mr-3 flex items-center justify-center text-xs font-bold text-kzz-blue">
                                            {{ strtoupper(substr($membre->nom_complet, 0, 2)) }}
                                        </div>
                                    @endif
                                    <div class="flex flex-col">
                                        <span>{{ $membre->nom_complet }}</span>
                                        <span class="text-xs text-gray-400 font-normal">{{ $membre->numero_membre }}</span>
                                    </div>
                                </div>
                            </th>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 rounded-full text-xs font-medium 
                                    {{ $membre->type_membre == 'Membre effectif' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $membre->type_membre == 'Membre sympathisant' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $membre->type_membre == 'Membre d’honneur' ? 'bg-purple-100 text-purple-800' : '' }}">
                                    {{ $membre->type_membre }}
                                </span>
                            </td>
                            <td class="px-4 py-3">{{ $membre->genre }}</td>
                            <td class="px-4 py-3">
                                <span class="text-kzz-blue font-medium">{{ $membre->fonction }}</span>
                                @if($membre->qualite)
                                    <br><span class="text-xs text-gray-400 italic">{{ $membre->qualite }}</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 flex items-center justify-end space-x-2">
                                <a href="{{ route('membres.generateCard', $membre) }}" title="Voir la carte" class="p-1 text-gray-500 hover:text-blue-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" /></svg>
                                </a>
                                <a href="{{ route('membres.edit', $membre) }}" title="Modifier" class="p-1 text-gray-500 hover:text-yellow-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                </a>
                                <form action="{{ route('membres.destroy', $membre) }}" method="POST" onsubmit="return confirm('Supprimer définitivement ce membre ?')" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" title="Supprimer" class="p-1 text-gray-500 hover:text-red-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-4 py-10 text-center text-gray-400">
                                <p>Aucun membre trouvé pour le moment.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-gray-100">
                {{ $membres->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</section>
@endsection