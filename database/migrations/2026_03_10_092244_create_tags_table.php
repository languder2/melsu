<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if(!Schema::hasTable('tags'))
            Schema::create('tags', function (Blueprint $table) {
                $table->id();
                $table->string('name')->unique();
                $table->string('slug')->nullable();
                $table->timestamps();
            });

        if(!Schema::hasTable('tag_relations'))
            Schema::create('tag_relations', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('tag_id');
                $table->morphs('relation');
                $table->timestamps();
                $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
            });
    }

    public function down(): void
    {
        Schema::dropIfExists('tag_relations');
        Schema::dropIfExists('tags');
    }
};
