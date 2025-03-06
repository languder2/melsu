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
        if (!Schema::hasTable('education_academic_subjects'))
            Schema::create('education_academic_subjects', function (Blueprint $table) {
                $table->id();

                $table->string('name');
                $table->string('alt_name')->nullable();

                $table->enum('show', [true, false])->default(true);
                $table->integer('order')->default(10000);

                $table->timestamp('deleted_at')->nullable();
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_academic_subjects');
    }
};
