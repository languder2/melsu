<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('goals', function (Blueprint $table) {
            $table->id();

            $table->text('content');

            $table->morphs('relation');

            $table->unsignedTinyInteger('is_show')->default(0);
            $table->unsignedTinyInteger('is_approved')->default(0);
            $table->unsignedInteger('sort')->default(0);

            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('goals');
    }

};
