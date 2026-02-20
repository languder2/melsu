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
        $table = (new \App\Models\Staff\Post())->getTable();

        Schema::dropIfExists($table);

        Schema::create($table, function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->unsignedBigInteger('division_id');
            $table->unsignedBigInteger('staff_id');

            $table->string('post')->nullable();
            $table->text('full_post')->nullable();

            $table->boolean('is_head_of_division')->default(false);
            $table->boolean('is_teacher')->default(false);
            $table->boolean('is_show')->default(false);
            $table->unsignedInteger('sort')->default(0);
            $table->unsignedInteger('post_weight')->default(0);

            $table->softDeletes();
            $table->timestamps();

            $table->index(['division_id','staff_id','uuid']);

            $table->foreign('division_id')->references('id')->on('divisions')->onDelete('cascade');
            $table->foreign('staff_id')->references('id')->on('staffs')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        $table = (new \App\Models\Staff\Post())->getTable();

        Schema::dropIfExists($table);
    }
};
