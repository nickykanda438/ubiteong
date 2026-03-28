<?php

namespace App\Http\Controllers;

use App\Models\Communique;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CommunicationController extends Controller
{
    /**
     * Affiche la liste des communiqués et des événements (Page Blog/Presse)
     */
    public function index()
    {
        $communiques = Communique::where('est_actif', true)->orderBy('date_publication', 'desc')->get();
        $events = Event::orderBy('date_evenement', 'desc')->get();

        return view('communication.index', compact('communiques', 'events'));
    }

    /**
     * Enregistre un nouveau communiqué (Saisie directe ou PDF)
     */
    public function storeCommunique(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'type' => 'required|in:saisie,pdf',
            'contenu' => 'required_if:type,saisie|nullable|string',
            'document_pdf' => 'required_if:type,pdf|nullable|file|mimes:pdf|max:10240', // Max 10Mo
            'signataire' => 'nullable|string|max:100',
            'date_publication' => 'required|date',
        ]);

        $communique = new Communique();
        // Génération d'une référence unique automatique
        $communique->reference = 'COM-' . date('Y') . '-' . strtoupper(Str::random(5));
        $communique->titre = $validated['titre'];
        $communique->type = $validated['type'];
        $communique->signataire = $validated['signataire'];
        $communique->date_publication = $validated['date_publication'];

        if ($request->type === 'pdf' && $request->hasFile('document_pdf')) {
            $path = $request->file('document_pdf')->store('communiques', 'public');
            $communique->chemin_pdf = $path;
        } else {
            $communique->contenu = $validated['contenu'];
        }

        $communique->save();

        return redirect()->back()->with('success', 'Le communiqué a été publié avec succès.');
    }

    /**
     * Enregistre une nouvelle manifestation (Photo uniquement)
     */
    public function storeEvent(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120', // Max 5Mo
            'date_evenement' => 'required|date',
            'lieu' => 'nullable|string|max:255',
        ]);

        $event = new Event();
        $event->titre = $validated['titre'];
        $event->description = $validated['description'];
        $event->date_evenement = $validated['date_evenement'];
        $event->lieu = $validated['lieu'];

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('events', 'public');
            $event->photo_path = $path;
        }

        $event->save();

        return redirect()->back()->with('success', 'La manifestation a été ajoutée à la galerie.');
    }

    /**
     * Supprime un communiqué ou un événement (Méthode générique)
     */
    public function destroy($model, $id)
    {
        if ($model === 'communique') {
            $item = Communique::findOrFail($id);
            if ($item->chemin_pdf) Storage::disk('public')->delete($item->chemin_pdf);
        } else {
            $item = Event::findOrFail($id);
            if ($item->photo_path) Storage::disk('public')->delete($item->photo_path);
        }

        $item->delete();
        return redirect()->back()->with('success', 'Suppression réussie.');
    }
}