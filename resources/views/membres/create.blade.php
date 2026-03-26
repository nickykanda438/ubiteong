@extends('layouts.app')

@section('title', isset($membre) ? 'Modifier Membre' : 'Nouveau Membre - ONG ESPOIR GLOBAL')

@section('content')
<section class="bg-gray-50 p-3 sm:p-5 min-h-screen">
    <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
        
        <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 mb-6">
            <div class="w-full md:w-auto">
                <h1 class="text-2xl font-bold text-kzz-black">
                    {{ isset($membre) ? "Modification du Membre" : "Enregistrement d'un Nouveau Membre" }}
                </h1>
                <p class="text-gray-500 text-sm">Remplissez les informations pour générer la carte de membre.</p>
            </div>
            <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3">
                <a href="{{ route('membres.index') }}" class="flex items-center justify-center text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 font-medium rounded-lg text-sm px-4 py-2 transition-all">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Annuler et Retour
                </a>
            </div>
        </div>

        <form action="{{ isset($membre) ? route('membres.update', $membre) : route('membres.store') }}" method="POST" enctype="multipart/form-data">
             @csrf
            @if(isset($membre))
                 @method('PUT')
            @endif
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <div class="lg:col-span-2 space-y-6">
                    <div class="p-6 bg-white rounded-lg shadow-sm border border-gray-200">
                        <h2 class="text-lg font-semibold text-kzz-blue mb-4 border-b pb-2">Identité du Membre</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700">Numéro de Carte (ID)</label>
                                <input type="text" name="numero_membre" value="{{ old('numero_membre', $membre->numero_membre ?? '') }}" class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-kzz-blue focus:border-kzz-blue" placeholder="Ex: EG-RDC-2026-001" required>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block mb-2 text-sm font-bold text-gray-700">Nom Complet (Nom, Postnom, Prénom)</label>
                                <input type="text" name="nom_complet" value="{{ old('nom_complet', $membre->nom_complet ?? '') }}" class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-kzz-blue focus:border-kzz-blue" placeholder="Ex: MUTOMBO MPOYO SARAH" required>
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-bold text-gray-700">Genre</label>
                                <select name="genre" class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-kzz-blue">
                                    <option value="Masculin" {{ old('genre', $membre->genre ?? '') == 'Masculin' ? 'selected' : '' }}>Masculin</option>
                                    <option value="Féminin" {{ old('genre', $membre->genre ?? '') == 'Féminin' ? 'selected' : '' }}>Féminin</option>
                                </select>
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-bold text-gray-700">Date de Naissance</label>
                                <input type="date" name="date_naissance" value="{{ old('date_naissance', $membre->date_naissance ?? '') }}" class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-kzz-blue">
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-bold text-gray-700">Lieu de Naissance</label>
                                <input type="text" name="lieu_naissance" value="{{ old('lieu_naissance', $membre->lieu_naissance ?? '') }}" class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-kzz-blue" placeholder="Ex: Kinshasa">
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-bold text-gray-700">Profession</label>
                                <input type="text" name="profession" value="{{ old('profession', $membre->profession ?? '') }}" class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-kzz-blue" placeholder="Ex: Avocat, Étudiant...">
                            </div>
                        </div>
                    </div>

                    <div class="p-6 bg-white rounded-lg shadow-sm border border-gray-200">
                        <h2 class="text-lg font-semibold text-kzz-blue mb-4 border-b pb-2">Coordonnées & Adresse</h2>
                        <div>
                            <label class="block mb-2 text-sm font-bold text-gray-700">Adresse de résidence complète</label>
                            {{-- Note: Les textarea n'ont pas d'attribut value --}}
                            <textarea name="adresse_membre" rows="3" class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-kzz-blue" placeholder="N°, Avenue, Quartier, Commune, Ville...">{{ old('adresse_membre', $membre->adresse_membre ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="p-6 bg-white rounded-lg shadow-sm border border-gray-200">
                        <h2 class="text-lg font-semibold text-kzz-blue mb-4 border-b pb-2">Statut au sein de l'ONG</h2>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block mb-2 text-sm font-bold text-gray-700">Type de Membre</label>
                                <select name="type_membre" class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-kzz-blue font-semibold text-blue-900">
                                    @php $tm = old('type_membre', $membre->type_membre ?? ''); @endphp
                                    <option value="Membre effectif" {{ $tm == 'Membre effectif' ? 'selected' : '' }}>Membres effectifs</option>
                                    <option value="Membre sympathisant" {{ $tm == 'Membre sympathisant' ? 'selected' : '' }}>Membres sympathisants</option>
                                    <option value="Membre d’honneur" {{ $tm == 'Membre d’honneur' ? 'selected' : '' }}>Membres d’honneur</option>
                                </select>
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-bold text-gray-700">Fonction / Titre</label>
                                <input type="text" name="fonction" value="{{ old('fonction', $membre->fonction ?? '') }}" class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-kzz-blue" placeholder="Ex: Coordinateur, Secrétaire..." required>
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-bold text-gray-700">Qualité (Optionnel)</label>
                                <input type="text" name="qualite" value="{{ old('qualite', $membre->qualite ?? '') }}" class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-kzz-blue" placeholder="Ex: Fondateur, Donateur...">
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-bold text-gray-700">Date d'Adhésion</label>
                                <input type="date" name="date_adhesion" value="{{ old('date_adhesion', $membre->date_adhesion ?? date('Y-m-d')) }}" class="w-full p-2.5 bg-gray-50 border border-gray-300 rounded-lg focus:ring-kzz-blue">
                            </div>
                        </div>
                    </div>

                    <div class="p-6 bg-white rounded-lg shadow-sm border border-gray-200 text-center">
                        <h2 class="text-lg font-semibold text-kzz-blue mb-4 border-b pb-2">Photo de Profil</h2>
                        <div class="flex flex-col items-center">
                            <div class="w-32 h-32 mb-4 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center bg-gray-50 overflow-hidden">
                                @if(isset($membre) && $membre->photo_membre)
                                    <img id="preview" src="{{ asset('storage/' . $membre->photo_membre) }}" alt="Aperçu" class="w-full h-full object-cover">
                                    <svg id="placeholder_svg" class="hidden w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                @else
                                    <img id="preview" src="#" alt="Aperçu" class="hidden w-full h-full object-cover">
                                    <svg id="placeholder_svg" class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                @endif
                            </div>
                            <input type="file" name="photo_membre" id="image_input" class="text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                    </div>

                    <button type="submit" class="w-full py-4 bg-kzz-green hover:bg-green-700 text-white font-bold rounded-lg shadow-lg transition-all flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        {{ isset($membre) ? 'METTRE À JOUR' : "VALIDER L'ENREGISTREMENT" }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>

<script>
    document.getElementById('image_input').onchange = evt => {
        const [file] = document.getElementById('image_input').files
        if (file) {
            const preview = document.getElementById('preview');
            const placeholder = document.getElementById('placeholder_svg');
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
        }
    }
</script>
@endsection