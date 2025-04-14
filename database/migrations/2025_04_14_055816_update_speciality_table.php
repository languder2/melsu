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
        $model = new App\Models\Education\Speciality();
        $division = new App\Models\Division\Division();

        if(!Schema::hasColumn($model->getTable(),'institute_id'))
            Schema::table($model->getTable(), function (Blueprint $table) use ($division) {
                $table->unsignedBigInteger('institute_id')->nullable()->after('spec_code');
                $table->foreign('institute_id')
                    ->references('id')
                    ->on($division->getTable())
                    ->cascadeOnUpdate()
                    ->nullOnDelete();
            });
    }
    public function down(): void
    {
        $model = new App\Models\Education\Speciality();

        if(Schema::hasColumn($model->getTable(),'institute_id'))
            Schema::table($model->getTable(), function (Blueprint $table) use ($model) {
                $table->dropForeign($model->getTable().'_institute_id_foreign');
                $table->dropIndex($model->getTable().'_institute_id_foreign');
                $table->dropColumn('institute_id');
            });
    }
};
