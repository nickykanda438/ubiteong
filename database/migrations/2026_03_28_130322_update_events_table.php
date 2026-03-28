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
        Schema::table('events', function (Blueprint $table) {
            // 1. On supprime la colonne vidéo dont on n'a plus besoin
            if (Schema::hasColumn('events', 'video_url')) {
                $table->dropColumn('video_url');
            }

            // 2. On renomme image_couverture en photo_path pour plus de clarté
            if (Schema::hasColumn('events', 'image_couverture')) {
                $table->renameColumn('image_couverture', 'photo_path');
            }
            $table->longText('description')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('video_url')->nullable();
            $table->renameColumn('photo_path', 'image_couverture');
            $table->text('description')->change();
        });
    }
};