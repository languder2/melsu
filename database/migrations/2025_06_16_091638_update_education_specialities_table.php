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
        if(!Schema::hasColumn('education_specialities', 'is_recruitment')) {
            Schema::table('education_specialities', function (Blueprint $table) {
                $table->boolean('is_recruitment')->default(true)->after('spec_code');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasColumn('education_specialities', 'is_recruitment')) {
            Schema::table('education_specialities', function (Blueprint $table) {
                $table->dropColumn('is_recruitment');
            });
        }
    }
};
