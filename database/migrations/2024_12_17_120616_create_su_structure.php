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
        Schema::create('su_structure_group', function (Blueprint $table) {

            $table->id();
            $table->string('name');
            $table->string('type')->nullable();
            $table->integer('sort')->default(1000);
            $table->timestamps();

        });

        Schema::create('su_structure', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ssu_group')->nullable();
            $table->string('link')->nullable();
            $table->enum('display', ['show', 'hide'])->default('show');
            $table->string('department')->nullable();
            $table->string('firstname')->nullable();
            $table->string('middlename')->nullable();
            $table->string('lastname')->nullable();
            $table->string('post')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->integer('sort')->default(1000);

            $table->foreign('ssu_group')->references('id')->on('su_structure_group')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('su_structure');
        Schema::dropIfExists('su_structure_group');
    }
};
