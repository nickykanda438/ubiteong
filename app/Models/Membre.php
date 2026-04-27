<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Membre extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'membres';

    protected $fillable = [
        'numero_membre',
        'nom_complet',
        'date_naissance',
        'lieu_naissance',
        'genre',
        'etat_civil',
        'anciennete',
        'profession',
        'fonction',
        'date_adhesion',
        'qualite',
        'type_membre',
        'photo_membre',
        'piece_jointe',
        'piece_identite',
        'adresse_membre'
    ];

    protected $casts = [
    'date_naissance' => 'date',
    'date_adhesion' => 'date',
];

    public function getAncienneteAttribute($value)
    {
        if ($this->date_adhesion) {
            return self::calculateAncienneteFromDate($this->date_adhesion);
        }

        return $value;
    }

    public static function calculateAncienneteFromDate($dateAdhesion)
    {
        if (!$dateAdhesion) {
            return null;
        }

        $adhesion = Carbon::parse($dateAdhesion);
        $now = Carbon::now();

        if ($adhesion->greaterThan($now)) {
            return '0 mois';
        }

        $years = $adhesion->diffInYears($now);
        $months = $adhesion->copy()->addYears($years)->diffInMonths($now);

        $parts = [];
        if ($years > 0) {
            $parts[] = $years . ' an' . ($years > 1 ? 's' : '');
        }
        if ($months > 0) {
            $parts[] = $months . ' mois';
        }

        return empty($parts) ? 'Moins d’un mois' : implode(' ', $parts);
    }

    public function getPhotoUrlAttribute()
    {
        if ($this->photo_membre) {
            return asset('storage/' . $this->photo_membre);
        }
        return asset('images/default-avatar.png');
    }

    /**
     * Relation avec les crédits
     */
    public function credits()
    {
        return $this->hasMany(Credit::class);
    }
}