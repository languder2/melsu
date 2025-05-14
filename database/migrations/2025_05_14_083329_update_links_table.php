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
        if(Schema::hasColumn('links','show')){
            Schema::table('links', function (Blueprint $table) {
                $table->renameColumn('show', 'is_show');
                $table->boolean('is_show')->nullable(false)->default(true)->change();
            });
        }

        if(Schema::hasColumn('links','order')){
            Schema::table('links', function (Blueprint $table) {
                $table->renameColumn('order', 'sort');
                $table->unsignedInteger('sort')->after('is_show')->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
