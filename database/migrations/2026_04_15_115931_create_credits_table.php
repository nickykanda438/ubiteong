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
        Schema::create('credits', function (Blueprint $table) {
            $table->id();
            
            // Relation avec le membre (Assurez-vous que la table 'membres' existe)
            $table->foreignId('membre_id')->constrained()->onDelete('cascade');

            // Informations financières
            // 15 chiffres au total, 2 après la virgule (ex: 999 999 999 999.99)
            $table->decimal('montant_principal', 15, 2);
            $table->decimal('reste_a_payer', 15, 2); 

            // Gestion du temps (Règle des 6 mois max à valider dans le Controller)
            $table->date('date_deblocage');
            $table->date('date_echeance_finale');

            // Suivi du statut
            // 'en_cours', 'solde', 'en_retard'
            $table->string('statut')->default('en_cours');

            // Audit
            $table->text('observations')->nullable(); // Pour des notes éventuelles
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credits');
    }
};