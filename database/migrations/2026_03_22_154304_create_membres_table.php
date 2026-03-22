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
        Schema::create('membres', function (Blueprint $table) {
            $table->id();
            $table->string('numero_membre')->unique();
            $table->string('nom_complet');
            $table->date('date_naissance');
            $table->string('lieu_naissance');
            $table->string('genre'); // M ou F
            $table->string('profession');
            $table->string('fonction');
            $table->date('date_adhesion');
            $table->string('qualite');
            $table->string('type_membre');
            $table->string('photo_membre')->nullable();
            $table->string('piece_jointe')->nullable();
            $table->text('adresse_membre');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membres');
    }
};
