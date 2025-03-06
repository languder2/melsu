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
        if(!Schema::hasColumn('departments','show'))
            Schema::table('departments', function (Blueprint $table) {
                $table->renameColumn('sort', 'order');
                $table->tinyInteger('show')->default(true)->after('order');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasColumn('departments','show'))
            Schema::table('departments', function (Blueprint $table) {
                $table->renameColumn('order', 'sort');
                $table->dropColumn('show');
            });
        //
    }
};
