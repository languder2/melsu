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
        Schema::dropIfExists('su_structure');
        Schema::dropIfExists('su_structure_group');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
