<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use App\Models\Membre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CreditController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LISTE DES CRÉDITS + FILTRES + STATISTIQUES
    |--------------------------------------------------------------------------
    */
    public function index(Request $request)
    {
        $membres = Membre::orderBy('nom_complet')->get();

        $query = Credit::with('membre');

        // Recherche par nom
        if ($request->filled('search')) {
            $query->whereHas('membre', function ($q) use ($request) {
                $q->where('nom_complet', 'like', "%{$request->search}%");
            });
        }

        // Filtre statut
        if ($request->filled('status')) {
            $query->whereIn('statut', (array)$request->status);
        }

        $credits = $query->latest()->get();

        /*
        |--------------------------------------------------------------------------
        | MISE À JOUR AUTOMATIQUE DES STATUTS
        |--------------------------------------------------------------------------
        */
        foreach ($credits as $credit) {
            if ($credit->estEnDepassement() && $credit->statut !== 'solde') {
                $credit->statut = 'en_retard';
                $credit->save();
            }
        }

        /*
        |--------------------------------------------------------------------------
        | STATISTIQUES BASÉES SUR LES CALCULS DU MODÈLE
        |--------------------------------------------------------------------------
        */
        $stats = [
            'total_encours' => $credits
                ->where('statut', '!=', 'solde')
                ->sum(fn($c) => $c->montant_total_du),

            'total_rembourse' => $credits
                ->where('statut', 'solde')
                ->sum(fn($c) => $c->montant_principal),

            'reste_a_payer' => $credits
                ->sum(fn($c) => $c->reste_a_payer),

            'total_depasse' => $credits
                ->filter(fn($c) => $c->estEnDepassement())
                ->sum(fn($c) => $c->montant_total_du),
        ];

        return view('finance.credit', compact('membres', 'credits', 'stats'));
    }

    /*
    |--------------------------------------------------------------------------
    | ENREGISTRER UN NOUVEAU CRÉDIT
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'membre_id'            => 'required|exists:membres,id',
            'montant_principal'    => 'required|numeric|min:1',
            'date_deblocage'       => 'required|date',
            'date_echeance_finale' => 'required|date|after_or_equal:date_deblocage',
            'devise'               => 'required|in:CDF,USD',
        ]);

        // Vérification durée max = 6 mois
        $debut = Carbon::parse($request->date_deblocage);
        $fin   = Carbon::parse($request->date_echeance_finale);

        if ($debut->diffInMonths($fin) > 6) {
            return back()->withErrors([
                'date_echeance_finale' => 'La durée maximale est de 6 mois.'
            ]);
        }

        Credit::create([
            'membre_id'            => $request->membre_id,
            'montant_principal'    => $request->montant_principal,
            'reste_a_payer'        => $request->montant_principal, // sans intérêt
            'date_deblocage'       => $request->date_deblocage,
            'date_echeance_finale' => $request->date_echeance_finale,
            'devise'               => $request->devise,
            'statut'               => 'en_cours',
        ]);

        return redirect()->route('finance.credit')
            ->with('success', 'Crédit accordé avec succès.');
    }

    /*
    |--------------------------------------------------------------------------
    | DÉTAIL D’UN CRÉDIT
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        $credit = Credit::with('membre')->findOrFail($id);

        // Mise à jour du statut
        if ($credit->estEnDepassement()) {
            $credit->statut = 'en_retard';
            $credit->save();
        }

        return view('finance.credit_show', compact('credit'));
    }

    /*
    |--------------------------------------------------------------------------
    | REMBOURSEMENT
    |--------------------------------------------------------------------------
    */
    public function rembourser(Request $request, $id)
    {
        $request->validate([
            'montant' => 'required|numeric|min:1'
        ]);

        $credit = Credit::findOrFail($id);

        DB::transaction(function () use ($credit, $request) {

            // Montant restant actuel
            $resteActuel = $credit->reste_a_payer;

            // Nouveau reste
            $nouveauReste = $resteActuel - $request->montant;

            if ($nouveauReste <= 0) {
                $credit->reste_a_payer = 0;
                $credit->statut = 'solde';
            } else {
                $credit->reste_a_payer = $nouveauReste;
            }

            $credit->save();
        });

        return back()->with('success', 'Remboursement enregistré avec succès.');
    }

    // credit en retard 
    public function enRetard()
    {
        $credits = Credit::with('membre')->enRetard()->get();

        return view('finance.credit_retard', compact('credits'));
    }
}