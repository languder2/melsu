<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if(!Schema::hasColumn('contents', 'is_approved')) {
            Schema::table('contents', function (Blueprint $table) {
                $table->unsignedTinyInteger('is_approved')
                    ->after('content')
                    ->default(1);
            });
        }
    }
    public function down(): void
    {
        if(Schema::hasColumn('contents', 'is_approved')) {
            Schema::table('contents', function (Blueprint $table) {
                $table->dropColumn('is_approved');
            });
        }
    }
};
