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
        if(!Schema::hasColumn('staff_affiliation', 'post_show')) {
            Schema::table('staff_affiliation', function (Blueprint $table) {
                $table->integer('post_show')->after('order')->unsigned()->default(1);
            });
        }

        if(!Schema::hasColumn('staff_affiliation', 'post_weight')) {
            Schema::table('staff_affiliation', function (Blueprint $table) {
                $table->integer('post_weight')->after('order')->unsigned()->default(0);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasColumn('staff_affiliation', 'post_show')) {
            Schema::table('staff_affiliation', function (Blueprint $table) {
                $table->dropColumn('post_show');
            });
        }

        if(Schema::hasColumn('staff_affiliation', 'post_weight')) {
            Schema::table('staff_affiliation', function (Blueprint $table) {
                $table->dropColumn('post_weight');
            });
        }
    }
};
