<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use App\Models\Epargne;
use App\Models\Membre;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CreditController extends Controller
{
    /**
     * Dashboard Finance : Affiche les statistiques globales et les activités récentes
     */
    public function index()
    {
        // 1. Statistiques des Crédits
        $statsCredits = [
            'total_octroye' => Credit::sum('montant_principal'),
            'total_restant' => Credit::where('statut', 'en_cours')->sum('reste_a_payer'),
            'nb_en_retard'  => Credit::enRetard()->count(),
        ];

        // 2. Statistiques et Données des Épargnes (Dépôts)
        try {
            $totalEpargne = Epargne::sum('solde'); 
            $deposits = Epargne::with('membre')->latest()->take(5)->get();
        } catch (\Exception $e) {
            $totalEpargne = 0;
            $deposits = collect();
        }

        // 3. Activités récentes pour le tableau des crédits
        $creditsRecents = Credit::with('membre')
            ->latest()
            ->take(10)
            ->get();

        // 4. Liste des membres triée par 'nom_complet'
        $membres = Membre::orderBy('nom_complet')->get();

        return view('finance.index', compact('statsCredits', 'totalEpargne', 'creditsRecents', 'membres', 'deposits'));
    }

    /**
     * Affiche le formulaire de création de crédit (Fichier credit.blade.php)
     */
    public function create()
    {
        $membres = Membre::orderBy('nom_complet')->get();
        
        // On cible directement le fichier credit.blade.php dans le dossier finance
        return view('finance.credit', compact('membres'));
    }

    /**
     * Enregistrer un nouveau crédit
     */
    public function store(Request $request)
    {
        $request->validate([
            'membre_id'         => 'required|exists:membres,id',
            'montant_principal' => 'required|numeric|min:1',
            'date_deblocage'    => 'required|date',
            'date_echeance_finale' => [
                'required',
                'date',
                'after:date_deblocage',
                function ($attribute, $value, $fail) use ($request) {
                    $deblocage = Carbon::parse($request->date_deblocage);
                    $echeance = Carbon::parse($value);
                    if ($deblocage && $deblocage->diffInMonths($echeance) > 6) {
                        $fail("Le crédit ne peut pas dépasser une durée de 6 mois.");
                    }
                },
            ],
        ]);

        Credit::create([
            'membre_id'            => $request->membre_id,
            'montant_principal'    => $request->montant_principal,
            'reste_a_payer'        => $request->montant_principal,
            'date_deblocage'       => $request->date_deblocage,
            'date_echeance_finale' => $request->date_echeance_finale,
            'statut'               => 'en_cours',
        ]);

        return redirect()->route('finance.index')->with('success', 'Crédit accordé avec succès.');
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

        DB::transaction(function () use ($credit, $request) {
            $credit->reste_a_payer -= $request->montant_rembourse;

            if ($credit->reste_a_payer <= 0) {
                $credit->reste_a_payer = 0;
                $credit->statut = 'solde';
            }

            $credit->save();
        });

        return redirect()->back()->with('success', 'Remboursement enregistré.');
    }

    /**
     * Afficher les détails d'un crédit
     */
    public function show($id)
    {
        $credit = Credit::with('membre')->findOrFail($id);
        $montantTotalDu = $credit->montant_total_du; 
        
        return view('finance.credits.show', compact('credit', 'montantTotalDu'));
    }

    /**
     * Liste des crédits en retard
     */
    public function enRetard()
    {
        $creditsEnRetard = Credit::enRetard()->with('membre')->get();
        return view('finance.credits.retard', compact('creditsEnRetard'));
    }
}