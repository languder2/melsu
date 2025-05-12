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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            $table->text('name');
            $table->string('code')->unique()->nullable();

            $table->string('type');

            $table->unsignedBigInteger('cluster_id')->nullable();

            $table->boolean('is_show')->default(true);
            $table->unsignedInteger('sort')->default(1000);

            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();


            $table->foreign('cluster_id')->references('id')->on('project_clusters')
            ->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
