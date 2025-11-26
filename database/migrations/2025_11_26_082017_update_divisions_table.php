<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if(Schema::hasColumn('divisions', 'show')) {
            Schema::table('divisions', function (Blueprint $table) {
                $table->renameColumn('show', 'is_show');
            });
        }

        if(!Schema::hasColumn('divisions', 'is_approved')) {
            Schema::table('divisions', function (Blueprint $table) {
                $table->unsignedTinyInteger('is_approved')
                    ->after('is_show')
                    ->default(0);
            });
        }
    }

    public function down(): void
    {
        if(Schema::hasColumn('divisions', 'is_show')) {
            Schema::table('divisions', function (Blueprint $table) {
                $table->renameColumn('is_show', 'show');
            });
        }

        if(Schema::hasColumn('divisions', 'is_approved')) {
            Schema::table('divisions', function (Blueprint $table) {
                $table->dropColumn('is_approved');
            });
        }
    }
};
