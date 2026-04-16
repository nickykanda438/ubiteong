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

        // 3. Activités récentes
        $creditsRecents = Credit::with('membre')
            ->latest()
            ->take(10)
            ->get();

        // 4. Liste des membres triée par 'nom_complet'
        $membres = Membre::orderBy('nom_complet')->get();

        return view('finance.index', compact('statsCredits', 'totalEpargne', 'creditsRecents', 'membres', 'deposits'));
    }

    /**
     * Affiche la vue des crédits (Tableau + Formulaire Modal)
     */
    public function create()
    {
        // On récupère les membres pour le select du formulaire
        $membres = Membre::orderBy('nom_complet')->get();
        
        // CORRECTION : On récupère la liste des crédits pour alimenter le tableau de la vue
        $credits = Credit::with('membre')
            ->latest()
            ->get();
        
        // On passe 'membres' ET 'credits' à la vue finance.credit
        return view('finance.credit', compact('membres', 'credits'));
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

        // Redirection vers la page de création/liste des crédits avec succès
        return redirect()->route('finance.credits.create')->with('success', 'Crédit accordé avec succès.');
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
        
        // Note: Assurez-vous que l'attribut montant_total_du existe dans votre modèle Credit
        $montantTotalDu = $credit->montant_total_du ?? ($credit->montant_principal * 1.2); 
        
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