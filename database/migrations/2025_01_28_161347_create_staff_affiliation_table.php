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
        if (!Schema::hasTable('staff_affiliation'))
            Schema::create('staff_affiliation', function (Blueprint $table) {
                $table->id();

                $table->unsignedBigInteger('staff_id')->nullable();

                $table->string('alt_name')->nullable();
                $table->string('post')->nullable();

                $table->enum('show', [true, false])->default(true);
                $table->integer('order')->default(10000);

                $table->integer('relation_id')->nullable();
                $table->string('relation_type')->nullable();
                $table->timestamp('deleted_at')->nullable();
                $table->timestamps();

                $table->foreign('staff_id')
                    ->references('id')
                    ->on('staffs')
                    ->cascadeOnUpdate()
                    ->nullOnDelete();

            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_affiliation');
    }
};
