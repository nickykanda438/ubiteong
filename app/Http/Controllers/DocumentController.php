<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DocumentController extends Controller
{
    /**
     * Liste des documents avec option de recherche groupée
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $documents = Document::when($search, function ($query, $search) {
            return $query->where(function ($q) use ($search) {
                $q->where('titre', 'like', "%{$search}%")
                  ->orWhere('numero_doc', 'like', "%{$search}%")
                  ->orWhere('type_doc', 'like', "%{$search}%");
            });
        })
        ->orderBy('date_insertion', 'desc')
        ->paginate(10);

        return view('documents.index', compact('documents', 'search'));
    }

    /**
     * Enregistrement d'un nouveau document
     */
    public function store(Request $request)
    {
        $request->validate([
            'numero_doc'  => 'required|string|unique:documents,numero_doc',
            'type_doc'    => 'required|string',
            'titre'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'file'        => 'required|file|mimes:pdf,doc,docx,jpg,png|max:5120',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '_' . Str::slug($request->titre) . '.' . $extension;
            
            $path = $file->storeAs('documents_ong', $fileName, 'public');

            Document::create([
                'numero_doc'     => $request->numero_doc,
                'type_doc'       => $request->type_doc,
                'titre'          => $request->titre,
                'description'    => $request->description,
                'format'         => strtoupper($extension),
                'file_path'      => $path,
                'date_insertion' => now(), 
            ]);

            return redirect()->route('documents.index')->with('success', 'Le document a été enregistré avec succès.');
        }

        return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'upload.');
    }

    /**
     * Visualiser le document dans le navigateur
     */
    public function show(Document $document)
    {
        /** @var \Illuminate\Filesystem\FilesystemAdapter $storage */
        $storage = Storage::disk('public');

        if (!$storage->exists($document->file_path)) {
            abort(404, 'Fichier introuvable sur le serveur.');
        }

        return response()->file($storage->path($document->file_path));
    }

    /**
     * Télécharger le document
     */
    public function download(Document $document)
    {
        /** @var \Illuminate\Filesystem\FilesystemAdapter $storage */
        $storage = Storage::disk('public');

        if ($storage->exists($document->file_path)) {
            $downloadName = Str::slug($document->titre) . '.' . strtolower($document->format);
            
            return $storage->download($document->file_path, $downloadName);
        }

        return redirect()->back()->with('error', 'Fichier introuvable.');
    }
}