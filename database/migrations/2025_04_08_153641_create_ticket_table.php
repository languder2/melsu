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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('author_id')->nullable();
            $table->text('comment')->nullable();
            $table->longText('content')->nullable();
            $table->string('status');
            $table->string('link')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();

            $table->foreign('author_id')
                ->references('id')
                ->on('users')
                ->cascadeOnUpdate()
                ->nullOnDelete();
        });

        Schema::create('ticket_affiliation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ticket_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('role');
            $table->timestamps();

            $table->foreign('ticket_id')->references('id')->on('tickets')
                ->onUpdate('set null')
                ->onDelete('cascade');

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('set null')
                ->onDelete('cascade');

        });

        Schema::create('ticket_response', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ticket_id')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('author_id')->nullable();
            $table->string('role');
            $table->timestamps();

            $table->foreign('ticket_id')->references('id')->on('tickets')
                ->onUpdate('set null')
                ->onDelete('cascade');

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('set null')
                ->onDelete('cascade');

        });
    }
    public function down(): void
    {
        Schema::dropIfExists('ticket_response');
        Schema::dropIfExists('ticket_affiliation');
        Schema::dropIfExists('tickets');
    }
};
