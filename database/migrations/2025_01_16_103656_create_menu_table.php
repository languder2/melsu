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
        Schema::create('menu', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('code')->unique()->nullable();
            $table->text('comment')->nullable();

            $table->timestamps();
        });

        Schema::create('pages', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('alias');
            $table->string('route')->nullable();
            $table->text('comment')->nullable();

            $table->unsignedBigInteger('parent_id')->nullable();

            $table->enum('display', ['show', 'hide'])->default('show');

            $table->unsignedBigInteger('menu_id')->nullable();

            $table->text('title')->nullable();
            $table->text('keywords')->nullable();
            $table->text('description')->nullable();

            $table->string('view')->nullable();
            $table->longText('content')->nullable();

            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('pages')
                ->onUpdate('cascade')
                ->onDelete('SET NULL');

            $table->foreign('menu_id')->references('id')->on('menu')
                ->cascadeOnUpdate()
                ->nullOnDelete();
        });


        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('menu_id')->nullable();

            $table->string('name');
            $table->text('comment')->nullable();

            $table->string('link')->nullable();
            $table->string('route')->nullable();
            $table->unsignedBigInteger('page_id')->nullable();

            $table->unsignedBigInteger('parent_id')->nullable();
            $table->integer('sort')->default(100000);

            $table->string('grp')->nullable();

            $table->foreign('menu_id')->references('id')->on('menu')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->foreign('page_id')->references('id')->on('pages')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->foreign('parent_id')->references('id')->on('menu_items')
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
        Schema::dropIfExists('menu_items');
        Schema::dropIfExists('pages');
        Schema::dropIfExists('menu');
    }
};
