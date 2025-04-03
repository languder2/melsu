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
        Schema::table('handbook_models', function (Blueprint $table) {
            $table->unsignedBigInteger('handbook_collection_id')->nullable()->after('category'); // Добавляем столбец после 'category'
            $table->foreign('handbook_collection_id')
                ->references('id')
                ->on('handbook_collections')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('handbook_models', function (Blueprint $table) {
            $table->dropForeign(['handbook_collection_id']);
            $table->dropColumn('handbook_collection_id');
        });
    }
};
