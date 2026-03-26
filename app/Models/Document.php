<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'numero_doc',
        'type_doc',
        'titre',
        'description',
        'format',
        'file_path',
        'date_insertion',
    ];

    // Cast pour manipuler la date facilement avec Carbon
    protected $casts = [
        'date_insertion' => 'date',
    ];
}
