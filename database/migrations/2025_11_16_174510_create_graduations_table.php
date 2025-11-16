<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if(!Schema::hasTable('graduations'))
            Schema::create('graduations', function (Blueprint $table) {
                $table->id();

                $table->string('name');

                $table->string('link')->nullable();

                $table->unsignedInteger('sort')->default(0);
                $table->unsignedTinyInteger('is_show')->default(false);
                $table->unsignedTinyInteger('is_approved')->default(false);

                $table->morphs('relation');

                $table->timestamp('deleted_at')->nullable();
                $table->timestamps();
            });
    }

    public function down(): void
    {
        if(Schema::hasTable('graduations'))
            Schema::dropIfExists('graduations');
    }
};
