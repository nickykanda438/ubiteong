<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('membres', function (Blueprint $table) {
            $table->id();
            
            // Identifiants
            $table->string('numero_membre')->unique();
            $table->string('nom_complet');
            
            // Infos personnelles
            $table->date('date_naissance');
            $table->string('lieu_naissance');
            $table->string('genre'); // Masculin ou Féminin
            $table->string('profession');
            
            // Infos ONG
            $table->string('fonction');
            $table->date('date_adhesion');
            
            // MODIFICATION : Ajout de nullable() car ce champ peut être vide selon tes tests
            $table->string('qualite')->nullable(); 
            
            $table->string('type_membre');
            
            // Fichiers
            $table->string('photo_membre')->nullable();
            $table->string('piece_jointe')->nullable();
            
            // Localisation : Utilisation de text() pour les adresses longues
            $table->text('adresse_membre');
            
            // Options Laravel
            $table->softDeletes(); // Pour ne pas supprimer définitivement (corbeille)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('membres');
    }
};