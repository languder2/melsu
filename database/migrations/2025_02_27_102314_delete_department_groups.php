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
        Schema::table('departments', function (Blueprint $table) {
            $table->dropForeign('departments_group_id_foreign');
            $table->dropIndex('departments_group_id_foreign');
            $table->dropColumn('group_id');

        });

        Schema::dropIfExists('department_groups');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
