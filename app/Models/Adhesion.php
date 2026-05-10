<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Adhesion extends Model
{
    protected $fillable = [
        'nom_complet',
        'email_ou_telephone',
        'categorie',
    ];
}
