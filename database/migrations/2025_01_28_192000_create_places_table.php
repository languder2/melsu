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
        if (!Schema::hasTable('education_places'))
            Schema::create('education_places', function (Blueprint $table) {
                $table->id();

                $table->enum('type', ['budget', 'contract'])->default('budget');
//                $table->year('year')->nullable();
                $table->integer('count')->nullable();

                $table->enum('show', [true, false])->default(true);
                $table->integer('order')->default(10000);
                $table->integer('relation_id')->nullable();
                $table->string('relation_type')->nullable();
                $table->timestamp('deleted_at')->nullable();
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_places');
    }
};
