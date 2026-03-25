<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        'profession',
        'fonction',
        'date_adhesion',
        'qualite',
        'type_membre',
        'photo_membre',
        'piece_jointe',
        'adresse_membre'
    ];

    protected $casts = [
    'date_naissance' => 'date',
    'date_adhesion' => 'date',
];

public function getPhotoUrlAttribute()
{
    if ($this->photo_membre) {
        return asset('storage/' . $this->photo_membre);
    }
    return asset('images/default-avatar.png');
}

}