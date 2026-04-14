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
        Schema::table('membres', function (Blueprint $table) {
            $table->string('etat_civil')->nullable()->after('genre');
            $table->string('anciennete')->nullable()->after('etat_civil');
            $table->string('piece_identite')->nullable()->after('piece_jointe');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('membres', function (Blueprint $table) {
            $table->dropColumn(['etat_civil', 'anciennete', 'piece_identite']);
        });
    }
};
