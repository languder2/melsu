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
        if(Schema::hasColumn('education_departments', 'type_code'))
            Schema::table('education_departments', function (Blueprint $table) {
                $table->dropForeign('education_departments_type_code_foreign');
                $table->dropIndex('education_departments_type_code_foreign');
                $table->dropColumn('type_code');
            });

        if (Schema::hasColumn('education_departments','department_code'))
                Schema::table('education_departments', function (Blueprint $table) {
                    $table->dropForeign('education_departments_department_code_foreign');
                    $table->dropIndex('education_departments_department_code_foreign');
                    $table->dropColumn('department_code');
                });

        Schema::dropIfExists('education_department_types');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
