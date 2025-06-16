<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {

        if(!Schema::hasColumn('education_profiles', 'speciality_id'))
            Schema::table('education_profiles', function (Blueprint $table) {
                $table->unsignedBigInteger('speciality_id')->nullable()->after('alias');

                $table->foreign('speciality_id')->references('id')->on('education_specialities')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        if (Schema::hasColumn('education_profiles','speciality_id'))
            Schema::table('education_profiles', function (Blueprint $table) {
                $table->dropForeign('education_profiles_speciality_id_foreign');
                $table->dropIndex('education_profiles_speciality_id_foreign');
                $table->dropColumn('speciality_id');
            });
    }
};


