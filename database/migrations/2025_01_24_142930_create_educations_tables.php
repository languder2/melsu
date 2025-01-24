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
        Schema::create('education_faculties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique()->nullable();
            $table->string('logo')->nullable();
            $table->string('image')->nullable();
            $table->longText('description')->nullable();

            $table->string('sort')->default(1000);
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });

        Schema::create('education_department_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();

            $table->string('sort')->default(1000);
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });

        Schema::create('education_departments', function (Blueprint $table) {

            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->unsignedBigInteger('type_code');
            $table->unsignedBigInteger('parent_id');
            $table->string('logo')->nullable();
            $table->string('image')->nullable();
            $table->longText('description')->nullable();

            $table->string('sort')->default(1000);
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });

        Schema::create('education_levels', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('code')->unique();

            $table->integer('sort')->default(10000);
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });

        Schema::create('education_specialities', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('code')->unique();
            $table->string('faculty_code');
            $table->string('department_code');
            $table->string('level_code');
            $table->json('places');
            $table->longText('description')->nullable();

            $table->integer('sort')->default(10000);

            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });

        Schema::create('education_form_types', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->longText('description')->nullable();
            $table->string('speciality_code')->nullable();
            $table->decimal('terms', 2, 1)->nullable();
            $table->json('places')->nullable();
            $table->json('scores')->nullable();
            $table->json('exams')->nullable();
            $table->string('director')->nullable();
            $table->text('address')->nullable();
            $table->string('director')->nullable();
            $table->string('afc')->comment('admission of foreign citizens')->nullable();
            $table->integer('price')->nullable();

            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });

        Schema::create('education_forms', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('type_code');
            $table->string('speciality_code');

            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_forms');
        Schema::dropIfExists('education_form_types');
        Schema::dropIfExists('education_specialities');
        Schema::dropIfExists('education_levels');
        Schema::dropIfExists('education_department_types');
        Schema::dropIfExists('education_departments');
        Schema::dropIfExists('education_faculties');
    }
};
