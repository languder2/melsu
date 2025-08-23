<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if(!Schema::hasColumn('staff_affiliation','is_teacher')){
            Schema::table('staff_affiliation', function (Blueprint $table) {
                $table->boolean('is_teacher')->after('order')->default(0);
            });
        }
    }

    public function down(): void
    {
        if(Schema::hasColumn('staff_affiliation','is_teacher')){
            Schema::table('staff_affiliation', function (Blueprint $table) {
                $table->dropColumn('is_teacher');
            });
        }
    }
};

