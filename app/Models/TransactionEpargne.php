<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionEpargne extends Model
{
    /**
     * Types de transactions (logique métier)
     */
    const TYPE_VERSEMENT = 'versement';
    const TYPE_RETRAIT = 'retrait';

    /**
     * Table (optionnel mais recommandé si nom complexe)
     */
    protected $table = 'transaction_epargnes';

    /**
     * Champs autorisés
     */
    protected $fillable = [
        'epargne_id',
        'montant_depose',
        'date_transaction',
        'nom_deposant',
        'lien_deposant',
        'numero_carte_utilise'
    ];

    /**
     * Casts
     */
    protected $casts = [
        'montant_depose'   => 'decimal:2',
        'date_transaction' => 'date',
        'lien_deposant'    => 'string'
    ];

    /**
     * Relation : une transaction appartient à une épargne
     */
    public function epargne()
    {
        return $this->belongsTo(Epargne::class, 'epargne_id');
    }

    /**
     * Alias montant (compatibilité)
     */
    public function getMontantAttribute()
    {
        return $this->montant_depose;
    }

    /**
     * Alias date_operation (compatibilité)
     */
    public function getDateOperationAttribute()
    {
        return $this->date_transaction;
    }

    /**
     * Type de transaction (VERSION UNIQUE CORRIGÉE)
     * - montant >= 0 => versement
     * - montant < 0  => retrait
     */
    public function getTypeAttribute()
    {
        return $this->montant_depose >= 0
            ? self::TYPE_VERSEMENT
            : self::TYPE_RETRAIT;
    }

    /**
     * Libellé lisible du type
     */
    public function getLibelleTypeAttribute()
    {
        return $this->type === self::TYPE_VERSEMENT
            ? 'Versement'
            : 'Retrait';
    }

    /**
     * Scope : versements
     */
    public function scopeVersements($query)
    {
        return $query->where('montant_depose', '>=', 0);
    }

    /**
     * Scope : retraits
     */
    public function scopeRetraits($query)
    {
        return $query->where('montant_depose', '<', 0);
    }
}