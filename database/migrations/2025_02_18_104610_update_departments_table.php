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
        if(Schema::hasColumn('departments','alias'))
            Schema::table('departments',function (Blueprint $table){
                $table->renameColumn('alias','code');
            });

        if(!Schema::hasColumn('departments','parent_id'))
            Schema::table('departments',function (Blueprint $table){

                $table->unsignedBigInteger('parent_id')->nullable()->after('id');

                $table->foreign('parent_id')
                    ->references('id')
                    ->on('departments')
                    ->cascadeOnUpdate()
                    ->nullOnDelete();
            });

        if(!Schema::hasColumn('departments','group_id'))
            Schema::table('departments',function (Blueprint $table){

                $table->unsignedBigInteger('group_id')->nullable()->after('id');

                $table->foreign('group_id')
                    ->references('id')
                    ->on('department_groups')
                    ->cascadeOnUpdate()
                    ->nullOnDelete();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
