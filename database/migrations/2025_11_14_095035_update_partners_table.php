<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if(!Schema::hasColumn('partners', 'link')) {
            Schema::table('partners', function (Blueprint $table) {
                $table->string('link')->nullable()->after('name');
            });
        }

        if(!Schema::hasColumn('partners', 'is_approved')) {
            Schema::table('partners', function (Blueprint $table) {
                $table->unsignedTinyInteger('is_approved')->default(0)->after('is_show');
            });
        }

        if(!Schema::hasColumn('partners', 'category_id')) {
            Schema::table('partners', function (Blueprint $table) {
                $table->unsignedBigInteger('category_id')->nullable()->after('name');
            });
        }
    }

    public function down(): void
    {
        if(Schema::hasColumn('partners', 'link')) {
            Schema::table('partners', function (Blueprint $table) {
                $table->dropColumn('link');
            });
        }

        if(Schema::hasColumn('partners', 'is_approved')) {
            Schema::table('partners', function (Blueprint $table) {
                $table->dropColumn('is_approved');
            });
        }

        if(Schema::hasColumn('partners', 'category_id')) {
            Schema::table('partners', function (Blueprint $table) {
                $table->dropColumn('category_id');
            });
        }
    }
};
