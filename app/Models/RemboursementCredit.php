<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RemboursementCredit extends Model
{
    protected $fillable = [
        'credit_id',
        'montant_paye',
        'date_paiement',
        'mode_paiement',
        'commentaire',
        'reste_avant',
        'reste_apres',
    ];

    protected $casts = [
        'date_paiement' => 'date',
        'montant_paye' => 'decimal:2',
        'reste_avant' => 'decimal:2',
        'reste_apres' => 'decimal:2',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATION
    |--------------------------------------------------------------------------
    */
    public function credit(): BelongsTo
    {
        return $this->belongsTo(Credit::class);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    public function scopeForCredit($query, $creditId)
    {
        return $query->where('credit_id', $creditId);
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('date_paiement', 'desc')->orderBy('created_at', 'desc');
    }
}
