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
        if(!Schema::hasColumn('education_specialities','name_profile')){
            Schema::table('education_specialities', function (Blueprint $table) {
                $table->string('name_profile')->nullable()->after('name');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasColumn('education_specialities','name_profile')){
            Schema::table('education_specialities', function (Blueprint $table) {
                $table->dropColumn('name_profile');
            });
        }
    }
};
