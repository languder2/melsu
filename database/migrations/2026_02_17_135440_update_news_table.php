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
        $table = (new App\Models\News\News())->getTable();

        if(Schema::hasColumn($table, 'category'))
            Schema::table($table, function (Blueprint $table) {
                $table->dropForeign(['category']);
                $table->dropColumn('category');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $table = (new App\Models\News\News())->getTable();

        if(!Schema::hasColumn($table, 'category'))
            Schema::table($table, function (Blueprint $table) {
                $table->unsignedBigInteger('category')->nullable();

                $table->foreign('category')->references('id')->on((new \App\Models\News\Category())->getTable());
            });
    }
};
