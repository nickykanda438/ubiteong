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
        Schema::create('remboursement_credits', function (Blueprint $table) {
            $table->id();

            // Liaison avec la table credits
            $table->foreignId('credit_id')->constrained()->onDelete('cascade');

            // Détails du remboursement
            $table->decimal('montant_paye', 15, 2);
            $table->date('date_paiement');
            $table->enum('mode_paiement', ['Espece', 'Banque', 'Mobile Money']);
            $table->text('commentaire')->nullable();

            // Informations calculées
            $table->decimal('reste_avant', 15, 2); // Reste avant ce paiement
            $table->decimal('reste_apres', 15, 2); // Reste après ce paiement

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remboursement_credits');
    }
};
