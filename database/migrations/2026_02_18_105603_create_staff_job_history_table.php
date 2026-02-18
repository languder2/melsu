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
        Schema::create('staff_job_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('staff_id');

            $table->year('employment_year')->nullable();
            $table->year('dismissal_year')->nullable();

            $table->string('company')->nullable();
            $table->text('post')->nullable();

            $table->boolean('is_show')->default(0);
            $table->boolean('is_approved')->default(0);
            $table->unsignedInteger('sort')->default(0);

            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();

            $table->foreign('staff_id')->references('id')->on('staffs')->onDelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('staff_job_history');
    }
};
