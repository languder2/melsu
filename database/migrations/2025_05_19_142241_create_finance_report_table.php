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
        Schema::create('finance_report', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('sheet')->nullable();
            $table->integer('row')->unsigned()->nullable();
            $table->decimal('amount',8,2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finance_report');
    }
};
