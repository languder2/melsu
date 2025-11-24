<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if(!Schema::hasColumn('staffs', 'uuid')){
            Schema::table('staffs', function (Blueprint $table) {
                $table->string('uuid')->nullable()->after('id');
            });
        }
    }

    public function down(): void
    {
        if(Schema::hasColumn('staffs', 'uuid')){
            Schema::table('staffs', function (Blueprint $table) {
                $table->dropColumn('uuid');
            });
        }
    }
};
