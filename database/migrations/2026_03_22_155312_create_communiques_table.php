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
        Schema::create('communiques', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->string('titre');
            
            // On ajoute un type pour savoir si c'est une saisie ou un fichier
            $table->enum('type', ['saisie', 'pdf'])->default('saisie');
            
            // Le contenu devient nullable (facultatif si c'est un PDF)
            $table->text('contenu')->nullable();
            
            // Nouveau champ pour stocker le chemin du fichier PDF
            $table->string('chemin_pdf')->nullable();
            
            $table->string('signataire')->nullable();
            $table->date('date_publication');
            $table->boolean('est_actif')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('communiques');
    }
};