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

        Schema::create('staff_education', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('staff_id');

            $table->text('university')->nullable();
            $table->year('year')->nullable();
//            $table->enum('type', collect(\App\Enums\Staff\EducationType::cases())->map(fn($item) => $item->name)->toArray())->nullable();
            $table->string('type')->nullable();
            $table->string('level')->nullable();
            $table->string('speciality')->nullable();
            $table->unsignedTinyInteger('is_show')->default(0);
            $table->unsignedInteger('order')->default(0);

            $table->foreign('staff_id')->references('id')->on('staffs')->cascadeOnDelete()->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_education');
    }
};
