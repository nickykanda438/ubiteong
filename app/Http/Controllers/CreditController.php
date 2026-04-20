<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use App\Models\Membre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CreditController extends Controller
{
    public function index(Request $request)
    {
        $membres = Membre::orderBy('nom_complet')->get();
        $query = Credit::with('membre');

        if ($request->filled('search')) {
            $query->whereHas('membre', function($q) use ($request) {
                $q->where('nom_complet', 'like', "%{$request->search}%");
            });
        }

        if ($request->filled('status')) {
            $query->whereIn('statut', (array)$request->status);
        }

        $credits = $query->latest()->get();

        // Statistiques calculées
        $stats = [
            'total_encours'   => Credit::where('statut', '!=', 'solde')->sum('montant_principal'),
            'total_rembourse' => Credit::where('statut', 'solde')->sum('montant_principal'), // Logique simplifiée
            'reste_a_payer'   => Credit::sum('reste_a_payer'),
            'total_depasse'   => Credit::enRetard()->sum('reste_a_payer'),
        ];

        return view('finance.credit', compact('membres', 'credits', 'stats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'membre_id'            => 'required|exists:membres,id',
            'montant_principal'    => 'required|numeric|min:1',
            'date_deblocage'       => 'required|date',
            'date_echeance_finale' => 'required|date|after_or_equal:date_deblocage',
        ]);

        // On initialise le reste à payer avec le premier mois d'intérêts (20%)
        $montantInitial = $request->montant_principal * 1.20;

        Credit::create([
            'membre_id'            => $request->membre_id,
            'montant_principal'    => $request->montant_principal,
            'reste_a_payer'        => $montantInitial,
            'date_deblocage'       => $request->date_deblocage,
            'date_echeance_finale' => $request->date_echeance_finale,
            'statut'               => 'en_cours',
        ]);

        return redirect()->route('finance.credit')->with('success', 'Crédit accordé avec succès.');
    }

    public function show($id)
    {
        $credit = Credit::with(['membre'])->findOrFail($id);
        
        if ($credit->statut === 'en_cours' && $credit->date_echeance_finale < now()) {
            $credit->statut = 'en_retard';
            $credit->save();
        }

        return view('finance.credit_show', compact('credit'));
    }

    public function rembourser(Request $request, $id)
    {
        $request->validate(['montant' => 'required|numeric|min:1']);
        $credit = Credit::findOrFail($id);
        
        DB::transaction(function () use ($credit, $request) {
            $credit->reste_a_payer -= $request->montant;
            if ($credit->reste_a_payer <= 0) {
                $credit->reste_a_payer = 0;
                $credit->statut = 'solde';
            }
            $credit->save();
        });

        return back()->with('success', 'Remboursement enregistré.');
    }
}