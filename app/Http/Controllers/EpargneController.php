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

        $validated['montant_cible'] = $validated['montant_reference'] ?? 0;
        $validated['frequence_engagement'] = 'journalier';
        $validated['solde_actuel'] = 0;

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
            'nom_deposant' => 'required|string',
            'lien_deposant' => 'required|in:proprietaire,delegue',
        ]);

        $epargne = Epargne::where('numero_carte', $validated['numero_carte'])->firstOrFail();

        DB::transaction(function () use ($epargne, $validated) {
            TransactionEpargne::create([
                'epargne_id' => $epargne->id,
                'montant_depose' => $validated['montant'],
                'date_transaction' => now(),
                'nom_deposant' => $validated['nom_deposant'],
                'lien_deposant' => $validated['lien_deposant'],
                'numero_carte_utilise' => $validated['numero_carte'],
            ]);

            // Mettre à jour le solde
            $epargne->solde_actuel += $validated['montant'];
            $epargne->save();
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
            'montant' => 'required|numeric|min:1',
        ]);

        $epargne = Epargne::where('numero_carte', $validated['numero_carte'])->firstOrFail();

        $montant = $validated['montant'];

        if ($montant > $epargne->solde) {
            return back()->with('error', 'Solde insuffisant.');
        }

        DB::transaction(function () use ($epargne, $montant, $validated) {
            // Enregistrer la transaction (montant négatif pour retrait)
            TransactionEpargne::create([
                'epargne_id' => $epargne->id,
                'montant_depose' => -$montant,
                'date_transaction' => now(),
                'nom_deposant' => 'Retrait',
                'lien_deposant' => 'proprietaire',
                'numero_carte_utilise' => $validated['numero_carte'],
            ]);

            // Mettre à jour le solde
            $epargne->solde_actuel -= $montant;
            $epargne->save();
        });

        return back()->with('success', 'Retrait effectué avec succès.');
    }

    /**
     * Évolution de l'épargne (historique détaillé)
     */
    public function evolution_epargne($id)
    {
        $epargne = Epargne::with('transactions')->findOrFail($id);
        
        $historique = TransactionEpargne::where('epargne_id', $id)
            ->orderBy('date_transaction', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        $transactions = TransactionEpargne::where('epargne_id', $id)
            ->select(
                DB::raw('DATE(date_transaction) as date'),
                DB::raw('SUM(montant_depose) as montant'),
                'nom_deposant',
                'lien_deposant'
            )
            ->groupBy(DB::raw('DATE(date_transaction)'), 'nom_deposant', 'lien_deposant')
            ->orderBy('date')
            ->get();

        $currentYearMonth = now()->format('Y-m');
        $daysInMonth = now()->daysInMonth;

        return view('finance.evolution_epargne', compact(
            'epargne',
            'historique',
            'transactions',
            'currentYearMonth',
            'daysInMonth'
        ));
    }
}