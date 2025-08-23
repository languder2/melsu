<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if(!Schema::hasColumn('documents','type')){
            Schema::table('documents', function (Blueprint $table) {
                $table->string('type')->after('title')->nullable();
            });
        }
    }

    public function down(): void
    {
        if(Schema::hasColumn('documents','type')){
            Schema::table('documents', function (Blueprint $table) {
                $table->dropColumn('type');
            });
        }
    }
};
