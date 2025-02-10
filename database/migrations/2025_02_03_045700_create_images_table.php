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
        if (!Schema::hasTable('gallery_images'))
            Schema::create('gallery_images', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('alt')->nullable();
                $table->string('type')->nullable();
                $table->string('filename')->nullable();
                $table->string('filetype')->nullable();
                $table->enum('show', [true, false])->default(true);

                $table->integer('relation_id')->nullable();
                $table->string('relation_type')->nullable();

                $table->integer('order')->default(10000);
                $table->timestamp('deleted_at')->nullable();
                $table->timestamps();
            });

        if (!Schema::hasTable('gallery_video'))
            Schema::create('gallery_video', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('filename')->nullable();
                $table->string('filetype')->nullable();
                $table->enum('show', [true, false])->default(true);

                $table->integer('relation_id')->nullable();
                $table->string('relation_type')->nullable();

                $table->integer('order')->default(10000);
                $table->timestamp('deleted_at')->nullable();
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gallery_images');
        Schema::dropIfExists('gallery_video');
    }
};
