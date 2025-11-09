<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events_relations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');

            $table->morphs('relation');
            $table->unique(['event_id', 'relation_id', 'relation_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events_relations');
    }
};
