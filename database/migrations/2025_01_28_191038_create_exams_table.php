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
        if (!Schema::hasTable('education_exams'))
            Schema::create('education_exams', function (Blueprint $table) {
                $table->id();

                $table->unsignedBigInteger('subject_id')->nullable();
                $table->integer('score')->nullable();
                $table->enum('type', ['budget', 'contract'])->default('budget');

                $table->boolean('required')->default(false);
//                $table->year('year')->nullable();
                $table->boolean('selectable')->default(false);
                $table->integer('order')->default(10000);

                $table->integer('relation_id')->nullable();
                $table->string('relation_type')->nullable();
                $table->timestamp('deleted_at')->nullable();
                $table->timestamps();

                $table->foreign('subject_id')
                    ->references('id')
                    ->on('education_academic_subjects')
                    ->cascadeOnUpdate()
                    ->nullOnDelete();

            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_exams');
    }
};
