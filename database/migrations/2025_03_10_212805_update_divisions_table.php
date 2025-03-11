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
        if(Schema::hasTable('departments'))
            Schema::table('departments', function (Blueprint $table) {
                $table->dropColumn('order');
                $table->integer('sort')->default(1000)->after('code');
                $table->string('type',50)->after('name')->nullable();

                $table->rename('divisions');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasTable('divisions'))
            Schema::table('divisions', function (Blueprint $table) {
                $table->dropColumn('sort');
                $table->integer('order')->default(1000)->after('code');
                $table->dropColumn('type');
                $table->rename('departments');
            });
    }
};
