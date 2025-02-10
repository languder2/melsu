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
        if (!Schema::hasTable('links'))
            Schema::create('links', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('title')->nullable();
                $table->longText('link')->nullable();
                $table->enum('target', ['_self', '_target'])->default('_self');
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
        Schema::dropIfExists('links');
    }
};
