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
        if(!Schema::hasColumn('education_specialities', 'courses')) {
            Schema::table('education_specialities', function (Blueprint $table) {
                $table->unsignedInteger('courses')->nullable()->after('level');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasColumn('education_specialities', 'courses')) {
            Schema::table('education_specialities', function (Blueprint $table) {
                $table->dropColumn('courses');
            });
        }
    }
};
