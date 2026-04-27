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
        'observations',
        'devise',
    ];

    protected $casts = [
        'date_deblocage' => 'date',
        'date_echeance_finale' => 'date',
        'montant_principal' => 'decimal:2',
        'reste_a_payer' => 'decimal:2',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATION
    |--------------------------------------------------------------------------
    */
    public function membre(): BelongsTo
    {
        return $this->belongsTo(Membre::class);
    }

    public function remboursements()
    {
        return $this->hasMany(RemboursementCredit::class);
    }

    /*
    |--------------------------------------------------------------------------
    | CALCUL DES MOIS (NORMAL + RETARD)
    |--------------------------------------------------------------------------
    */
    public function getMoisDetailsAttribute(): array
    {
        if (!$this->date_deblocage || !$this->date_echeance_finale) {
            return ['normaux' => 0, 'retard' => 0];
        }

        $now = now();

        // Mois total écoulé depuis le début
        $moisTotal = $this->date_deblocage->diffInMonths($now);

        // Mois jusqu'à l'échéance (max 6 mois logique métier)
        $moisNormaux = $this->date_deblocage->diffInMonths(
            min($this->date_echeance_finale, $now)
        );

        // Mois de retard
        $moisRetard = max(0, $moisTotal - $moisNormaux);

        return [
            'normaux' => $moisNormaux,
            'retard'  => $moisRetard,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | CALCUL DES INTÉRÊTS ET TOTAL DÛ
    |--------------------------------------------------------------------------
    */
    public function getMontantTotalDuAttribute()
    {
        if (!$this->date_deblocage) {
            return $this->montant_principal;
        }

        if ($this->estEnDepassement()) {
            return $this->montant_principal + ($this->montant_principal * 0.40);
        }

        return $this->montant_principal;
    }

    public function getPaiementMensuelAttribute()
    {
        return $this->montant_principal * 0.20;
    }

    /*
    |--------------------------------------------------------------------------
    | PÉNALITÉ DE RETARD (POUR AFFICHAGE)
    |--------------------------------------------------------------------------
    */
    public function getInteretTotalAttribute()
    {
        if ($this->estEnDepassement()) {
            return $this->montant_principal * 0.40;
        }

        return 0;
    }

    /*
    |--------------------------------------------------------------------------
    | DÉTECTION DU RETARD
    |--------------------------------------------------------------------------
    */
    public function estEnDepassement(): bool
    {
        return $this->date_echeance_finale
            && now()->gt($this->date_echeance_finale)
            && $this->statut !== 'solde';
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPE : CRÉDITS EN RETARD
    |--------------------------------------------------------------------------
    */
    public function scopeEnRetard($query)
    {
        return $query->where('date_echeance_finale', '<', now())
                     ->where('statut', '!=', 'solde');
    }

    // Formatage du montant total pour affichage 
    public function getMontantFormateAttribute(): string
    {
        return number_format($this->montant_total_du, 2) . ' ' . $this->devise;
    }

    // status actuel du crédit (en cours ou en retard)
    public function getStatutActuelAttribute(): string
    {
        if ($this->statut === 'solde') {
            return 'solde';
        }

        return $this->estEnDepassement() ? 'en_retard' : 'en_cours';
    }
}