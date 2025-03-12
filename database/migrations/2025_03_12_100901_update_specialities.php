<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Education\Speciality;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $model = new Speciality();
        $division = new App\Models\Division\Division();

        if(!Schema::hasColumn($model->getTable(),'department_id'))
            Schema::table($model->getTable(), function (Blueprint $table) use ($division) {
                $table->unsignedBigInteger('department_id')->nullable()->after('spec_code');

                $table->foreign('department_id')
                    ->references('id')
                    ->on($division->getTable())
                    ->cascadeOnUpdate()
                    ->nullOnDelete();
            });

        if(!Schema::hasColumn($model->getTable(),'faculty_id'))
            Schema::table($model->getTable(), function (Blueprint $table) use ($division) {
                $table->unsignedBigInteger('faculty_id')->nullable()->after('spec_code');
                $table->foreign('faculty_id')
                    ->references('id')
                    ->on($division->getTable())
                    ->cascadeOnUpdate()
                    ->nullOnDelete();
            });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $model = new Speciality();

        if(Schema::hasColumn($model->getTable(),'faculty_id'))
            Schema::table($model->getTable(), function (Blueprint $table) use ($model) {
                $table->dropForeign($model->getTable().'_faculty_id_foreign');
                $table->dropIndex($model->getTable().'_faculty_id_foreign');
                $table->dropColumn('faculty_id');
            });

        if(Schema::hasColumn($model->getTable(),'department_id'))
            Schema::table($model->getTable(), function (Blueprint $table) use ($model) {
                $table->dropForeign($model->getTable().'_department_id_foreign');
                $table->dropIndex($model->getTable().'_department_id_foreign');
                $table->dropColumn('department_id');
            });


        //
    }
};
