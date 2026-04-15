<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Credit extends Model
{
    protected $fillable = [
        'membre_id',
        'montant_principal',
        'reste_a_payer',
        'date_deblocage',
        'date_echeance_finale',
        'statut',
        'observations'
    ];

    protected $casts = [
        'date_deblocage' => 'date',
        'date_echeance_finale' => 'date',
        'montant_principal' => 'decimal:2',
        'reste_a_payer' => 'decimal:2',
    ];

    /**
     * Relation avec le membre
     */
    public function membre(): BelongsTo
    {
        return $this->belongsTo(Membre::class);
    }

    /**
     * Accesseur pour calculer dynamiquement le montant total dû avec intérêts
     * Utilisation : $credit->montant_total_du
     */
    public function getMontantTotalDuAttribute()
    {
        $maintenant = now();
        
        // Calcul du nombre de mois entiers écoulés depuis le début
        // On utilise max(1, ...) pour compter au moins le premier mois
        $moisEcoules = max(1, $this->date_deblocage->diffInMonths($maintenant));

        // Règle : Si on dépasse l'échéance (6 mois), le taux est doublé
        // Taux normal : 20% (0.20) | Taux retard : 40% (0.40)
        $tauxMensuel = $maintenant->gt($this->date_echeance_finale) ? 0.40 : 0.20;

        // Formule : Principal + (Principal * Taux * Mois)
        return $this->montant_principal * (1 + ($tauxMensuel * $moisEcoules));
    }

    /**
     * Vérifier si le crédit est actuellement en situation de dépassement
     */
    public function estEnDepassement(): bool
    {
        return now()->gt($this->date_echeance_finale) && $this->statut !== 'solde';
    }

    /**
     * Scope pour filtrer les crédits qui ont dépassé les 6 mois
     */
    public function scopeEnRetard($query)
    {
        return $query->where('date_echeance_finale', '<', now())
                     ->where('statut', '!=', 'solde');
    }
}