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
        if(Schema::hasColumn('education_specialities','faculty_code'))
            Schema::table('education_specialities',function (Blueprint $table){
                $table->dropForeign('education_specialities_faculty_code_foreign');
                $table->dropIndex('education_specialities_faculty_code_foreign');
                $table->dropColumn('faculty_code');
            });

        if(Schema::hasColumn('education_specialities','department_code'))
            Schema::table('education_specialities',function (Blueprint $table){
                $table->dropForeign('education_specialities_department_code_foreign');
                $table->dropIndex('education_specialities_department_code_foreign');
                $table->dropColumn('department_code');
            });

        if(Schema::hasColumn('education_specialities','total_places'))
            Schema::table('education_specialities',function (Blueprint $table){
                $table->dropColumn('total_places');
            });

        if(Schema::hasColumn('education_specialities','level_code'))
            Schema::table('education_specialities',function (Blueprint $table){
                $table->dropForeign('education_specialities_level_code_foreign');
                $table->dropIndex('education_specialities_level_code_foreign');
                $table->renameColumn('level_code','level');
            });

        if(Schema::hasColumn('education_specialities','order'))
            Schema::table('education_specialities',function (Blueprint $table){
                $table->renameColumn('order','sort');
            });

        if(!Schema::hasColumn('education_specialities','name'))
            Schema::table('education_specialities',function (Blueprint $table){
                $table->renameColumn('order','sort');
            });

        if(!Schema::hasColumn('education_specialities','relation_id'))
            Schema::table('education_specialities',function (Blueprint $table){
                $table->integer('relation_id')->nullable()->after('sort');
            });

        if(!Schema::hasColumn('education_specialities','relation_type'))
            Schema::table('education_specialities',function (Blueprint $table){
                $table->integer('relation_type')->nullable()->after('relation_id');
            });

        if(Schema::hasColumn('education_profiles','form_code')){
            Schema::table('education_profiles',function (Blueprint $table){
                $table->dropForeign('education_profiles_form_code_foreign');
                $table->dropIndex('education_profiles_form_code_foreign');
                $table->renameColumn('form_code','form');
            });

        }

        Schema::dropIfExists('education_departments');
        Schema::dropIfExists('education_faculties');
        Schema::dropIfExists('education_labs');
        Schema::dropIfExists('education_levels');
        Schema::dropIfExists('education_forms');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
