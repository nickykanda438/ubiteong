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

    public function membre(): BelongsTo
    {
        return $this->belongsTo(Membre::class);
    }

    /**
     * Accesseur : Calcul dynamique de la dette totale (Principal + Intérêts selon temps)
     */
    public function getMontantTotalDuAttribute()
    {
        $maintenant = now();
        $moisEcoules = max(1, $this->date_deblocage->diffInMonths($maintenant));

        // Taux normal 20% | Retard 40%
        $tauxMensuel = $maintenant->gt($this->date_echeance_finale) ? 0.40 : 0.20;

        return $this->montant_principal * (1 + ($tauxMensuel * $moisEcoules));
    }

    public function estEnDepassement(): bool
    {
        return now()->gt($this->date_echeance_finale) && $this->statut !== 'solde';
    }

    public function scopeEnRetard($query)
    {
        return $query->where('date_echeance_finale', '<', now())
                     ->where('statut', '!=', 'solde');
    }
}