<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('epargnes', function (Blueprint $table) {
    $table->id();
    
    // Identification unique
    $table->string('numero_carte')->unique();
    
    // Identité complète de l'épargneur
    $table->string('nom');
    $table->string('postnom');
    $table->string('prenom');
    $table->string('telephone');
    $table->text('adresse');

    // Engagement financier
    $table->decimal('montant_cible', 15, 2); // Le montant qu'il prévoit d'épargner (par jour ou mois)
    $table->enum('frequence_engagement', ['journalier', 'mensuel']); 
    
    // Situation financière actuelle
    $table->decimal('solde_actuel', 15, 2)->default(0.00);

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('epargnes');
    }
};
