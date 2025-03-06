<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Education\Faculty;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if(!Schema::hasColumn('education_faculties','acronym'))
            Schema::table('education_faculties', function (Blueprint $table) {
                $table->string('acronym',5)->nullable()->after('id');

            });

        if(!Schema::hasColumn('education_faculties','show'))
            Schema::table('education_faculties', function (Blueprint $table) {
                $table->tinyInteger('show')->default(1)->after('order');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasColumn('education_faculties','show'))
            Schema::table('education_faculties', function (Blueprint $table) {
                $table->dropColumn('show');
            });

        if(Schema::hasColumn('education_faculties','acronym'))
            Schema::table('education_faculties', function (Blueprint $table) {
                $table->dropColumn('acronym');
            });
    }
};
