<?php

namespace App\Http\Controllers;

use App\Models\Epargne;
use App\Models\TransactionEpargne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EpargneController extends Controller
{
    /**
     * Page d'accueil des épargnes
     */
    public function index()
    {
        $epargnes = Epargne::with('transactions')->latest()->get();
        $totalEpargne = Epargne::sum('solde_actuel');
        $nombreEpargnants = Epargne::count();
        $transactionsRecentes = TransactionEpargne::with('epargne')->latest()->take(10)->get();

        return view('finance.epargne', compact('epargnes', 'totalEpargne', 'nombreEpargnants', 'transactionsRecentes'));
    }

    /**
     * 1. Création de l'épargneur (Ouverture de compte)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom'                  => 'required|string|max:255',
            'postnom'              => 'required|string|max:255',
            'prenom'               => 'required|string|max:255',
            'telephone'            => 'required|string',
            'adresse'              => 'required|string',
            'montant_cible'        => 'required|numeric|min:0',
            'frequence_engagement' => 'required|in:journalier,mensuel',
        ]);

        // Le numéro de carte est généré automatiquement par le modèle (booted)
        $epargne = Epargne::query()->create(array_merge($validated, ['solde_actuel' => 0]));

        return redirect()->back()->with('success', "Compte épargne créé avec succès. N° Carte : {$epargne->numero_carte}");
    }

    /**
     * 2. Enregistrement d'un versement (Propriétaire ou Délégué)
     */
    public function depose(Request $request)
    {
        $validated = $request->validate([
            'numero_carte'   => 'required|exists:epargnes,numero_carte',
            'montant_depose' => 'required|numeric|min:1',
            'nom_deposant'   => 'required|string', 
            'lien_deposant'  => 'required|in:proprietaire,delegue',
        ]);

        // On utilise query() pour aider l'IDE à reconnaître les méthodes
        $epargne = Epargne::query()->where('numero_carte', $validated['numero_carte'])->first();

        if (!$epargne) {
            return redirect()->back()->with('error', 'Carte d’épargne introuvable.');
        }

        DB::transaction(function () use ($epargne, $validated) {
            // 1. Créer la transaction de versement
            TransactionEpargne::query()->create([
                'epargne_id'           => $epargne->id,
                'montant_depose'       => $validated['montant_depose'],
                'date_transaction'     => now(),
                'nom_deposant'         => $validated['nom_deposant'],
                'lien_deposant'        => $validated['lien_deposant'],
                'numero_carte_utilise' => $epargne->numero_carte,
            ]);

            // 2. Mettre à jour le solde de l'épargneur
            // Remplace $epargne->increment(...) par :
Epargne::query()->where('id', $epargne->id)->increment('solde_actuel', $validated['montant_depose']);
        });

        return redirect()->back()->with('success', 'Versement validé avec succès.');
    }

    /**
     * 3. Décaissement mensuel (Uniquement par le propriétaire)
     */
    public function decaisse(Request $request, $id)
    {
        // Utilisation de query() pour la recherche par ID
        $epargne = Epargne::query()->findOrFail($id);

        // Règle métier : Vérifier si un retrait (montant négatif) existe déjà ce mois-ci
        $dejaRetire = TransactionEpargne::query()
            ->where('epargne_id', $id)
            ->where('montant_depose', '<', 0) 
            ->whereMonth('date_transaction', now()->month)
            ->whereYear('date_transaction', now()->year)
            ->exists();

        if ($dejaRetire) {
            return redirect()->back()->with('error', 'Un seul décaissement est autorisé par mois.');
        }

        if ($epargne->solde_actuel <= 0) {
            return redirect()->back()->with('error', 'Le solde est insuffisant pour un décaissement.');
        }

        DB::transaction(function () use ($epargne) {
            $montantRetire = $epargne->solde_actuel;

            // Enregistrer la sortie d'argent
            TransactionEpargne::query()->create([
                'epargne_id'           => $epargne->id,
                'montant_depose'       => -$montantRetire, 
                'date_transaction'     => now(),
                'nom_deposant'         => $epargne->nom . ' ' . $epargne->prenom,
                'lien_deposant'        => 'proprietaire',
                'numero_carte_utilise' => $epargne->numero_carte,
            ]);

            // Remettre le solde à zéro
            $epargne->update(['solde_actuel' => 0]);
        });

        return redirect()->back()->with('success', 'Décaissement total effectué avec succès.');
    }
}