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
        if(!Schema::hasColumn('education_profiles', 'is_recruitment')) {
            Schema::table('education_profiles', function (Blueprint $table) {
                $table->boolean('is_recruitment')->default(false)->after('show');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasColumn('education_profiles', 'is_recruitment')) {
            Schema::table('education_profiles', function (Blueprint $table) {
                $table->dropColumn('is_recruitment');
            });
        }
    }
};
