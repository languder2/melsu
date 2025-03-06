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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->unsignedBigInteger('chief')->nullable();
            $table->text('chief_post')->nullable();
            $table->text('alias')->nullable();
            $table->integer('sort')->default(100000);
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();

        });

        Schema::create('department_sections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department');
            $table->string('name');
            $table->enum('show_title', ['show', 'hide'])->default('show');
            $table->longText('text')->nullable();
            $table->integer('sort')->default(100000);
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();

            $table->foreign('department')->references('id')->on('departments')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('department_documents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('file');
            $table->string('extension');
            $table->unsignedBigInteger('department');
            $table->integer('sort')->default(100000);
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();

            $table->foreign('department')->references('id')->on('departments')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('department_staffs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('staff');
            $table->unsignedBigInteger('department');
            $table->string('post')->nullable();
            $table->integer('sort')->default(100000);
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();

            $table->foreign('department')->references('id')->on('departments')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('staff')->references('id')->on('staffs')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('department_sections');
        Schema::dropIfExists('department_documents');
        Schema::dropIfExists('department_staffs');
        Schema::dropIfExists('departments');
    }
};
