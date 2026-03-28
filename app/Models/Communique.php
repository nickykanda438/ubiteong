<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Communique extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être assignés en masse.
     * * @var array<int, string>
     */
    protected $fillable = [
        'reference',        // Ex: COM-2024-001
        'titre',
        'type',             // 'saisie' ou 'pdf'
        'contenu',          // Texte long (si type est saisie)
        'chemin_pdf',       // Chemin du fichier (si type est pdf)
        'signataire',       // Qui a signé le communiqué
        'date_publication',
        'est_actif',        // Pour gérer la visibilité
    ];

    /**
     * Les attributs qui doivent être castés (convertis automatiquement).
     */
    protected $casts = [
        'date_publication' => 'date',
        'est_actif' => 'boolean',
    ];

    /**
     * Relation : Un communiqué peut être illustré par plusieurs événements (photos).
     */
    public function events()
    {
        return $this->hasMany(Event::class);
    }

    /**
     * Relation : Un communiqué peut avoir plusieurs commentaires de membres.
     */
    public function commentaires()
    {
        // Si vous créez un modèle Commentaire plus tard
        // return $this->hasMany(Comment::class);
    }
}