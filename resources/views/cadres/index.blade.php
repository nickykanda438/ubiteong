@extends('layouts.app')

@section('title', 'Partie réservée aux Cadres de l\'ONG KAZWAZWA')

@section('content')
<section class="bg-kzz-gray p-3 sm:p-5 min-h-screen">
    <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
        
        <div class="mb-6 p-4 bg-white rounded-lg shadow-sm border-l-4 border-kzz-blue">
            <h1 class="text-xl font-bold text-kzz-black mb-2">Haut Commandement de l'ONG</h1>
            <p class="text-gray-600 text-sm italic">
                Cette interface est réservée à la gestion des cadres dirigeants. Les informations saisies ici seront reflétées dans l'organigramme officiel de KAZWAZWA.
            </p>
        </div>

        <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden border border-gray-100 mb-6">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                <div class="w-full md:w-1/2">
                    <form action="{{ route('cadres.index') }}" method="GET" class="flex items-center">
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" /></svg>
                            </div>
                            <input type="text" name="search" value="{{ $search ?? '' }}" 
                                class="bg-gray-50 border border-gray-300 text-kzz-black text-sm rounded-lg focus:ring-kzz-blue focus:border-kzz-blue block w-full pl-10 p-2" 
                                placeholder="Rechercher un cadre...">
                        </div>
                    </form>
                </div>
                <div class="w-full md:w-auto">
                    <button type="button" data-modal-target="add-cadre-modal" data-modal-toggle="add-cadre-modal" 
                        class="w-full flex items-center justify-center text-white bg-kzz-green hover:bg-green-700 font-medium rounded-lg text-sm px-4 py-2 transition-all">
                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" /></svg>
                        Enregistrer un Cadre
                    </button>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-white uppercase bg-kzz-blue">
                        <tr>
                            <th scope="col" class="px-4 py-3">Cadre</th>
                            <th scope="col" class="px-4 py-3">Fonction</th>
                            <th scope="col" class="px-4 py-3">Profession</th>
                            <th scope="col" class="px-4 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cadres as $cadre)
                        <tr class="border-b hover:bg-gray-50 transition-colors">
                            <th scope="row" class="px-4 py-3 font-semibold text-kzz-black whitespace-nowrap">
                                <div class="flex items-center">
                                    <img class="w-10 h-10 rounded-full mr-3 object-cover border border-gray-200" 
                                         src="{{ $cadre->photo ? asset('storage/'.$cadre->photo) : asset('images/default-avatar.png') }}" 
                                         alt="{{ $cadre->nom_complet }}">
                                    <span>{{ $cadre->nom_complet }}</span>
                                </div>
                            </th>
                            <td class="px-4 py-3 text-kzz-blue font-medium">{{ $cadre->fonction }}</td>
                            <td class="px-4 py-3">{{ $cadre->profession }}</td>
                            <td class="px-4 py-3 flex items-center justify-end space-x-3">
                                <button type="button" 
                                    onclick="showBio('{{ $cadre->nom_complet }}', '{{ addslashes($cadre->biographie) }}')"
                                    class="text-blue-600 hover:underline font-medium text-xs">
                                    Voir Biographie
                                </button>
                                
                                <form action="{{ route('cadres.destroy', $cadre) }}" method="POST" onsubmit="return confirm('Supprimer ce cadre ?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-4 py-10 text-center text-gray-400">Aucun cadre enregistré.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4">
                {{ $cadres->links() }}
            </div>
        </div>
    </div>
</section>

<div id="add-cadre-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <form action="{{ route('cadres.store') }}" method="POST" enctype="multipart/form-data" class="relative bg-white rounded-lg shadow">
            @csrf
            <div class="flex items-start justify-between p-4 border-b bg-kzz-blue rounded-t">
                <h3 class="text-xl font-semibold text-white">Nouveau Cadre Dirigeant</h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-kzz-black">Nom Complet</label>
                        <input type="text" name="nom_complet" class="bg-gray-50 border border-gray-300 text-sm rounded-lg w-full p-2.5" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-kzz-black">Fonction dans l'ONG</label>
                        <input type="text" name="fonction" class="bg-gray-50 border border-gray-300 text-sm rounded-lg w-full p-2.5" placeholder="Ex: Coordonnateur" required>
                    </div>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-kzz-black">Profession (Titre)</label>
                    <input type="text" name="profession" class="bg-gray-50 border border-gray-300 text-sm rounded-lg w-full p-2.5" placeholder="Ex: Ingénieur Civil" required>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-kzz-black">Biographie / Parcours</label>
                    <textarea name="biographie" rows="4" class="bg-gray-50 border border-gray-300 text-sm rounded-lg w-full p-2.5"></textarea>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-kzz-black">Photo de profil</label>
                    <input type="file" name="photo" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 p-1">
                </div>
            </div>
            <div class="flex items-center p-6 space-x-2 border-t">
                <button type="submit" class="text-white bg-kzz-green hover:bg-green-700 font-medium rounded-lg text-sm px-5 py-2.5">Enregistrer le cadre</button>
            </div>
        </form>
    </div>
</div>

<div id="bio-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-lg max-h-full">
        <div class="relative bg-white rounded-lg shadow">
            <div class="flex items-center justify-between p-4 border-b bg-kzz-gray">
                <h3 id="bio-title" class="text-lg font-bold text-kzz-blue"></h3>
                <button type="button" data-modal-hide="bio-modal" class="text-gray-400 bg-transparent hover:bg-gray-200 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            <div class="p-6">
                <p id="bio-content" class="text-sm text-gray-700 leading-relaxed text-justify whitespace-pre-line"></p>
            </div>
        </div>
    </div>
</div>

<script>
    function showBio(name, bio) {
        document.getElementById('bio-title').innerText = "Biographie de " + name;
        document.getElementById('bio-content').innerText = bio || "Aucune biographie disponible.";
        
        // Utilisation de l'API Flowbite pour ouvrir le modal
        const modal = new Modal(document.getElementById('bio-modal'));
        modal.show();
    }
</script>
@endsection