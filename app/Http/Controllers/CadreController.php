<?php

namespace App\Http\Controllers;

use App\Models\Cadre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CadreController extends Controller
{
    /**
     * Liste des cadres avec recherche et pagination.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $cadres = Cadre::when($search, function ($query, $search) {
            return $query->where('nom_complet', 'like', "%{$search}%")
                         ->orWhere('fonction', 'like', "%{$search}%")
                         ->orWhere('profession', 'like', "%{$search}%");
        })
        ->orderBy('nom_complet', 'asc')
        ->paginate(10);

        return view('cadres.index', compact('cadres', 'search'));
    }

    /**
     * Enregistre un nouveau cadre dirigeant.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom_complet' => 'required|string|max:255',
            'fonction'    => 'required|string|max:255',
            'profession'  => 'required|string|max:255',
            'biographie'  => 'nullable|string',
            'photo'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Limite à 2Mo
        ]);

        $path = null;
        if ($request->hasFile('photo')) {
            // Stockage dans storage/app/public/cadres
            $path = $request->file('photo')->store('cadres', 'public');
        }

        Cadre::create([
            'nom_complet' => $request->nom_complet,
            'fonction'    => $request->fonction,
            'profession'  => $request->profession,
            'biographie'  => $request->biographie,
            'photo'       => $path,
        ]);

        return redirect()->route('cadres.index')
            ->with('success', 'Le cadre a été ajouté avec succès au Haut Commandement.');
    }

    /**
     * Affiche la page de biographie détaillée (Fiche complète).
     */
    public function show(Cadre $cadre)
    {
        // Renvoie vers le fichier resources/views/cadres/biographie.blade.php
        return view('cadres.biographie', compact('cadre'));
    }

    /**
     * Met à jour les informations d'un cadre et gère le remplacement de la photo.
     */
    public function update(Request $request, Cadre $cadre)
    {
        $request->validate([
            'nom_complet' => 'required|string|max:255',
            'fonction'    => 'required|string|max:255',
            'profession'  => 'required|string|max:255',
            'biographie'  => 'nullable|string',
            'photo'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['nom_complet', 'fonction', 'profession', 'biographie']);

        if ($request->hasFile('photo')) {
            // Nettoyage : Supprimer l'ancienne photo du disque si elle existe
            if ($cadre->photo) {
                Storage::disk('public')->delete($cadre->photo);
            }
            // Enregistrement de la nouvelle photo
            $data['photo'] = $request->file('photo')->store('cadres', 'public');
        }

        $cadre->update($data);

        return redirect()->route('cadres.index')
            ->with('success', 'Les informations du dirigeant ont été mises à jour.');
    }

    /**
     * Supprime un cadre et son fichier image associé.
     */
    public function destroy(Cadre $cadre)
    {
        // Suppression physique du fichier image pour éviter les fichiers orphelins
        if ($cadre->photo) {
            Storage::disk('public')->delete($cadre->photo);
        }

        $cadre->delete();

        return redirect()->route('cadres.index')
            ->with('success', 'Le cadre a été retiré de la base de données.');
    }
}