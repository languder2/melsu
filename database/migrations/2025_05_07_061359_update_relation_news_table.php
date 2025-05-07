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
        if(!Schema::hasColumn('relation_news','is_favorite')){
            Schema::table('relation_news', function (Blueprint $table) {
                $table->boolean('is_favorite')->default(false)->after('is_show');
                $table->unsignedInteger('sort')->default(1000)->after('is_favorite');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasColumn('relation_news','is_favorite')){
            Schema::table('relation_news', function (Blueprint $table) {
                $table->dropColumn('is_favorite');
                $table->dropColumn('sort');
            });
        }
    }
};
