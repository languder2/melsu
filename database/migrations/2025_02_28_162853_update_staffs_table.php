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
        if(!Schema::hasColumn('staffs','show_this_card')){
            Schema::table('staffs', function (Blueprint $table) {
                $table->boolean('show_this_card')->default(false)->after('middle_name');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasColumn('staffs','show_this_card')){
            Schema::table('staffs', function (Blueprint $table) {
                $table->dropColumn('show_this_card');
            });
        }
    }
};
