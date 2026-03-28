<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être assignés en masse.
     * * @var array<int, string>
     */
    protected $fillable = [
        'titre',
        'description',
        'photo_path',      
        'date_evenement',
        'lieu',
        'communique_id',   
    ];

    /**
     * Les attributs qui doivent être castés (convertis).
     */
    protected $casts = [
        'date_evenement' => 'date',
    ];

    /**
     * Relation : Un événement peut être lié à un communiqué officiel.
     */
    public function communique()
    {
        return $this->belongsTo(Communique::class);
    }
}