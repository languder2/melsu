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
        if(!Schema::hasColumn('pages','without_bg')){
            Schema::table('pages', function (Blueprint $table) {
                $table->tinyInteger('without_bg')->default(0)->after('display');
                $table->renameColumn('display', 'show');
                $table->tinyInteger('show')->default(1)->change();

            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasColumn('pages','without_bg')){
            Schema::table('pages', function (Blueprint $table) {
                $table->dropColumn('without_bg');
                $table->string('show')->default('show')->change();
                $table->renameColumn('show','display');

            });
        }
    }
};
