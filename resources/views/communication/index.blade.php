@extends('layouts.app')

@section('title', 'Communication ONG')

@section('content')
<section class="bg-kzz-gray min-h-screen font-sans">
    <div class="relative h-64 w-full flex flex-col items-center justify-center text-center px-4 overflow-hidden shadow-inner">
        <img src="https://images.unsplash.com/photo-1441974231531-c6227db76b6e?auto=format&fit=crop&q=80" 
     class="absolute inset-0 w-full h-full object-cover brightness-[0.35]" alt="Fond">
        <div class="relative z-10">
            <h1 class="text-3xl md:text-5xl font-bold text-white mb-2 font-title tracking-tight uppercase">Communication de la Fondation</h1>
            <p class="text-white/80 text-lg font-light italic">Gérez les publications et événements de la fondation.</p>
        </div>
    </div>

    <div class="mx-auto max-w-screen-xl px-4 lg:px-12 -mt-10 relative z-20 pb-20">
        
        <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-5 bg-white rounded-xl shadow-md border border-gray-100 mb-8">
            <h2 class="text-2xl font-bold text-kzz-black font-title tracking-tight">Fil d'actualité ONG</h2>
            <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                <button data-modal-target="modal-communique" data-modal-toggle="modal-communique" class="flex items-center justify-center px-5 py-2.5 bg-kzz-blue text-white text-sm font-bold rounded-lg hover:bg-blue-900 transition shadow-md">
                    <i class="fas fa-bullhorn mr-2"></i> Nouveau Communiqué
                </button>
                <button data-modal-target="modal-event" data-modal-toggle="modal-event" class="flex items-center justify-center px-5 py-2.5 bg-kzz-green text-white text-sm font-bold rounded-lg hover:bg-green-700 transition shadow-md">
                    <i class="fas fa-calendar-plus mr-2"></i> Nouvel Événement
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-4 border-b border-gray-100 bg-gray-50 flex items-center justify-between">
                        <h3 class="text-sm font-bold text-kzz-black/70 uppercase tracking-widest font-title">Communiqués Officiels</h3>
                    </div>
                    
                    <div class="p-6">
                        @forelse($communiques as $com)
                            <div class="border border-gray-100 rounded-2xl p-6 mb-6 last:mb-0 hover:border-kzz-blue/20 transition-all bg-white shadow-sm group">
                                <div class="flex justify-between items-start mb-4">
                                    <span class="bg-kzz-blue text-white text-[10px] font-bold px-3 py-1.5 rounded uppercase">
                                        {{ $com->reference }}
                                    </span>
                                    <span class="text-xs text-gray-400 italic">
                                        {{ \Carbon\Carbon::parse($com->date_publication)->translatedFormat('d F Y') }}
                                    </span>
                                </div>
                                <h4 class="text-xl font-bold text-kzz-black mb-3 font-title group-hover:text-kzz-blue transition-colors">{{ $com->titre }}</h4>
                                
                                @if($com->type === 'pdf')
                                    <div class="flex items-center p-3 bg-blue-50 rounded-lg mb-6">
                                        <i class="fas fa-file-pdf text-red-500 text-2xl mr-3"></i>
                                        <span class="text-sm font-medium text-blue-800">Document joint (PDF)</span>
                                    </div>
                                @else
                                    <p class="text-gray-500 text-sm mb-6 leading-relaxed line-clamp-3">{{ $com->contenu }}</p>
                                @endif

                                <div class="flex items-center justify-between border-t border-gray-100 pt-5">
                                    <div class="flex gap-3">
                                        @if($com->type === 'pdf')
                                            <a href="{{ asset('storage/' . $com->chemin_pdf) }}" target="_blank" class="flex items-center px-6 py-2 bg-kzz-blue text-white text-xs font-bold rounded-lg">
                                                <i class="fas fa-download mr-2"></i> Télécharger
                                            </a>
                                        @else
                                            <button class="flex items-center px-6 py-2 bg-kzz-blue text-white text-xs font-bold rounded-lg shadow-md">
                                                <i class="fas fa-eye mr-2"></i> Lecture
                                            </button>
                                        @endif
                                        <button class="flex items-center px-6 py-2 bg-[#334155] text-white text-xs font-bold rounded-lg shadow-md">
                                            <i class="fas fa-comment mr-2"></i> {{ $com->signataire ?? 'Direction' }}
                                        </button>
                                    </div>
                                    <form action="{{ route('communication.destroy', ['model' => 'communique', 'id' => $com->id]) }}" method="POST" onsubmit="return confirm('Supprimer ce communiqué ?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-600 p-2 transition-colors"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-16">
                                <p class="text-kzz-black font-bold font-title">Aucun communiqué officiel,</p>
                            </div>
                        @endforelse

                        @if($communiques->hasPages())
                        <div class="mt-8 pt-6 border-t border-gray-100 flex items-center justify-between">
                            <div class="flex-1 flex justify-between sm:hidden">
                                {{ $communiques->links('pagination::simple-tailwind') }}
                            </div>
                            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                {{ $communiques->links('pagination::tailwind') }}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-4 border-b border-gray-100 bg-gray-50 flex items-center">
                        <h3 class="text-sm font-bold text-kzz-black/70 uppercase tracking-widest font-title">Événements</h3>
                    </div>
                    
                    <div class="p-4 space-y-6">
                        @foreach($events as $event)
                        <div class="group border border-gray-100 rounded-2xl overflow-hidden hover:shadow-lg transition-all bg-white">
                            <div class="relative h-44 overflow-hidden">
                                <img src="{{ asset('storage/' . $event->photo_path) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="Event">
                                <div class="absolute top-3 left-3 bg-kzz-green text-white text-[9px] font-bold px-2 py-1 rounded uppercase">MANIF</div>
                            </div>
                            <div class="p-4">
                                <h4 class="text-md font-bold text-kzz-black mb-1 font-title line-clamp-1">{{ $event->titre }}</h4>
                                <div class="flex items-center text-[11px] font-bold text-kzz-green mb-3 uppercase">
                                    <i class="far fa-calendar-alt mr-2"></i>
                                    {{ \Carbon\Carbon::parse($event->date_evenement)->translatedFormat('d F Y') }}
                                </div>
                                <div class="flex justify-between items-center pt-3 border-t border-gray-50">
                                    <span class="text-[10px] text-gray-400 italic"><i class="fas fa-map-marker-alt mr-1"></i> {{ $event->lieu }}</span>
                                    <form action="{{ route('communication.destroy', ['model' => 'event', 'id' => $event->id]) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-300 hover:text-red-500"><i class="fas fa-trash-alt text-sm"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="modal-communique" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-[calc(100%-1rem)] max-h-full bg-kzz-black/30 backdrop-blur-sm">
    <div class="relative w-full max-w-lg max-h-full">
        <div class="relative bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden font-sans">
            <div class="flex items-center justify-between p-6 border-b border-gray-100">
                <h3 class="text-xl font-bold text-kzz-blue font-title uppercase tracking-tighter">Nouveau Communiqué</h3>
                <button type="button" data-modal-hide="modal-communique" class="text-gray-400 hover:bg-gray-100 rounded-full p-2"><i class="fas fa-times"></i></button>
            </div>
            <form action="{{ route('communique.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-5">
                @csrf
                <div>
                    <label class="block mb-1 text-xs font-bold text-gray-500 uppercase">Titre</label>
                    <input type="text" name="titre" class="bg-gray-50 border border-gray-200 text-sm rounded-lg block w-full p-4 focus:ring-kzz-blue focus:border-kzz-blue" required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-1 text-xs font-bold text-gray-500 uppercase">Type</label>
                        <select name="type" id="type_communique" class="bg-gray-50 border border-gray-200 text-sm rounded-lg block w-full p-4">
                            <option value="saisie">Saisie directe</option>
                            <option value="pdf">Fichier PDF</option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-1 text-xs font-bold text-gray-500 uppercase">Date</label>
                        <input type="date" name="date_publication" value="{{ date('Y-m-d') }}" class="bg-gray-50 border border-gray-200 text-sm rounded-lg block w-full p-4" required>
                    </div>
                </div>
                <div>
                    <label class="block mb-1 text-xs font-bold text-gray-500 uppercase">Signataire (Optionnel)</label>
                    <input type="text" name="signataire" placeholder="Ex: Le Coordonnateur" class="bg-gray-50 border border-gray-200 text-sm rounded-lg block w-full p-4">
                </div>
                <div id="zone_saisie">
                    <label class="block mb-1 text-xs font-bold text-gray-500 uppercase">Contenu</label>
                    <textarea name="contenu" rows="4" class="bg-gray-50 border border-gray-200 text-sm rounded-lg block w-full p-4"></textarea>
                </div>
                <div id="zone_pdf" class="hidden">
                    <label class="block mb-1 text-xs font-bold text-gray-500 uppercase">Document PDF (Max 10Mo)</label>
                    <input type="file" name="document_pdf" class="text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-blue-50 file:text-kzz-blue">
                </div>
                <button type="submit" class="w-full text-white bg-kzz-blue font-bold rounded-lg text-sm px-5 py-4 hover:bg-blue-900 shadow-lg transition-all uppercase tracking-widest">Publier</button>
            </form>
        </div>
    </div>
