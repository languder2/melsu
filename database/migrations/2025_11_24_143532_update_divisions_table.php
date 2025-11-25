<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if(!Schema::hasColumn('divisions', 'uuid')){
            Schema::table('divisions', function (Blueprint $table) {
               $table->string('uuid')->nullable()->after('name');
               $table->string('parent_uuid')->nullable()->after('uuid')->nullable();
            });
        }
    }

    public function down(): void
    {
        if(Schema::hasColumn('divisions', 'uuid')){
            Schema::table('divisions', function (Blueprint $table) {
                $table->dropColumn('uuid');
                $table->dropColumn('parent_uuid');
            });
        }
    }
};
