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
                $table->string('acronym',10)->nullable()->after('id');
                $table->integer('sort')->default(1000)->after('code');
                $table->string('type',50)->after('name')->nullable();
                $table->longText('description')->nullable()->after('code');
                $table->string('alt_name')->nullable()->after('name');

                $table->dropColumn('relation_id');
                $table->dropColumn('relation_type');

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
                $table->dropColumn('acronym');
                $table->dropColumn('sort');
                $table->dropColumn('alt_name');
                $table->dropColumn('description');

                $table->integer('order')->default(1000)->after('code');
                $table->integer('relation_id')->nullable();
                $table->string('relation_type')->nullable();

                $table->dropColumn('type');
                $table->rename('departments');
            });
    }
};
