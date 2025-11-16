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
        if(!Schema::hasTable('sciences'))
            Schema::create('sciences', function (Blueprint $table) {
                $table->id();

                $table->string('name');

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
        if(Schema::hasTable('sciences'))
            Schema::dropIfExists('sciences');
    }
};
