@extends('layouts.app')

@section('title', 'Biographie de ' . $cadre->nom_complet)

@section('content')
<section class="bg-gray-50 min-h-screen pb-20 font-sans">
    
    <div class="bg-kzz-blue w-full pt-16 pb-24 px-4 shadow-lg">
        <div class="max-w-screen-xl mx-auto flex flex-col md:flex-row items-center md:items-end gap-8">
            
            <div class="relative">
                <img class="w-48 h-48 lg:w-56 lg:h-56 rounded-2xl object-cover border-4 border-white shadow-2xl bg-white" 
                     src="{{ $cadre->photo ? asset('storage/'.$cadre->photo) : asset('images/default-avatar.png') }}" 
                     alt="{{ $cadre->nom_complet }}">
            </div>

            <div class="text-center md:text-left mb-4">
                <span class="bg-kzz-green text-white text-[10px] font-black uppercase px-3 py-1 rounded-full tracking-widest mb-3 inline-block shadow-sm">
                    Membre du Haut Commandement
                </span>
                <h1 class="text-3xl md:text-5xl font-black text-white uppercase italic tracking-tighter leading-none">
                    {{ $cadre->nom_complet }}
                </h1>
                <div class="mt-4 space-y-1">
                    <p class="text-kzz-green font-bold text-xl lg:text-2xl uppercase">{{ $cadre->fonction }}</p>
                    <p class="text-blue-100 text-lg italic font-light">{{ $cadre->profession }}</p>
                </div>
            </div>

            <div class="md:ml-auto mb-4">
                <a href="{{ route('cadres.index') }}" class="flex items-center text-white/80 hover:text-white font-bold text-xs uppercase tracking-widest transition-all group">
                    <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Retour à la liste
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-screen-xl mx-auto px-4 lg:px-12 -mt-10 relative z-10">
        <div class="grid grid-cols-1 gap-8">
            
            <div class="bg-white p-8 lg:p-16 rounded-3xl shadow-2xl border border-gray-100">
                <div class="flex items-center gap-4 mb-8 border-b pb-6">
                    <div class="bg-kzz-blue p-3 rounded-xl shadow-inner">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <h2 class="text-3xl font-black text-kzz-black uppercase italic tracking-widest">
                        Parcours et Biographie
                    </h2>
                </div>
                
                <div class="prose prose-blue max-w-none text-gray-700 leading-relaxed text-lg lg:text-xl">
                    {{-- nl2br pour afficher les paragraphes du textarea --}}
                    @if($cadre->biographie)
                        {!! nl2br(e($cadre->biographie)) !!}
                    @else
                        <div class="flex flex-col items-center py-10 text-gray-400 italic">
                            <svg class="w-16 h-16 mb-4 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            <p>Cette biographie est en cours de rédaction par le Haut Commandement.</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="flex justify-between items-center bg-gray-900 p-6 rounded-2xl text-white shadow-lg">
                <div class="flex items-center gap-3">
                    <div class="w-3 h-3 bg-kzz-green rounded-full animate-pulse"></div>
                    <span class="text-xs font-black uppercase tracking-widest text-gray-400">Statut : Officiel KAZWAZWA</span>
                </div>
                <p class="text-[10px] text-gray-500 font-mono">ID_{{ strtoupper(substr(md5($cadre->id), 0, 8)) }}</p>
            </div>

        </div>
    </div>
</section>
@endsection