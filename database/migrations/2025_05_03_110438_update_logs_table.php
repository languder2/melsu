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
        if(!Schema::hasColumn('logs','origin_id'))
            Schema::table('logs',function (Blueprint $table){
                $table->unsignedBigInteger('origin_id')->nullable()->after('relation_type');
                $table->string('origin_type')->nullable()->after('origin_id');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasColumn('logs','origin_id'))
            Schema::table('logs',function (Blueprint $table){
                $table->dropColumn('origin_id');
                $table->dropColumn('origin_type');
            });
    }
};
