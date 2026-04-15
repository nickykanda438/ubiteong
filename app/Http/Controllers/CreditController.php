<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CreditController extends Controller
{
    /**
     * Enregistrer un nouveau crédit
     */
    public function store(Request $request)
    {
        $request->validate([
            'membre_id'         => 'required|exists:membres,id',
            'montant_principal' => 'required|numeric|min:1',
            'date_deblocage'    => 'required|date',
            // Règle : La date d'échéance ne doit pas dépasser 6 mois après le déblocage
            'date_echeance_finale' => [
                'required',
                'date',
                'after:date_deblocage',
                function ($attribute, $value, $fail) use ($request) {
                    $deblocage = Carbon::parse($request->date_deblocage);
                    $echeance = Carbon::parse($value);
                    if ($deblocage->diffInMonths($echeance) > 6) {
                        $fail("Le crédit ne peut pas dépasser une durée de 6 mois.");
                    }
                },
            ],
        ]);

        Credit::create([
            'membre_id'            => $request->membre_id,
            'montant_principal'    => $request->montant_principal,
            'reste_a_payer'        => $request->montant_principal, // Initialement égal au principal
            'date_deblocage'       => $request->date_deblocage,
            'date_echeance_finale' => $request->date_echeance_finale,
            'statut'               => 'en_cours',
        ]);

        return redirect()->back()->with('success', 'Crédit accordé avec succès.');
    }

    /**
     * Enregistrer un remboursement mensuel
     */
    public function rembourser(Request $request, $id)
    {
        $request->validate([
            'montant_rembourse' => 'required|numeric|min:1',
        ]);

        $credit = Credit::findOrFail($id);

        // On utilise une transaction pour garantir la cohérence des données
        DB::transaction(function () use ($credit, $request) {
            // Mise à jour du reste à payer
            $credit->reste_a_payer -= $request->montant_rembourse;

            // Si le solde est atteint ou dépassé, on marque comme soldé
            if ($credit->reste_a_payer <= 0) {
                $credit->reste_a_payer = 0;
                $credit->statut = 'solde';
            }

            $credit->save();
        });

        return redirect()->back()->with('success', 'Remboursement enregistré.');
    }

    /**
     * Afficher les détails d'un crédit (avec le calcul des intérêts)
     */
    public function show($id)
    {
        $credit = Credit::with('membre')->findOrFail($id);
        
        // On récupère le montant total dû (calculé par l'Accesseur du modèle)
        $montantTotalDu = $credit->montant_total_du; 
        
        return view('finance.credits.show', compact('credit', 'montantTotalDu'));
    }

    /**
     * Liste des crédits en retard (Taux doublé)
     */
    public function enRetard()
    {
        // Utilisation du scope défini dans le modèle
        $creditsEnRetard = Credit::enRetard()->with('membre')->get();
        
        return view('finance.credits.retard', compact('creditsEnRetard'));
    }
}