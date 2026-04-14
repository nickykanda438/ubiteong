<?php

namespace App\Http\Controllers;

use App\Models\Membre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MembreController extends Controller
{
    
    public function index(Request $request)
    {
        $query = Membre::query();

        // Logique de recherche
        if ($request->has('search') && $request->search != '') {
            $query->where('nom_complet', 'like', '%' . $request->search . '%')
                  ->orWhere('numero_membre', 'like', '%' . $request->search . '%');
        }

        $membres = $query->latest()->paginate(10);

        // Calcul des statistiques basées sur vos catégories exactes
        $stats = [
          'total' => Membre::count(),
          'effectifs' => Membre::where('type_membre', 'Membre effectif')->count(),
          'sympathisants' => Membre::where('type_membre', 'Membre sympathisant')->count(),
          'honneurs' => Membre::where('type_membre', 'Membre d’honneur')->count(),
         // AJOUTEZ CES DEUX LIGNES :
          'hommes' => Membre::where('genre', 'Masculin')->count(), 
          'femmes' => Membre::where('genre', 'Féminin')->count(),  
         ];

        return view('membres.index', compact('membres', 'stats'));
    }

    /**
     * Formulaire de création.
     */
    public function create()
    {
        return view('membres.create');
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'numero_membre'  => 'required|unique:membres',
            'nom_complet'    => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'lieu_naissance' => 'nullable|string',
            'genre'          => 'required',
            'etat_civil'     => 'nullable|string',
            'anciennete'     => 'nullable|string',
            'profession'     => 'nullable|string',
            'fonction'       => 'required',
            'date_adhesion'  => 'nullable|date',
            'qualite'        => 'nullable|string',
            'type_membre'    => 'required', // Membre effectif, sympathisant, d’honneur
            'photo_membre'   => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'piece_identite' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120',
            'adresse_membre' => 'required',
        ]);

        if ($request->hasFile('photo_membre')) {
            $path = $request->file('photo_membre')->store('membres/photos', 'public');
            $validated['photo_membre'] = $path;
        }

        if ($request->hasFile('piece_identite')) {
            $path = $request->file('piece_identite')->store('membres/documents', 'public');
            $validated['piece_identite'] = $path;
        }

        Membre::create($validated);

        return redirect()->route('membres.index')->with('success', 'Membre enregistré avec succès.');
    }
    /**
     * Visualisation (Profil ou Carte).
     */
    public function show(Membre $membre)
    {
        return view('membres.show', compact('membre'));
    }

    public function fiche(Membre $membre){
        return view('membres.fiche', compact('membre'));
    }

    /**
     * Formulaire de modification.
     */
    public function edit(Membre $membre)
    {
        return view('membres.create', compact('membre'));
    }

    /**
     * Mise à jour avec remplacement de photo.
     */
    public function update(Request $request, Membre $membre)
    {
        $validated = $request->validate([
            'numero_membre'  => 'required|unique:membres,numero_membre,' . $membre->id,
            'nom_complet'    => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'lieu_naissance' => 'nullable|string',
            'genre'          => 'required',
            'etat_civil'     => 'nullable|string',
            'anciennete'     => 'nullable|string',
            'profession'     => 'nullable|string',
            'fonction'       => 'required',
            'date_adhesion'  => 'nullable|date',
            'qualite'        => 'nullable|string',
            'photo_membre'   => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'piece_identite' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120',
            'type_membre'    => 'required',
            'adresse_membre' => 'required',
        ]);

        if ($request->hasFile('photo_membre')) {
            if ($membre->photo_membre) {
                Storage::disk('public')->delete($membre->photo_membre);
            }
            $path = $request->file('photo_membre')->store('membres/photos', 'public');
            $validated['photo_membre'] = $path;
        }

        if ($request->hasFile('piece_identite')) {
            if ($membre->piece_identite) {
                Storage::disk('public')->delete($membre->piece_identite);
            }
            $path = $request->file('piece_identite')->store('membres/documents', 'public');
            $validated['piece_identite'] = $path;
        }

        $membre->update($validated);

        return redirect()->route('membres.index')->with('success', 'Informations mises à jour.');
    }

    /**
     * Suppression (Soft Delete géré par le modèle).
     */
    public function destroy(Membre $membre)
    {
        $membre->delete();
        return redirect()->route('membres.index')->with('success', 'Membre supprimé avec succès.');
    }

    /**
     * Vue spécifique pour l'impression de la carte.
     */
    public function generateCard(Membre $membre)
    {
        return view('membres.card-print', compact('membre'));
    }

    /**
     * Afficher la pièce d'identité du membre.
     */
    public function viewPieceIdentite(Membre $membre)
    {
        if (!$membre->piece_identite || !Storage::disk('public')->exists($membre->piece_identite)) {
            return redirect()->back()->with('error', 'Pièce d\'identité non trouvée.');
        }

        return Storage::disk('public')->response($membre->piece_identite);
    }
}