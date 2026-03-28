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
        Schema::table('communiques', function (Blueprint $table) {
            $table->longText('contenu')->nullable()->change();
            $table->date('date_publication')->default(now())->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('communiques', function (Blueprint $table) {
            $table->text('contenu')->nullable()->change();
            $table->date('date_publication')->change();
        });
    }
};