<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('news_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('sort')->default(100000);
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });

        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category')->nullable();
            $table->string('title');
            $table->string('short')->nullable();
            $table->text('full')->nullable();
            $table->longtext('news')->nullable();
            $table->string('image')->nullable();
            $table->unsignedBigInteger('author')->nullable();
            $table->integer('sort')->default(10000);
            $table->timestamp('publication_at')->default(DB::raw('CURRENT_TIMESTAMP'));


            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();

            $table->foreign('category')->references('id')->on('news_categories')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->foreign('author')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_categories');
        Schema::dropIfExists('news');
    }
};
