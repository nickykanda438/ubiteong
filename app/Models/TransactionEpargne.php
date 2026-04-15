<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionEpargne extends Model
{
    /**
     * Les attributs qui peuvent être assignés en masse.
     * On y retrouve l'identité de celui qui dépose l'argent.
     */
    protected $fillable = [
        'epargne_id',
        'montant_depose',
        'date_transaction',
        'nom_deposant',      // Nom de la personne physique présente au guichet
        'lien_deposant',     // 'proprietaire' ou 'delegue'
        'numero_carte_utilise'
    ];

    /**
     * Cast des attributs pour faciliter les calculs et le formatage des dates.
     */
    protected $casts = [
        'date_transaction' => 'date',
        'montant_depose'   => 'decimal:2',
    ];

    /**
     * RELATION : Chaque transaction appartient à un compte d'épargne.
     * Cela permettra de récupérer les infos de l'épargneur (identité, adresse, etc.)
     * Usage : $transaction->epargne->nom
     */
    public function epargne(): BelongsTo
    {
        return $this->belongsTo(Epargne::class);
    }

    /**
     * SCOPE : Pour récupérer uniquement les transactions faites par des délégués.
     * Usage : TransactionEpargne::parDelegues()->get();
     */
    public function scopeParDelegues($query)
    {
        return $query->where('lien_deposant', 'delegue');
    }

    /**
     * SCOPE : Pour le rapport de la journée en cours.
     * Usage : TransactionEpargne::aujourdhui()->sum('montant_depose');
     */
    public function scopeAujourdhui($query)
    {
        return $query->whereDate('date_transaction', now()->toDateString());
    }
}