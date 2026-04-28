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
            // Ajouter montant_reference s'il n'existe pas
            if (!Schema::hasColumn('epargnes', 'montant_reference')) {
                $table->decimal('montant_reference', 15, 2)->nullable()->after('adresse')
                    ->comment('Objectif journalier indicatif en FC');
            }
        });

        // Mettre à jour les colonnes existantes pour améliorer la cohérence
        Schema::table('epargnes', function (Blueprint $table) {
            // S'assurer que tous les montants sont bien en decimal(15,2)
            if (Schema::hasColumn('epargnes', 'montant_cible')) {
                $table->decimal('montant_cible', 15, 2)->change();
            }

            if (Schema::hasColumn('epargnes', 'solde_actuel')) {
                $table->decimal('solde_actuel', 15, 2)->default(0.00)->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('epargnes', function (Blueprint $table) {
            if (Schema::hasColumn('epargnes', 'montant_reference')) {
                $table->dropColumn('montant_reference');
            }
        });
    }
};
