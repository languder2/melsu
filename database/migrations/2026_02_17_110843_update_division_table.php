<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $tableName = ( new App\Models\Division\Division() )->getTable();

        if(Schema::hasColumn($tableName, 'description'))
            Schema::table($tableName, function (Blueprint $table) {
                $table->dropColumn('description');
            });
    }
    public function down(): void
    {
        $tableName = ( new App\Models\Division\Division() )->getTable();

        if(!Schema::hasColumn($tableName, 'description'))
            Schema::table($tableName, function (Blueprint $table) {
                $table->longText('description')->nullable();
            });
    }
};
