@extends('layouts.app')
@section('title', 'Fil d\'actualité ONG')

@section('content')
<div class="p-4 sm:ml-64 bg-slate-50 min-h-screen">
    <div class="max-w-4xl mx-auto mt-14">
        
        <div class="flex items-center justify-between mb-8 p-4 bg-white rounded-2xl shadow-sm border border-gray-100">
            <div>
                <h1 class="text-xl font-bold text-blue-600 font-title">Communication</h1>
                <p class="text-xs text-gray-400 font-sans">Gérez les publications et événements de la fondation.</p>
            </div>
            <div class="flex gap-2">
                <button data-modal-target="modal-communique" data-modal-toggle="modal-communique" class="flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-xl hover:bg-blue-700 transition shadow-lg shadow-blue-900/10">
                    <i class="fas fa-plus-circle mr-2"></i> Communiqué
                </button>
                <button data-modal-target="modal-event" data-modal-toggle="modal-event" class="flex items-center px-4 py-2 bg-emerald-500 text-white text-sm font-medium rounded-xl hover:bg-emerald-600 transition shadow-lg shadow-emerald-900/10">
                    <i class="fas fa-camera mr-2"></i> Événement
                </button>
            </div>
        </div>

        <div class="space-y-6">
            
            @if(isset($communiques) && $communiques->count() > 0)
                @foreach($communiques as $com)
                <div class="bg-white rounded-2xl border-l-4 border-blue-600 shadow-sm overflow-hidden transition hover:shadow-md">
                    <div class="p-5">
                        <div class="flex justify-between items-start mb-3">
                            <span class="text-[10px] font-bold uppercase tracking-widest text-blue-600 bg-blue-50 px-2 py-1 rounded">
                                OFFICIEL • {{ $com->reference ?? 'REF-000' }}
                            </span>
                            <span class="text-xs text-gray-400">
                                {{ $com->date_publication ? \Carbon\Carbon::parse($com->date_publication)->diffForHumans() : 'Récemment' }}
                            </span>
                        </div>
                        <h2 class="text-lg font-bold text-gray-900 mb-2 font-title">{{ $com->titre }}</h2>
                        <p class="text-sm text-gray-600 line-clamp-3 mb-4">
                            @if($com->type === 'pdf')
                                <span class="flex items-center text-red-500 italic"><i class="fas fa-file-pdf mr-2"></i> Ce document est disponible en PDF.</span>
                            @else
                                {{ $com->contenu }}
                            @endif
                        </p>
                        
                        <div class="flex items-center justify-between pt-4 border-t border-gray-50">
                            <div class="flex gap-6">
                                <button class="flex items-center text-gray-500 hover:text-blue-600 text-sm transition font-medium">
                                    <i class="far fa-eye mr-2"></i> Lecture
                                </button>
                                <button class="flex items-center text-gray-500 hover:text-blue-600 text-sm transition font-medium">
                                    <i class="far fa-comment mr-2"></i> Commenter
                                </button>
                            </div>
                            <form action="{{ route('communication.destroy', ['model' => 'communique', 'id' => $com->id]) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-gray-300 hover:text-red-500 transition"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="p-8 text-center bg-white rounded-2xl border border-dashed border-gray-200">
                    <p class="text-gray-400 text-sm italic">Aucun communiqué officiel à afficher.</p>
                </div>
            @endif

            @if(isset($events) && $events->count() > 0)
                @foreach($events as $event)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden transition hover:shadow-md">
                    <div class="flex flex-col md:flex-row">
                        <div class="md:w-1/3 h-48 md:h-auto overflow-hidden bg-gray-100">
                            @if($event->photo_path)
                                <img src="{{ asset('storage/' . $event->photo_path) }}" class="h-full w-full object-cover" alt="Event Image">
                            @else
                                <div class="flex items-center justify-center h-full text-gray-300"><i class="fas fa-image fa-3x"></i></div>
                            @endif
                        </div>
                        <div class="p-5 md:w-2/3 flex flex-col justify-between">
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded uppercase">Événement</span>
                                    <span class="text-xs text-gray-400">{{ $event->lieu ?? 'Lieu non défini' }}</span>
                                </div>
                                <h2 class="text-lg font-bold text-gray-900 mb-2 font-title">{{ $event->titre }}</h2>
                                <p class="text-sm text-gray-500 line-clamp-2">{{ $event->description }}</p>
                            </div>
                            <div class="flex justify-between items-center mt-4 pt-4 border-t border-gray-50">
                                <span class="text-xs text-gray-400 font-medium"><i class="far fa-calendar-alt mr-1"></i> {{ \Carbon\Carbon::parse($event->date_evenement)->translatedFormat('d F Y') }}</span>
                                <form action="{{ route('communication.destroy', ['model' => 'event', 'id' => $event->id]) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-gray-300 hover:text-red-500 transition"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

