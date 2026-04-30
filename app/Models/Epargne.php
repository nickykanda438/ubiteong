<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Epargne extends Model
{
    use SoftDeletes;

    /**
     * Champs autorisés
     */
    protected $fillable = [
        'numero_carte',
        'nom',
        'postnom',
        'prenom',
        'telephone',
        'adresse',
        'montant_reference', // objectif journalier indicatif
        'montant_cible',
        'frequence_engagement',
        'solde_actuel',
        'est_actif'
    ];

    /**
     * Cast des types
     */
    protected $casts = [
        'montant_reference' => 'decimal:2',
        'montant_cible' => 'decimal:2',
        'solde_actuel' => 'decimal:2',
        'est_actif' => 'boolean',
    ];

    /**
     * Nom complet
     */
    public function getNomCompletAttribute()
    {
        return trim("{$this->nom} {$this->postnom} {$this->prenom}");
    }

    /**
     * Boot model
     */
    protected static function booted()
    {
        static::creating(function ($epargne) {

            if (empty($epargne->numero_carte)) {
                $epargne->numero_carte = 'EPR-' . strtoupper(Str::random(8));
            }

            $epargne->est_actif = $epargne->est_actif ?? true;
        });
    }

    /**
     * Relation transactions
     */
    public function transactions()
    {
        return $this->hasMany(TransactionEpargne::class, 'epargne_id');
    }

    /**
     * SOLDE RÉEL (stocké dans solde_actuel)
     */
    public function getSoldeAttribute()
    {
        return $this->solde_actuel ?? 0;
    }

    /**
     * Total des versements du mois
     */
    public function getTotalVersementsMensuelAttribute()
    {
        return $this->transactions()
            ->where('montant_depose', '>=', 0)
            ->whereMonth('date_transaction', now()->month)
            ->whereYear('date_transaction', now()->year)
            ->sum('montant_depose');
    }

    /**
     * Total des retraits du mois
     */
    public function getTotalRetraitsMensuelAttribute()
    {
        return $this->transactions()
            ->where('montant_depose', '<', 0)
            ->whereMonth('date_transaction', now()->month)
            ->whereYear('date_transaction', now()->year)
            ->sum('montant_depose');
    }

    /**
     * Taux de réalisation (optionnel KPI)
     */
    public function getTauxRealisationAttribute()
    {
        if (!$this->montant_reference) {
            return 0;
        }

        $objectifMensuel = $this->montant_reference * 30;
        $total = $this->total_versements_mensuel;

        return round(($total / $objectifMensuel) * 100, 2);
    }
}