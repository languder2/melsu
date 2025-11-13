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
        Schema::dropIfExists('partner_sections');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('partner_sections', function (Blueprint $table) {
            $table->id();

            $table->text('title')->nullable();
            $table->tinyInteger('show_title')->default(1);
            $table->string('code')->nullable();
            $table->string('component')->default('text');
            $table->longText('content')->nullable();

            $table->integer('relation_id')->unsigned()->nullable();
            $table->string('relation_type')->nullable();

            $table->tinyInteger('show')->default(1);
            $table->integer('order')->default(1000);

            $table->timestamps();
        });
    }
};
