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
        if(Schema::hasTable('departments') && !Schema::hasColumn('departments', 'coordinator_id')) {
            Schema::table('departments', function (Blueprint $table) {
               $table->unsignedBigInteger('coordinator_id')->nullable()->after('name');

               $table->foreign('coordinator_id')
                        ->references('id')
                        ->on('staffs')
                       ->cascadeOnUpdate()
                       ->nullOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasColumn('departments', 'coordinator_id')) {
            Schema::table('departments', function (Blueprint $table) {
                $table->dropForeign('departments_coordinator_id_foreign');
                $table->dropIndex('departments_coordinator_id_foreign');
                $table->dropColumn('coordinator_id');
            });
        }
    }
};
