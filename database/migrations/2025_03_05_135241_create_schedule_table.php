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
        Schema::create('schedule', function (Blueprint $table) {
            $table->id();
            $table->integer('week')->nullable();
            $table->string('faculty', 50)->nullable();
            $table->string('form_edu', 10)->nullable();
            $table->integer('course')->nullable();
            $table->string('group_name', 25)->nullable();
            $table->integer('weekday')->nullable();
            $table->date('date')->nullable();
            $table->string('subject', 256)->nullable();
            $table->string('type', 20)->nullable();
            $table->integer('time')->nullable();
            $table->string('auditory_name', 100)->nullable();
            $table->string('teacher_name', 256)->nullable();
            $table->string('time_start', 10)->nullable();
            $table->string('time_end', 10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule');
    }
};
