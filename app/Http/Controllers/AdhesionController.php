<?php

namespace App\Http\Controllers;

use App\Models\Adhesion;
use Illuminate\Http\Request;

class AdhesionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $membres = Adhesion::latest()->paginate(10);
        return view('adhesion.index', compact('membres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_complet' => 'required|string|max:255',
            'email_ou_telephone' => 'required|string|max:255',
            'categorie' => 'required|in:Membre Effectif,Membre Sympathisant,Membre d\'Honneur',
        ]);

        Adhesion::create($validated);

        return redirect()->back()->with('success', 'Votre candidature a été soumise avec succès! Nous vous contacterons très bientôt.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Adhesion $adhesion)
    {
        $adhesion->delete();
        return redirect()->back()->with('success', 'Adhésion supprimée.');
    }
}
