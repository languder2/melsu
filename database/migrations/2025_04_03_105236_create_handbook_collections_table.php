<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHandbookCollectionsTable extends Migration
{
    public function up()
    {
        Schema::create('handbook_collections', function (Blueprint $table) {
            $table->id();
            $table->string('page_name')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('handbook_collections');
    }
}
