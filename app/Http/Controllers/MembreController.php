<?php

namespace App\Http\Controllers;

use App\Models\Membre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MembreController extends Controller
{
    /**
     * Liste des membres avec recherche et statistiques.
     */
    public function index(Request $request)
    {
        $query = Membre::query();

        // Logique de recherche
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('nom_complet', 'like', '%' . $request->search . '%')
                  ->orWhere('numero_membre', 'like', '%' . $request->search . '%');
            });
        }

        $membres = $query->latest()->paginate(10);

        // Calcul des statistiques
        $stats = [
            'total'         => Membre::count(),
            'effectifs'     => Membre::where('type_membre', 'Membre effectif')->count(),
            'sympathisants' => Membre::where('type_membre', 'Membre sympathisant')->count(),
            'honneurs'      => Membre::where('type_membre', 'Membre d’honneur')->count(),
            'hommes'        => Membre::where('genre', 'Masculin')->count(), 
            'femmes'        => Membre::where('genre', 'Féminin')->count(),  
        ];

        return view('membres.index', compact('membres', 'stats'));
    }

    public function create()
    {
        return view('membres.create');
    }

    /**
     * Enregistrement d'un nouveau membre.
     */
    public function store(Request $request)
    {
        // CORRECTION : Passage de certains champs en 'nullable' pour éviter les blocages de validation
        $validated = $request->validate([
            'numero_membre'  => 'required|unique:membres,numero_membre',
            'nom_complet'    => 'required|string|max:255',
            'date_naissance' => 'nullable|date', // CORRIGÉ : nullable au lieu de required
            'lieu_naissance' => 'nullable|string',
            'genre'          => 'required|string',
            'etat_civil'     => 'nullable|string',
            'anciennete'     => 'nullable|string',
            'profession'     => 'nullable|string',
            'fonction'       => 'required|string',
            'date_adhesion'  => 'nullable|date',
            'qualite'        => 'nullable|string',
            'type_membre'    => 'required|string', 
            'photo_membre'   => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'piece_identite' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240', // CORRIGÉ : ajout du type file
            'adresse_membre' => 'nullable|string', // CORRIGÉ : rendu optionnel pour plus de flexibilité
        ]);

        if (!empty($validated['date_adhesion'])) {
            $validated['anciennete'] = Membre::calculateAncienneteFromDate($validated['date_adhesion']);
        }

        // Gestion de la Photo
        if ($request->hasFile('photo_membre')) {
            $validated['photo_membre'] = $request->file('photo_membre')->store('membres/photos', 'public');
        }

        // Gestion de la Pièce d'Identité
        if ($request->hasFile('piece_identite')) {
            $validated['piece_identite'] = $request->file('piece_identite')->store('membres/documents', 'public');
        }

        Membre::create($validated);

        return redirect()->route('membres.index')->with('success', 'Membre enregistré avec succès.');
    }

    public function show(Membre $membre)
    {
        return view('membres.show', compact('membre'));
    }

    public function fiche(Membre $membre)
    {
        return view('membres.fiche', compact('membre'));
    }

    public function edit(Membre $membre)
    {
        return view('membres.create', compact('membre'));
    }

    /**
     * Mise à jour avec remplacement de photo et suppression des anciens fichiers.
     */
    public function update(Request $request, Membre $membre)
    {
        $validated = $request->validate([
            'numero_membre'  => 'required|unique:membres,numero_membre,' . $membre->id,
            'nom_complet'    => 'required|string|max:255',
            'date_naissance' => 'nullable|date', // CORRIGÉ
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
            'adresse_membre' => 'nullable|string',
        ]);

        // Mise à jour Photo : Supprime l'ancienne si une nouvelle est envoyée
        if ($request->hasFile('photo_membre')) {
            if ($membre->photo_membre) {
                Storage::disk('public')->delete($membre->photo_membre);
            }
            $validated['photo_membre'] = $request->file('photo_membre')->store('membres/photos', 'public');
        }

        if (!empty($validated['date_adhesion'])) {
            $validated['anciennete'] = Membre::calculateAncienneteFromDate($validated['date_adhesion']);
        }

        // Mise à jour Pièce d'identité : Supprime l'ancienne si une nouvelle est envoyée
        if ($request->hasFile('piece_identite')) {
            if ($membre->piece_identite) {
                Storage::disk('public')->delete($membre->piece_identite);
            }
            $validated['piece_identite'] = $request->file('piece_identite')->store('membres/documents', 'public');
        }

        $membre->update($validated);

        return redirect()->route('membres.index')->with('success', 'Informations mises à jour.');
    }

    public function destroy(Membre $membre)
    {
        // Optionnel : Supprimer les fichiers physiques lors de la suppression du membre
        if ($membre->photo_membre) Storage::disk('public')->delete($membre->photo_membre);
        if ($membre->piece_identite) Storage::disk('public')->delete($membre->piece_identite);

        $membre->delete();
        return redirect()->route('membres.index')->with('success', 'Membre supprimé avec succès.');
    }

    public function generateCard(Membre $membre)
    {
        return view('membres.card-print', compact('membre'));
    }

    public function viewPieceIdentite(Membre $membre)
    {
        if (!$membre->piece_identite || !Storage::disk('public')->exists($membre->piece_identite)) {
            return redirect()->back()->with('error', 'Pièce d\'identité non trouvée.');
        }

        return Storage::disk('public')->response($membre->piece_identite);
    }
}