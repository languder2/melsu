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
        if(!Schema::hasTable('tickets'))
            Schema::create('tickets', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->unsignedBigInteger('user_id')->nullable();
                $table->text('comment')->nullable();
                $table->longText('content')->nullable();
                $table->string('status');
                $table->string('link')->nullable();
                $table->timestamp('deleted_at')->nullable();
                $table->timestamps();

                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->cascadeOnUpdate()
                    ->nullOnDelete();
            });

        if(!Schema::hasTable('ticket_affiliation'))
            Schema::create('ticket_affiliation', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('ticket_id')->nullable();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->string('role');
                $table->timestamps();

                $table->foreign('ticket_id')->references('id')->on('tickets')
                    ->onUpdate('cascade')
                    ->onDelete('set null');

                $table->foreign('user_id')->references('id')->on('users')
                    ->onUpdate('cascade')
                    ->onDelete('set null');

            });

        if(!Schema::hasTable('ticket_user_roles'))
            Schema::create('ticket_user_roles', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->string('role');
                $table->text('post')->nullable();
                $table->timestamps();

                $table->foreign('user_id')->references('id')->on('users')
                    ->onUpdate('cascade')
                    ->onDelete('set null');

            });

        if(!Schema::hasTable('ticket_user_roles'))
            Schema::create('ticket_replies', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('ticket_id')->nullable();
                $table->unsignedBigInteger('parent_id')->nullable();
                $table->unsignedBigInteger('user_id')->nullable();

                $table->boolean('is_new')->default(true);
                $table->boolean('is_favorite')->default(false);
                $table->boolean('is_important')->default(false);

                $table->longText('content')->nullable();

                $table->timestamp('deleted_at')->nullable();
                $table->timestamps();

                $table->foreign('ticket_id')->references('id')->on('tickets')
                    ->onUpdate('cascade')
                    ->onDelete('set null');

                $table->foreign('user_id')->references('id')->on('users')
                    ->onUpdate('cascade')
                    ->onDelete('set null');

                $table->foreign('parent_id')->references('id')->on('ticket_replies')
                    ->onUpdate('cascade')
                    ->onDelete('set null');
            });
    }
    public function down(): void
    {
        Schema::dropIfExists('ticket_replies');
        Schema::dropIfExists('ticket_affiliation');
        Schema::dropIfExists('ticket_user_roles');
        Schema::dropIfExists('tickets');
    }
};
