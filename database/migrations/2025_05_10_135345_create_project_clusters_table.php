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
        Schema::create('project_clusters', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('code')->unique()->nullable();

            $table->unsignedInteger('sort')->default(1000);
            $table->boolean('is_show')->default(true);

            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_clusters');
    }
};
