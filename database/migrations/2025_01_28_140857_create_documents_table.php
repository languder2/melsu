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
        if (!Schema::hasTable('documents'))
            Schema::create('documents', function (Blueprint $table) {
                $table->id();

                $table->string('title');

                $table->string('filename');
                $table->string('filetype');

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
        Schema::dropIfExists('documents');
    }
};
