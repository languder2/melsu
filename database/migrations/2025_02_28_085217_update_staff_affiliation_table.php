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
        if(!Schema::hasColumn('staff_affiliation','full_name')){
            Schema::table('staff_affiliation', function (Blueprint $table) {
                $table->string('full_name')->nullable()->after('staff_id');
            });
        }

        if(Schema::hasColumn('staffs','photo')){
            Schema::table('staffs', function (Blueprint $table) {
                $table->dropColumn('photo');
            });
        }
    }
    public function down(): void
    {
        if(Schema::hasColumn('staff_affiliation','full_name')){
            Schema::table('staff_affiliation', function (Blueprint $table) {
                $table->dropColumn('full_name');
            });
        }

        if(!Schema::hasColumn('staffs','photo')){
            Schema::table('staffs', function (Blueprint $table) {
                $table->string('photo')->nullable();
            });
        }

    }
};
