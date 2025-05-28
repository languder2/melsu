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
        if(Schema::hasColumn('options','name')) {
            Schema::table('options', function (Blueprint $table) {
                $table->dropColumn('name');
            });
        }
        if(!Schema::hasColumn('options','deleted_at')) {
            Schema::table('options', function (Blueprint $table) {
                $table->timestamp('deleted_at')->nullable()->after('updated_at');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(!Schema::hasColumn('options','name')) {
            Schema::table('options', function (Blueprint $table) {
                $table->string('name')->nullable()->after('id');
            });
        }
        if(Schema::hasColumn('options','deleted_at')) {
            Schema::table('options', function (Blueprint $table) {
                $table->dropColumn('deleted_at');
            });
        }
    }
};
