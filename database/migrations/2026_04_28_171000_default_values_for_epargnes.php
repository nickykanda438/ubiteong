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
        Schema::table('epargnes', function (Blueprint $table) {
            if (Schema::hasColumn('epargnes', 'montant_cible')) {
                $table->decimal('montant_cible', 15, 2)->default(0)->change();
            }

            if (Schema::hasColumn('epargnes', 'frequence_engagement')) {
                $table->enum('frequence_engagement', ['journalier', 'mensuel'])->default('journalier')->change();
            }

            if (Schema::hasColumn('epargnes', 'solde_actuel')) {
                $table->decimal('solde_actuel', 15, 2)->default(0)->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('epargnes', function (Blueprint $table) {
            if (Schema::hasColumn('epargnes', 'montant_cible')) {
                $table->decimal('montant_cible', 15, 2)->nullable()->change();
            }

            if (Schema::hasColumn('epargnes', 'frequence_engagement')) {
                $table->enum('frequence_engagement', ['journalier', 'mensuel'])->nullable()->change();
            }

            if (Schema::hasColumn('epargnes', 'solde_actuel')) {
                $table->decimal('solde_actuel', 15, 2)->default(0)->change();
            }
        });
    }
};
