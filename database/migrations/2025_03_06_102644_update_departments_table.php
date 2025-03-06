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
        if(!Schema::hasColumn('departments','relation_id')){
            Schema::table('departments', function (Blueprint $table) {
                $table->string('relation_type')->nullable()->after('show');
                $table->integer('relation_id')->nullable()->after('show');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasColumn('departments','relation_id')){
            Schema::table('departments', function (Blueprint $table) {
                $table->dropColumn('relation_type');
                $table->dropColumn('relation_id');
            });
        }
    }
};
