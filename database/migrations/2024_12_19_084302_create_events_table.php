<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['preview', 'report'])->default('preview');
            $table->string('title');
            $table->string('short')->nullable();
            $table->text('full')->nullable();
            $table->longtext('news')->nullable();
            $table->string('image')->nullable();
            $table->unsignedBigInteger('author')->nullable();
            $table->integer('sort')->default(10000);
            $table->timestamp('publication_at')->default(DB::raw('CURRENT_TIMESTAMP'));


            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();

            $table->foreign('author')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
