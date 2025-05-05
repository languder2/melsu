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
        if(!Schema::hasColumn('news_categories', 'code')) {
            Schema::table('news_categories', function (Blueprint $table) {
                $table->string('code')->unique()->nullable()->after('id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasColumn('news_categories', 'code')) {
            Schema::table('news_categories', function (Blueprint $table) {
                $table->dropColumn('code');
            });
        }
    }
};
