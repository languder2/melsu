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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();

            $table->string('fio');
            $table->string('post')->nullable();
            $table->string('teachingDiscipline')->nullable();
            $table->string('teachingLevel')->nullable();
            $table->string('degree')->nullable();
            $table->string('academStat')->nullable();
            $table->string('qualification')->nullable();
            $table->string('profDevelopment')->nullable();
            $table->string('specExperience')->nullable();
            $table->string('teachingOp')->nullable();

            $table->boolean('is_show')->default(true);
            $table->integer('sort')->unsigned()->default(0);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
