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
        if(!Schema::hasColumn('gallery','relation_id'))
            Schema::table('gallery', function (Blueprint $table) {
                $table->unsignedBigInteger('relation_id')->nullable()->after('order');
                $table->string('relation_type')->nullable()->after('relation_id');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasColumn('gallery','relation_id'))
            Schema::table('gallery', function (Blueprint $table) {
                $table->dropColumn(['relation_id','relation_type']);
            });
    }
};
