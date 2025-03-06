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
        if(!Schema::hasColumn('education_faculties','type'))
            Schema::table('education_faculties', function (Blueprint $table) {
                $table->enum('type',['faculty','branch'])->default('faculty')->after('acronym');
            });

        if(!Schema::hasColumn('education_departments','show'))
            Schema::table('education_departments', function (Blueprint $table) {
                $table->tinyInteger('show')->default(1)->after('order');
            });

        if(!Schema::hasColumn('education_specialities','show'))
            Schema::table('education_specialities', function (Blueprint $table) {
                $table->tinyInteger('show')->default(1)->after('order');
            });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(!Schema::hasColumn('education_faculties','type'))
            Schema::table('education_faculties', function (Blueprint $table) {
                $table->dropColumn('type');
            });

        if(Schema::hasColumn('education_departments','show'))
            Schema::table('education_departments', function (Blueprint $table) {
                $table->dropColumn('show');
            });

        if(Schema::hasColumn('education_specialities','show'))
            Schema::table('education_specialities', function (Blueprint $table) {
                $table->dropColumn('show');
            });
    }
};