<div id="modal-communique" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-lg max-h-full">
        <div class="relative bg-white rounded-3xl shadow">
            <div class="flex items-start justify-between p-4 border-b">
                <h3 class="text-lg font-bold text-blue-600 font-title">Rédiger un Communiqué</h3>
                <button type="button" data-modal-hide="modal-communique" class="text-gray-400 hover:bg-gray-100 rounded-lg p-1.5 ml-auto inline-flex items-center">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form action="{{ route('communique.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block mb-1 text-sm font-bold text-gray-700">Titre de la publication</label>
                    <input type="text" name="titre" class="bg-gray-50 border border-gray-200 text-sm rounded-xl block w-full p-3 focus:ring-blue-500 border-none shadow-inner" required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-1 text-sm font-bold text-gray-700">Type</label>
                        <select name="type" class="bg-gray-50 border border-gray-200 text-sm rounded-xl block w-full p-3 focus:ring-blue-500 border-none">
                            <option value="saisie">Saisie directe</option>
                            <option value="pdf">Document PDF</option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-bold text-gray-700">Date de publication</label>
                        <input type="date" name="date_publication" value="{{ date('Y-m-d') }}" class="bg-gray-50 border border-gray-200 text-sm rounded-xl block w-full p-3 focus:ring-blue-500 border-none">
                    </div>
                </div>
                <div>
                    <label class="block mb-1 text-sm font-bold text-gray-700">Contenu / Message</label>
                    <textarea name="contenu" rows="4" class="bg-gray-50 border border-gray-200 text-sm rounded-xl block w-full p-3 focus:ring-blue-500 border-none shadow-inner" placeholder="Écrivez ici..."></textarea>
                </div>
                <button type="submit" class="w-full text-white bg-blue-600 font-bold rounded-xl text-sm px-5 py-4 text-center hover:bg-blue-700 shadow-lg shadow-blue-100">PUBLIER MAINTENANT</button>
            </form>
        </div>
    </div>
</div>

<div id="modal-event" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-lg max-h-full">
        <div class="relative bg-white rounded-3xl shadow">
            <div class="flex items-start justify-between p-4 border-b">
                <h3 class="text-lg font-bold text-emerald-600 font-title">Nouvelle Manifestation</h3>
                <button type="button" data-modal-hide="modal-event" class="text-gray-400 hover:bg-gray-100 rounded-lg p-1.5 ml-auto inline-flex items-center">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form action="{{ route('event.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                @csrf
                <input type="text" name="titre" placeholder="Nom de l'événement" class="bg-gray-50 border-none rounded-xl block w-full p-3 text-sm" required>
                <textarea name="description" placeholder="Description courte..." class="bg-gray-50 border-none rounded-xl block w-full p-3 text-sm" rows="3"></textarea>
                <div class="grid grid-cols-2 gap-4">
                    <input type="text" name="lieu" placeholder="Lieu (ex: Kinshasa)" class="bg-gray-50 border-none rounded-xl block w-full p-3 text-sm">
                    <input type="date" name="date_evenement" value="{{ date('Y-m-d') }}" class="bg-gray-50 border-none rounded-xl block w-full p-3 text-sm">
                </div>
                <div>
                    <label class="block mb-1 text-sm font-bold text-gray-700">Photo illustrative</label>
                    <input type="file" name="photo" class="block w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                </div>
                <button type="submit" class="w-full text-white bg-emerald-500 font-bold rounded-xl text-sm px-5 py-4 text-center hover:bg-emerald-600 shadow-lg shadow-emerald-100">AJOUTER À LA GALERIE</button>
            </form>
        </div>
    </div>
</div>
@endsection