<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveSpecCodeFromEducationProfiles extends Migration
{
    public function up(): void
    {
        Schema::table('education_profiles', function (Blueprint $table) {
            $table->dropForeign('education_profiles_speciality_code_foreign');
            $table->dropColumn('speciality_code');

            $table->dropColumn('alias');
        });
    }

    public function down(): void
    {
        Schema::table('education_profiles', function (Blueprint $table) {

            $table->string('speciality_code', 20)->nullable();

            $table->foreign('speciality_code')
                ->references('code')
                ->on('education_specialities')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->string('alias')->unique()->nullable();

        });
    }
}
