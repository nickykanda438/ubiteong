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
        'montant_depose' => 'decimal:2',
        'date_transaction' => 'date',
        'lien_deposant' => 'string'
    ];

    /**
     * Relation vers compte épargne
     */
    public function epargne()
    {
        return $this->belongsTo(Epargne::class, 'epargne_id');
    }

    /**
     * Alias pour montant (pour compatibilité)
     */
    public function getMontantAttribute()
    {
        return $this->montant_depose;
    }

    /**
     * Alias pour date_operation (pour compatibilité)
     */
    public function getDateOperationAttribute()
    {
        return $this->date_transaction;
    }

    /**
     * Déterminer le type basé sur le montant (positif = versement, négatif = retrait)
     */
    public function getTypeAttribute()
    {
        return $this->montant_depose >= 0 ? self::TYPE_VERSEMENT : self::TYPE_RETRAIT;
    }

    /**
     * Scope : versements uniquement (montants positifs)
     */
    public function scopeVersements($query)
    {
        return $query->where('montant_depose', '>=', 0);
    }

    /**
     * Scope : retraits uniquement (montants négatifs)
     */
    public function scopeRetraits($query)
    {
        return $query->where('montant_depose', '<', 0);
    }

    /**
     * Accesseur : libellé du type
     */
    public function getLibelleTypeAttribute()
    {
        return $this->type === self::TYPE_VERSEMENT ? 'Versement' : 'Retrait';
    }
}