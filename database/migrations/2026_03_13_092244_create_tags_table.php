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
                $table->string('name');
                $table->string('type')->index();
                $table->unique(['name', 'type']);
            });

        if(!Schema::hasTable('tags_relations'))
            Schema::create('tags_relations', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('tag_id');
                $table->morphs('relation');
                $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade')->onUpdate('cascade');
            });
    }

    public function down(): void
    {
        Schema::dropIfExists('tags_relations');
        Schema::dropIfExists('tags');
    }
};
