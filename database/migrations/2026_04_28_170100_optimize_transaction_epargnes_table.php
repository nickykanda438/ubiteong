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
        Schema::table('transaction_epargnes', function (Blueprint $table) {
            // Optimiser les décimales pour la cohérence
            if (Schema::hasColumn('transaction_epargnes', 'montant_depose')) {
                $table->decimal('montant_depose', 15, 2)->change();
            }

            // Ajouter un index sur epargne_id si absent
            if (!Schema::hasIndex('transaction_epargnes', 'transaction_epargnes_epargne_id_foreign')) {
                $table->index('epargne_id');
            }

            // Ajouter un index sur date_transaction pour les tris
            if (!Schema::hasIndex('transaction_epargnes', 'transaction_epargnes_date_transaction_index')) {
                $table->index('date_transaction');
            }

            // Ajouter un index sur lien_deposant pour les filtres
            if (!Schema::hasIndex('transaction_epargnes', 'transaction_epargnes_lien_deposant_index')) {
                $table->index('lien_deposant');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaction_epargnes', function (Blueprint $table) {
            $table->dropIndexIfExists('transaction_epargnes_lien_deposant_index');
            $table->dropIndexIfExists('transaction_epargnes_date_transaction_index');
        });
    }
};

