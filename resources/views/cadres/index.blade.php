@extends('layouts.app')

@section('title', 'Partie réservée aux Cadres de l\'ONG KAZWAZWA')

@section('content')
<section class="bg-kzz-gray min-h-screen font-sans">
    <div class="relative h-72 w-full flex flex-col items-center justify-center text-center px-4 overflow-hidden bg-gray-900 shadow-inner">
        <img src="https://images.unsplash.com/photo-1431540015161-0bf868a2d407?auto=format&fit=crop&q=80" 
             class="absolute inset-0 w-full h-full object-cover brightness-[0.25] scale-105" alt="Background Leadership">
        
        <div class="relative z-10">
            <h1 class="text-3xl md:text-5xl font-bold text-white mb-3 font-title tracking-widest uppercase italic">Haut Commandement</h1>
            <p class="text-white/80 text-lg font-light italic max-w-3xl border-l-4 border-kzz-blue pl-4 ml-4">
                Cette interface est réservée à la gestion des cadres dirigeants. Les informations saisies ici seront reflétées dans l'organigramme officiel de KAZWAZWA.
            </p>
        </div>
    </div>

    <div class="mx-auto max-w-screen-xl px-4 lg:px-12 -mt-12 relative z-20 pb-20">
        
        <div class="bg-white relative shadow-xl rounded-xl overflow-hidden border border-gray-100 mb-6">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-5">
                <div class="w-full md:w-1/2">
                    <form action="{{ route('cadres.index') }}" method="GET" class="flex items-center">
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" /></svg>
                            </div>
                            <input type="text" name="search" value="{{ $search ?? '' }}" 
                                class="bg-gray-50 border border-gray-300 text-kzz-black text-sm rounded-lg focus:ring-kzz-blue focus:border-kzz-blue block w-full pl-10 p-2.5" 
                                placeholder="Rechercher un dirigeant ou une fonction...">
                        </div>
                    </form>
                </div>
                <div class="w-full md:w-auto">
                    <button type="button" data-modal-target="add-cadre-modal" data-modal-toggle="add-cadre-modal" 
                        class="w-full flex items-center justify-center text-white bg-kzz-green hover:bg-green-700 font-bold rounded-lg text-sm px-6 py-2.5 transition-all shadow-md">
                        <svg class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" /></svg>
                        ENREGISTRER UN CADRE
                    </button>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-white uppercase bg-kzz-blue font-title tracking-wider">
                        <tr>
                            <th scope="col" class="px-6 py-4">Dirigeant</th>
                            <th scope="col" class="px-6 py-4">Fonction KAZWAZWA</th>
                            <th scope="col" class="px-6 py-4">Profession</th>
                            <th scope="col" class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($cadres as $cadre)
                        <tr class="bg-white hover:bg-blue-50/50 transition-colors">
                            <th scope="row" class="px-6 py-4 font-bold text-kzz-black whitespace-nowrap">
                                <div class="flex items-center">
                                    <img class="w-12 h-12 rounded-full mr-4 object-cover border-2 border-kzz-blue/20 p-0.5 shadow-sm" 
                                         src="{{ $cadre->photo ? asset('storage/'.$cadre->photo) : asset('images/default-avatar.png') }}" 
                                         alt="{{ $cadre->nom_complet }}">
                                    <span class="text-base tracking-tight">{{ $cadre->nom_complet }}</span>
                                </div>
                            </th>
                            <td class="px-6 py-4">
                                <span class="text-kzz-blue font-black uppercase text-xs">{{ $cadre->fonction }}</span>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-600 italic">{{ $cadre->profession }}</td>
                            <td class="px-6 py-4 flex items-center justify-end space-x-4 mt-3">
                                <button type="button" 
                                    onclick="showBio('{{ $cadre->nom_complet }}', '{{ addslashes($cadre->biographie) }}')"
                                    class="text-kzz-blue hover:text-blue-800 font-bold text-xs uppercase underline tracking-tighter">
                                    Voir Biographie
                                </button>
                                
                                <form action="{{ route('cadres.destroy', $cadre) }}" method="POST" onsubmit="return confirm('Supprimer ce cadre ?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 transition-transform hover:scale-110">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-16 text-center text-gray-400 font-light italic text-lg">
                                Aucun cadre enregistré dans le haut commandement.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 bg-gray-50 border-t border-gray-100">
                {{ $cadres->links() }}
            </div>
        </div>
    </div>
