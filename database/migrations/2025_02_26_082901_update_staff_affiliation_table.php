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
        if(!Schema::hasColumn('staff_affiliation','post_alt'))
            Schema::table('staff_affiliation', function (Blueprint $table) {
                $table->string('post_alt')->nullable()->after('post');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasColumn('staff_affiliation','post_alt'))
            Schema::table('staff_affiliation', function (Blueprint $table) {
                $table->dropColumn('post_alt');
            });
    }
};