</div>

<div id="modal-event" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-[calc(100%-1rem)] max-h-full bg-kzz-black/30 backdrop-blur-sm">
    <div class="relative w-full max-w-lg max-h-full">
        <div class="relative bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden font-sans">
            <div class="flex items-center justify-between p-6 border-b border-gray-100">
                <h3 class="text-xl font-bold text-kzz-green font-title uppercase tracking-tighter">Nouvel Événement</h3>
                <button type="button" data-modal-hide="modal-event" class="text-gray-400 hover:bg-gray-100 rounded-full p-2"><i class="fas fa-times"></i></button>
            </div>
            <form action="{{ route('event.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-4">
                @csrf
                <div>
                    <label class="block mb-1 text-xs font-bold text-gray-500 uppercase">Nom de l'événement</label>
                    <input type="text" name="titre" class="bg-gray-50 border border-gray-200 rounded-lg block w-full p-4 text-sm" required>
                </div>
                <div>
                    <label class="block mb-1 text-xs font-bold text-gray-500 uppercase">Description</label>
                    <textarea name="description" rows="3" class="bg-gray-50 border border-gray-200 rounded-lg block w-full p-4 text-sm" required></textarea>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-1 text-xs font-bold text-gray-500 uppercase">Lieu</label>
                        <input type="text" name="lieu" placeholder="Ex: Kinshasa" class="bg-gray-50 border border-gray-200 rounded-lg p-4 text-sm w-full">
                    </div>
                    <div>
                        <label class="block mb-1 text-xs font-bold text-gray-500 uppercase">Date</label>
                        <input type="date" name="date_evenement" class="bg-gray-50 border border-gray-200 rounded-lg p-4 text-sm w-full" required>
                    </div>
                </div>
                <div>
                    <label class="block mb-1 text-xs font-bold text-gray-500 uppercase">Photo illustrative (Max 5Mo)</label>
                    <input type="file" name="photo" class="text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-green-50 file:text-kzz-green cursor-pointer w-full" required>
                </div>
                <button type="submit" class="w-full text-white bg-kzz-green font-bold rounded-lg text-sm px-5 py-4 hover:bg-green-700 shadow-lg transition-all uppercase tracking-widest">Enregistrer</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('type_communique').addEventListener('change', function() {
        const zoneSaisie = document.getElementById('zone_saisie');
        const zonePdf = document.getElementById('zone_pdf');
        if (this.value === 'pdf') {
            zoneSaisie.classList.add('hidden');
            zonePdf.classList.remove('hidden');
        } else {
            zoneSaisie.classList.remove('hidden');
            zonePdf.classList.add('hidden');
        }
    });
</script>
@endsection