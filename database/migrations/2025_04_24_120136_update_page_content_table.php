<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Page\Content;
return new class extends Migration
{
    /**
     * Run the migrations.
     */


    public function up(): void
    {
        $model = new Content();
        $table = $model->getTable();

        Schema::table($table, function (Blueprint $table) {
            $table->text('title')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
