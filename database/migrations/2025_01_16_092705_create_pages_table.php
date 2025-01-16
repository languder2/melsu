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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('link')->nullable();
            $table->string('route')->nullable();
            $table->unsignedBigInteger('parent')->nullable();
            $table->integer('sort')->default(100000);
            $table->enum('display', ['show', 'hide'])->default('show');

            $table->timestamps();

            $table->foreign('parent')->references('id')->on('pages')
                ->onUpdate('cascade')
                ->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
