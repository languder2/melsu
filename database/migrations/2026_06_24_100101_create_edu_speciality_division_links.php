<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEduSpecialityDivisionLinks extends Migration
{
    public function up(): void
    {
        Schema::create('edu_speciality_division_links', function (Blueprint $table) {
            $table->id();

            $table->foreignId('speciality_id')
                ->constrained('education_specialities')
                ->cascadeOnDelete();

            $table->foreignId('division_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->unique(['speciality_id', 'division_id'], 'edu_spec_div_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('edu_speciality_division_links');
    }
}
