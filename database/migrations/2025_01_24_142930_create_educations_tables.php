<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('education_faculties'))
            Schema::create('education_faculties', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('code')->unique();
                $table->longText('description')->nullable();

                $table->integer('order')->default(10000);
                $table->timestamp('deleted_at')->nullable();
                $table->timestamps();
            });

        if (!Schema::hasTable('education_department_types'))
            Schema::create('education_department_types', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('code')->unique();

                $table->integer('order')->default(10000);
                $table->timestamp('deleted_at')->nullable();
                $table->timestamps();
            });

        if (!Schema::hasTable('education_departments'))
            Schema::create('education_departments', function (Blueprint $table) {

                $table->id();
                $table->string('name');
                $table->string('code')->unique();
                $table->string('faculty_code')->nullable();
                $table->string('type_code')->nullable();
                $table->unsignedBigInteger('parent_id')->nullable();
                $table->longText('description')->nullable();

                $table->integer('order')->default(10000);
                $table->timestamp('deleted_at')->nullable();
                $table->timestamps();

                $table->foreign('parent_id')
                    ->references('id')
                    ->on('education_departments')
                    ->cascadeOnUpdate()
                    ->nullOnDelete();

                $table->foreign('faculty_code')
                    ->references('code')
                    ->on('education_faculties')
                    ->cascadeOnUpdate()
                    ->nullOnDelete();

                $table->foreign('type_code')
                    ->references('code')
                    ->on('education_department_types')
                    ->cascadeOnUpdate()
                    ->nullOnDelete();
            });

        if (!Schema::hasTable('education_levels'))
            Schema::create('education_levels', function (Blueprint $table) {
                $table->id();

                $table->string('name');
                $table->string('alt_name')->nullable();
                $table->string('code')->unique();

                $table->integer('order')->default(10000);
                $table->timestamp('deleted_at')->nullable();
                $table->timestamps();
            });

        if (!Schema::hasTable('education_specialities'))
            Schema::create('education_specialities', function (Blueprint $table) {
                $table->id();

                $table->string('name');
                $table->string('code')->unique();
                $table->string('spec_code')->nullable();
                $table->string('faculty_code')->nullable();
                $table->string('department_code')->nullable();
                $table->string('level_code')->nullable();
                $table->integer('total_places')->nullable();
                $table->boolean('favorite')->default(true);
                $table->longText('description')->nullable();

                $table->integer('order')->default(10000);

                $table->timestamp('deleted_at')->nullable();
                $table->timestamps();

                $table->foreign('faculty_code')
                    ->references('code')
                    ->on('education_faculties')
                    ->cascadeOnUpdate()
                    ->nullOnDelete();

                $table->foreign('department_code')
                    ->references('code')
                    ->on('education_departments')
                    ->cascadeOnUpdate()
                    ->nullOnDelete();

                $table->foreign('level_code')
                    ->references('code')
                    ->on('education_levels')
                    ->cascadeOnUpdate()
                    ->nullOnDelete();
            });

        if (!Schema::hasTable('education_forms'))
            Schema::create('education_forms', function (Blueprint $table) {
                $table->id();

                $table->string('name');
                $table->string('alt_name')->nullable();
                $table->string('code')->unique();
                $table->integer('order')->default(10000);

                $table->timestamp('deleted_at')->nullable();
                $table->timestamps();
            });

        if (!Schema::hasTable('education_profiles'))
            Schema::create('education_profiles', function (Blueprint $table) {
                $table->id();

//                $table->string('name');
                $table->string('alias')->unique()->nullable();
//                $table->longText('description')->nullable();
                $table->string('speciality_code', 20)->nullable();
                $table->string('form_code')->nullable();
                $table->decimal('duration', 3, 2)->nullable();
//                $table->integer('total_places')->nullable();
                $table->string('director')->nullable();
                $table->text('address')->nullable();
                $table->boolean('afc')->nullable()
                    ->comment('admission of foreign citizens');
                $table->integer('price')->nullable();
                $table->boolean('show')->default(true);

                $table->timestamp('deleted_at')->nullable();
                $table->timestamps();

                $table->foreign('speciality_code')
                    ->references('code')
                    ->on('education_specialities')
                    ->cascadeOnUpdate()
                    ->nullOnDelete();

                $table->foreign('form_code')
                    ->references('code')
                    ->on('education_forms')
                    ->cascadeOnUpdate()
                    ->nullOnDelete();

            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_profiles');
        Schema::dropIfExists('education_forms');
        Schema::dropIfExists('education_specialities');
        Schema::dropIfExists('education_levels');
        Schema::dropIfExists('education_departments');
        Schema::dropIfExists('education_department_types');
        Schema::dropIfExists('education_faculties');
    }
};
