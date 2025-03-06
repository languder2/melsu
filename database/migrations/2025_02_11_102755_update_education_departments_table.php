<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('education_departments','department_code'))
            Schema::table('education_departments', function (Blueprint $table) {
                $table->string('department_code')->nullable()->after('faculty_code');
                $table->foreign('department_code')
                    ->references('code')
                    ->on('education_departments')
                    ->cascadeOnUpdate()
                    ->nullOnDelete();

            });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('education_departments','department_code'))
            Schema::table('education_departments', function (Blueprint $table) {
                $table->dropForeign('education_departments_department_code_foreign');
                $table->dropIndex('education_departments_department_code_foreign');
                $table->dropColumn('department_code');
            });
    }
};
