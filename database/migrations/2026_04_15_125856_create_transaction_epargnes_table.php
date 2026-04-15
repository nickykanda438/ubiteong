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
    Schema::create('transaction_epargnes', function (Blueprint $table) {
        $table->id();
        
        // Liaison avec la table epargnes
        $table->foreignId('epargne_id')->constrained()->onDelete('cascade');
        
        // Détails de la transaction
        $table->decimal('montant_depose', 15, 2);
        $table->date('date_transaction');
        
        // Identification de celui qui apporte l'argent
        $table->string('nom_deposant'); // Nom de la personne physiquement présente
        $table->enum('lien_deposant', ['proprietaire', 'delegue'])->default('proprietaire');
        
        // Numéro de carte saisi ou scanné lors de l'opération (pour audit)
        $table->string('numero_carte_utilise');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_epargnes');
    }
};
