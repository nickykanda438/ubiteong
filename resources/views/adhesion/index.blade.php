@extends('layouts.app')
@section('title', "Liste des Adhésions")

@section('content')
<div class="p-4 sm:p-8 bg-kzz-light min-h-screen">
    
    @if (session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 rounded-2xl p-4 flex items-start gap-3">
            <svg class="w-6 h-6 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <p class="text-sm font-bold text-green-700">{{ session('success') }}</p>
        </div>
    @endif

    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <h1 class="text-2xl font-black text-kzz-dark uppercase tracking-tight flex items-center gap-3">
                <span class="w-2 h-8 bg-kzz-blue rounded-full"></span>
                Demandes d'Adhésion
                <span class="bg-blue-100 text-kzz-blue text-xs font-black px-3 py-1 rounded-full ml-2 shadow-sm">
                    {{ $membres->count() }} Nouveaux
                </span>
            </h1>
            <p class="text-slate-500 text-sm mt-1">Candidatures reçues via le formulaire public de la Fondation.</p>
        </div>

        <div class="flex items-center gap-3">
            <button class="flex items-center gap-2 bg-white border border-slate-200 text-slate-700 px-5 py-2.5 rounded-2xl text-sm font-bold shadow-sm hover:bg-slate-50 transition active:scale-95">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                Filtrer par catégorie
            </button>
        </div>
    </div>

    <div class="relative overflow-hidden bg-white shadow-2xl rounded-[2.5rem] border border-slate-100">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-slate-500">
                <thead class="text-xs text-slate-400 uppercase bg-slate-50/50 border-b border-slate-100">
                    <tr>
                        <th scope="col" class="px-6 py-5 font-black tracking-widest">Adhérent</th>
                        <th scope="col" class="px-6 py-5 font-black tracking-widest">Email / Téléphone</th>
                        <th scope="col" class="px-6 py-5 font-black tracking-widest">Catégorie Choisie</th>
                        <th scope="col" class="px-6 py-5 font-black tracking-widest">Date Envoi</th>
                        <th scope="col" class="px-6 py-5 font-black tracking-widest text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($membres as $membre)
                    <tr class="hover:bg-slate-50/80 transition-colors group">
                        <th scope="row" class="px-6 py-4 font-medium text-slate-900 whitespace-nowrap">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-kzz-blue to-blue-400 flex items-center justify-center text-white font-black text-xs shadow-md group-hover:rotate-6 transition-transform">
                                    {{ strtoupper(substr($membre->nom_complet, 0, 2)) }}
                                </div>
                                <div>
                                    <div class="text-sm font-black text-slate-800 uppercase tracking-tight">{{ $membre->nom_complet }}</div>
                                    <div class="text-[10px] text-kzz-green font-bold uppercase tracking-tighter">Candidat Adhérent</div>
                                </div>
                            </div>
                        </th>
                        <td class="px-6 py-4">
                            <span class="font-bold text-slate-700">{{ $membre->email_ou_telephone }}</span>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $color = match($membre->categorie) {
                                    'Membre Effectif' => 'bg-emerald-100 text-emerald-700',
                                    'Membre d\'Honneur' => 'bg-purple-100 text-purple-700',
                                    default => 'bg-blue-100 text-blue-700',
                                };
                            @endphp
                            <span class="{{ $color }} text-[10px] font-black px-3 py-1 rounded-lg uppercase tracking-widest">
                                {{ $membre->categorie }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="text-slate-700 font-bold">{{ $membre->created_at->format('d M Y') }}</span>
                                <span class="text-[10px] text-slate-400 font-medium">{{ $membre->created_at->format('H:i') }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('membres.create') }}?type={{ $membre->categorie }}&from_adhesion={{ $membre->id }}&nom={{ urlencode($membre->nom_complet) }}&email={{ urlencode($membre->email_ou_telephone) }}" title="Convertir en membre" class="p-2 bg-emerald-50 text-emerald-600 rounded-xl hover:bg-emerald-600 hover:text-white transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                </a>
                                <form action="{{ route('adhesion.destroy', $membre) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette candidature?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Supprimer" class="p-2 bg-rose-50 text-rose-600 rounded-xl hover:bg-rose-600 hover:text-white transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-20 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-10 h-10 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                </div>
                                <h3 class="text-lg font-black text-slate-800 uppercase">Aucune demande en attente</h3>
                                <p class="text-slate-400 text-sm mt-1 font-medium">Les nouvelles adhésions apparaîtront ici dès qu'un visiteur remplit le formulaire.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-8 flex justify-center">
        {{ $membres->links() }}
    </div>
</div>

<style>
    /* Raffinement des polices pour le rendu pro */
    .tracking-tighter { letter-spacing: -0.05em; }
    .tracking-widest { letter-spacing: 0.1em; }
</style>
@endsection