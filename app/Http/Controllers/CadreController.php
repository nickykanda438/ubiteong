<?php

namespace App\Http\Controllers;

use App\Models\Cadre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CadreController extends Controller
{
    /**
     * Affichage de la liste des cadres dans un tableau
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
     * Enregistrement d'un nouveau cadre
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom_complet' => 'required|string|max:255',
            'fonction'    => 'required|string|max:255',
            'profession'  => 'required|string|max:255',
            'biographie'  => 'nullable|string',
            'photo'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // 2Mo Max
        ]);

        $path = null;
        if ($request->hasFile('photo')) {
            // Stockage de la photo dans le dossier public/cadres
            $path = $request->file('photo')->store('cadres', 'public');
        }

        Cadre::create([
            'nom_complet' => $request->nom_complet,
            'fonction'    => $request->fonction,
            'profession'  => $request->profession,
            'biographie'  => $request->biographie,
            'photo'       => $path,
        ]);

        return redirect()->route('cadres.index')->with('success', 'Le cadre a été ajouté avec succès.');
    }

    /**
     * Afficher la biographie d'un cadre (pour une fenêtre modale ou une page dédiée)
     */
    public function show(Cadre $cadre)
    {
        // Retourne les données en JSON pour une utilisation facile avec un Modal Flowbite
        return response()->json($cadre);
    }

    /**
     * Mise à jour des informations d'un cadre
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
            // Supprimer l'ancienne photo si elle existe
            if ($cadre->photo) {
                Storage::disk('public')->delete($cadre->photo);
            }
            $data['photo'] = $request->file('photo')->store('cadres', 'public');
        }

        $cadre->update($data);

        return redirect()->route('cadres.index')->with('success', 'Informations du cadre mises à jour.');
    }

    /**
     * Suppression d'un cadre
     */
    public function destroy(Cadre $cadre)
    {
        // Supprimer la photo physiquement avant de supprimer l'entrée en base
        if ($cadre->photo) {
            Storage::disk('public')->delete($cadre->photo);
        }

        $cadre->delete();

        return redirect()->route('cadres.index')->with('success', 'Le cadre a été supprimé de la liste.');
    }
}