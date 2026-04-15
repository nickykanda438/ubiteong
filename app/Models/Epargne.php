<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Epargne extends Model
{
    protected $fillable = [
        'numero_carte', 'nom', 'postnom', 'prenom', 
        'telephone', 'adresse', 'montant_cible', 
        'frequence_engagement', 'solde_actuel'
    ];

    // Accesseur pour le nom complet (Pratique pour les factures/cartes)
    public function getNomCompletAttribute()
    {
        return "{$this->nom} {$this->postnom} {$this->prenom}";
    }

    // Génération automatique du numéro de carte lors de la création
    protected static function booted()
    {
        static::creating(function ($epargne) {
            $epargne->numero_carte = 'KZZ-' . strtoupper(Str::random(8));
        });
    }

    /**
     * Relation avec les transactions (Versements du propriétaire ou délégués)
     */
    public function transactions()
    {
        return $this->hasMany(TransactionEpargne::class);
    }
}