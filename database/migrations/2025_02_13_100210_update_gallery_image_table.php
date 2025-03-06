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
        if (!Schema::hasColumn('gallery_images','reference_id'))
            Schema::table('gallery_images', function (Blueprint $table) {
                $table->unsignedBigInteger('reference_id')->nullable()->after('id');
                $table->foreign('reference_id')
                    ->references('id')
                    ->on('gallery_images')
                    ->cascadeOnUpdate()
                    ->nullOnDelete();

            });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('gallery_images','reference_id'))
            Schema::table('gallery_images', function (Blueprint $table) {
                $table->dropForeign('gallery_images_reference_id_foreign');
                $table->dropIndex('gallery_images_reference_id_foreign');
                $table->dropColumn('reference_id');
            });
    }
};
