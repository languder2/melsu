<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropTableDurations extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('durations');
    }
}
