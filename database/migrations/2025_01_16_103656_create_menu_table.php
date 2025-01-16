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
        Schema::create('menu_categories', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('code')->unique()->nullable();
            $table->text('comment')->nullable();

            $table->timestamps();
        });

        Schema::create('menu', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('category')->nullable();

            $table->string('name');
            $table->text('comment')->nullable();

            $table->string('link')->nullable();
            $table->string('route')->nullable();

            $table->unsignedBigInteger('parent')->nullable();
            $table->integer('sort')->default(100000);



            $table->foreign('category')->references('id')->on('menu_categories')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->foreign('parent')->references('id')->on('menu')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu');
        Schema::dropIfExists('menu_categories');
    }
};