</section>

<div id="add-cadre-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <form action="{{ route('cadres.store') }}" method="POST" enctype="multipart/form-data" class="relative bg-white rounded-xl shadow-2xl overflow-hidden">
            @csrf
            <div class="flex items-start justify-between p-5 border-b bg-kzz-blue">
                <h3 class="text-xl font-black text-white uppercase tracking-widest">Nouveau Cadre Dirigeant</h3>
            </div>
            <div class="p-8 space-y-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-2 text-xs font-black text-kzz-black uppercase tracking-widest">Nom Complet</label>
                        <input type="text" name="nom_complet" class="bg-gray-50 border border-gray-200 text-sm rounded-lg w-full p-3 focus:ring-kzz-blue focus:border-kzz-blue" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-xs font-black text-kzz-black uppercase tracking-widest">Fonction dans l'ONG</label>
                        <input type="text" name="fonction" class="bg-gray-50 border border-gray-200 text-sm rounded-lg w-full p-3 focus:ring-kzz-blue focus:border-kzz-blue" placeholder="Ex: Coordonnateur National" required>
                    </div>
                </div>
                <div>
                    <label class="block mb-2 text-xs font-black text-kzz-black uppercase tracking-widest">Profession (Titre)</label>
                    <input type="text" name="profession" class="bg-gray-50 border border-gray-200 text-sm rounded-lg w-full p-3 focus:ring-kzz-blue focus:border-kzz-blue" placeholder="Ex: Docteur en Sociologie" required>
                </div>
                <div>
                    <label class="block mb-2 text-xs font-black text-kzz-black uppercase tracking-widest">Biographie / Parcours</label>
                    <textarea name="biographie" rows="4" class="bg-gray-50 border border-gray-200 text-sm rounded-lg w-full p-3 focus:ring-kzz-blue focus:border-kzz-blue shadow-inner"></textarea>
                </div>
                <div class="bg-blue-50 p-4 rounded-xl border-2 border-dashed border-blue-100">
                    <label class="block mb-2 text-xs font-black text-kzz-blue uppercase tracking-widest">Photo de profil (Format Portrait)</label>
                    <input type="file" name="photo" class="block w-full text-sm text-gray-900 cursor-pointer bg-white rounded-lg p-2 border border-blue-200">
                </div>
            </div>
            <div class="flex items-center p-6 space-x-3 border-t bg-gray-50">
                <button type="submit" class="text-white bg-kzz-green hover:bg-green-700 font-black rounded-lg text-xs px-8 py-3.5 shadow-lg transition-all uppercase tracking-widest">Valider l'enregistrement</button>
                <button data-modal-hide="add-cadre-modal" type="button" class="text-gray-500 font-bold text-xs uppercase px-5 py-3.5">Annuler</button>
            </div>
        </form>
    </div>
</div>

<div id="bio-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-lg max-h-full">
        <div class="relative bg-white rounded-2xl shadow-2xl overflow-hidden">
            <div class="flex items-center justify-between p-5 border-b bg-kzz-blue">
                <h3 id="bio-title" class="text-sm font-black text-white uppercase tracking-widest italic"></h3>
                <button type="button" data-modal-hide="bio-modal" class="text-white/70 hover:text-white">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            <div class="p-8">
                <p id="bio-content" class="text-gray-700 leading-relaxed text-justify whitespace-pre-line font-medium italic"></p>
            </div>
        </div>
    </div>
</div>

<script>
    function showBio(name, bio) {
        document.getElementById('bio-title').innerText = "PROFIL : " + name;
        document.getElementById('bio-content').innerText = bio || "Ce dirigeant n'a pas encore renseigné sa biographie.";
        const modal = new Modal(document.getElementById('bio-modal'));
        modal.show();
    }
</script>
@endsection