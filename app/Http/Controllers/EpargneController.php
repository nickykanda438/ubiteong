<?php

namespace App\Http\Controllers;

use App\Models\Epargne;
use App\Models\TransactionEpargne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EpargneController extends Controller
{
    /**
     * Liste des comptes épargne
     */
    public function index()
    {
        $epargnes = Epargne::with('transactions')->latest()->get();

        $totalEpargne = $epargnes->sum(fn($e) => $e->solde);
        $nombreEpargnants = $epargnes->count();

        $transactionsRecentes = TransactionEpargne::with('epargne')
            ->latest()
            ->take(10)
            ->get();

        return view('finance.epargne', compact(
            'epargnes',
            'totalEpargne',
            'nombreEpargnants',
            'transactionsRecentes'
        ));
    }

    /**
     * Création compte épargne
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string',
            'postnom' => 'required|string',
            'prenom' => 'required|string',
            'telephone' => 'required|string',
            'adresse' => 'required|string',
            'montant_reference' => 'nullable|numeric|min:0',
        ]);

        $epargne = Epargne::create($validated);

        return back()->with(
            'success',
            "Compte créé avec succès. N° : {$epargne->numero_carte}"
        );
    }

    /**
     * Dépôt (par numéro de carte)
     */
    public function depose(Request $request)
    {
        $validated = $request->validate([
            'numero_carte' => 'required|exists:epargnes,numero_carte',
            'montant' => 'required|numeric|min:1',
        ]);

        $epargne = Epargne::where('numero_carte', $validated['numero_carte'])->firstOrFail();

        DB::transaction(function () use ($epargne, $validated) {
            TransactionEpargne::create([
                'epargne_id' => $epargne->id,
                'montant' => $validated['montant'],
                'type' => TransactionEpargne::TYPE_VERSEMENT,
                'date_operation' => now(),
            ]);
        });

        return back()->with('success', 'Dépôt effectué avec succès.');
    }

    /**
     * Retrait (UNIFIÉ avec numéro de carte)
     */
    public function retrait(Request $request)
    {
        $validated = $request->validate([
            'numero_carte' => 'required|exists:epargnes,numero_carte',
            'montant' => 'nullable|numeric|min:1',
        ]);

        $epargne = Epargne::where('numero_carte', $validated['numero_carte'])->firstOrFail();

        $montant = $validated['montant'] ?? $epargne->solde;

        if ($montant > $epargne->solde) {
            return back()->with('error', 'Solde insuffisant.');
        }

        DB::transaction(function () use ($epargne, $montant) {

            TransactionEpargne::create([
                'epargne_id' => $epargne->id,
                'montant' => $montant,
                'type' => TransactionEpargne::TYPE_RETRAIT,
                'date_operation' => now(),
            ]);
        });

        return back()->with('success', 'Retrait effectué avec succès.');
    }
}