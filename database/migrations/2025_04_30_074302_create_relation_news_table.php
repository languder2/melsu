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
        Schema::create('relation_news', function (Blueprint $table) {
            $table->id();

            $table->string('title')->nullable();

            $table->boolean('is_show')->default(true);

            $table->integer('relation_id')->nullable();
            $table->string('relation_type')->nullable();

            $table->timestamp('published_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relation_news');
    }
};
