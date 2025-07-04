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
        if(!Schema::hasColumn('education_profiles','duration')) {
            Schema::table('education_profiles', function (Blueprint $table) {
                $table->unsignedInteger('duration')->nullable()->after('form');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasColumn('education_profiles','duration')) {
            Schema::table('education_profiles', function (Blueprint $table) {
                $table->dropColumn('duration');
            });
        }
    }
};
