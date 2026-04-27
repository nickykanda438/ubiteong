<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionEpargne extends Model
{
    /**
     * Types de transactions
     */
    const TYPE_VERSEMENT = 'versement';
    const TYPE_RETRAIT = 'retrait';

    /**
     * Champs autorisés
     */
    protected $fillable = [
        'epargne_id',
        'montant',
        'type',
        'date_operation'
    ];

    /**
     * Casts
     */
    protected $casts = [
        'montant' => 'decimal:2',
        'date_operation' => 'date',
    ];

    /**
     * Relation vers compte épargne
     */
    public function epargne()
    {
        return $this->belongsTo(Epargne::class, 'epargne_id');
    }
}