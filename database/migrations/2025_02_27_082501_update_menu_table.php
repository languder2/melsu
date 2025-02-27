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
        if(!Schema::hasColumn('menu', 'is_tree')) {
            Schema::table('menu', function (Blueprint $table) {
                $table->tinyInteger('is_tree')->default(0)->after('code');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasColumn('menu', 'is_tree')) {
            Schema::table('menu', function (Blueprint $table) {
                $table->dropColumn('is_tree');
            });
        }
    }
};
