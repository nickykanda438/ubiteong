@extends('layouts.app')

@section('title', 'Gestion des Membres KAZWAZWA')

@section('content')
<section class="bg-kzz-gray min-h-screen font-sans">
    <div class="relative h-80 w-full flex flex-col items-center justify-center text-center px-4 overflow-hidden shadow-inner bg-blue-900">
        <img src="https://images.unsplash.com/photo-1529070538774-1843cb3265df?auto=format&fit=crop&q=80" 
             class="absolute inset-0 w-full h-full object-cover brightness-[0.3] scale-105" alt="Background Membres">
        
        <div class="relative z-10">
            <h1 class="text-3xl md:text-5xl font-bold text-white mb-3 font-title tracking-tight uppercase">Annuaire des Membres</h1>
            <p class="text-white/90 text-lg font-light italic max-w-3xl leading-relaxed">
                "Les membres sont le moteur de notre ONG. Leur engagement permet de concrétiser nos projets sur le terrain et d'assurer la pérennité de nos actions sociales."
            </p>
        </div>
    </div>

    <div class="mx-auto max-w-screen-xl px-4 lg:px-12 -mt-16 relative z-20 pb-20">
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="flex items-center p-5 bg-white rounded-xl shadow-lg border-b-4 border-blue-500 transition-transform hover:-translate-y-1">
                <div class="p-3 mr-4 text-blue-500 bg-blue-50 rounded-lg">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path></svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Membres</p>
                    <p class="text-2xl font-black text-gray-800">{{ number_format($stats['total']) }}</p>
                </div>
            </div>
            
            <div class="flex items-center p-5 bg-white rounded-xl shadow-lg border-b-4 border-green-500 transition-transform hover:-translate-y-1">
                <div class="p-3 mr-4 text-green-500 bg-green-50 rounded-lg">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path></svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Effectifs</p>
                    <p class="text-2xl font-black text-gray-800">{{ number_format($stats['effectifs']) }}</p>
                </div>
            </div>

            <div class="flex items-center p-5 bg-white rounded-xl shadow-lg border-b-4 border-yellow-500 transition-transform hover:-translate-y-1">
                <div class="p-3 mr-4 text-yellow-500 bg-yellow-50 rounded-lg">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path></svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Sympathisants</p>
                    <p class="text-2xl font-black text-gray-800">{{ number_format($stats['sympathisants']) }}</p>
                </div>
            </div>

            <div class="flex items-center p-5 bg-white rounded-xl shadow-lg border-b-4 border-purple-500 transition-transform hover:-translate-y-1">
                <div class="p-3 mr-4 text-purple-500 bg-purple-50 rounded-lg">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a4 4 0 00-4 4v2H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-1V6a4 4 0 00-4-4zm-2 6V6a2 2 0 114 0v2H8z"></path></svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Honneurs</p>
                    <p class="text-2xl font-black text-gray-800">{{ number_format($stats['honneurs']) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white relative shadow-xl rounded-2xl overflow-hidden border border-gray-100">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-6 bg-white">
                <div class="w-full md:w-1/2">
                    <form action="{{ route('membres.index') }}" method="GET" class="flex items-center">
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" /></svg>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}" 
                                class="bg-gray-50 border border-gray-200 text-kzz-black text-sm rounded-xl focus:ring-kzz-blue focus:border-kzz-blue block w-full pl-11 p-3.5" 
                                placeholder="Rechercher un membre par nom, matricule...">
                        </div>
                    </form>
                </div>
                <div class="w-full md:w-auto">
                    <a href="{{ route('membres.create') }}" 
                        class="w-full flex items-center justify-center text-white bg-kzz-green hover:bg-green-700 font-bold rounded-xl text-sm px-6 py-3.5 transition-all shadow-md">
                        <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" /></svg>
                        AJOUTER UN MEMBRE
                    </a>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-white uppercase bg-kzz-blue font-title tracking-widest">
                        <tr>
                            <th scope="col" class="px-6 py-4">Identité & Matricule</th>
                            <th scope="col" class="px-6 py-4">Catégorie</th>
                            <th scope="col" class="px-6 py-4 text-center">Genre</th>
                            <th scope="col" class="px-6 py-4">Fonction / Qualité</th>
                            <th scope="col" class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($membres as $membre)
                        <tr class="bg-white hover:bg-blue-50/40 transition-colors">
                            <th scope="row" class="px-6 py-4 font-semibold text-kzz-black whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($membre->photo_membre)
                                        <img class="w-10 h-10 rounded-full mr-3 object-cover ring-2 ring-gray-100" src="{{ asset('storage/'.$membre->photo_membre) }}" alt="{{ $membre->nom_complet }}">
                                    @else
                                        <div class="w-10 h-10 rounded-full bg-blue-100 mr-3 flex items-center justify-center text-xs font-black text-kzz-blue ring-2 ring-blue-50">
                                            {{ strtoupper(substr($membre->nom_complet, 0, 2)) }}
                                        </div>
                                    @endif
                                    <div class="flex flex-col">
                                        <span class="text-base text-kzz-black font-bold tracking-tight">{{ $membre->nom_complet }}</span>
                                        <span class="text-[10px] text-gray-400 font-mono uppercase tracking-tighter">{{ $membre->numero_membre }}</span>
                                    </div>
                                </div>
                            </th>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wide
                                    {{ $membre->type_membre == 'Membre effectif' ? 'bg-green-100 text-green-700 border border-green-200' : '' }}
                                    {{ $membre->type_membre == 'Membre sympathisant' ? 'bg-yellow-100 text-yellow-700 border border-yellow-200' : '' }}
                                    {{ $membre->type_membre == 'Membre d’honneur' ? 'bg-purple-100 text-purple-700 border border-purple-200' : '' }}">
                                    {{ $membre->type_membre }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center font-medium text-gray-600">{{ $membre->genre }}</td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="text-kzz-blue font-bold">{{ $membre->fonction }}</span>
                                    @if($membre->qualite)
                                        <span class="text-xs text-gray-400 italic font-light">{{ $membre->qualite }}</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 flex items-center justify-end space-x-3 mt-2">
                                <a href="{{ route('membres.generateCard', $membre) }}" title="Générer Carte QR" class="p-2 text-gray-400 hover:text-kzz-blue hover:bg-blue-50 rounded-lg transition-all">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" /></svg>
                                </a>
                                <a href="{{ route('membres.edit', $membre) }}" title="Modifier" class="p-2 text-gray-400 hover:text-yellow-600 hover:bg-yellow-50 rounded-lg transition-all">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                </a>
                                <form action="{{ route('membres.destroy', $membre) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" title="Supprimer" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <svg class="w-16 h-16 text-gray-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                                    <p class="text-gray-400 font-medium italic">Aucun membre enregistré dans cette base.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-6 bg-gray-50/50 border-t border-gray-100">
                {{ $membres->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</section>
@endsection