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
        if(Schema::hasTable('handbook_models'))
            Schema::drop('handbook_models');

        if(Schema::hasTable('handbook_collections'))
            Schema::drop('handbook_collections');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
