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
        $table = (new App\Models\Staff\Staff())->getTable();

        if(!Schema::hasColumn($table, 'retraining'))
            Schema::table($table, function (Blueprint $table) {
                $table->longText('retraining')->nullable()->after('education');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $table = (new App\Models\Staff\Staff())->getTable();

        if(Schema::hasColumn($table, 'retraining'))
            Schema::table($table, function (Blueprint $table) {
                $table->dropColumn('retraining');
            });
    }
};
