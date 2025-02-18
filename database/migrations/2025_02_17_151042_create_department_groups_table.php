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
        if(!Schema::hasTable('department_groups'))
            Schema::create('department_groups', function (Blueprint $table) {
                $table->id();

                $table->string('name');
                $table->string('alias')->nullable()->unique();
                $table->text('description')->nullable();

                $table->tinyInteger('show')->default(1);
                $table->integer('order')->default(10000);
                $table->timestamp('deleted_at')->nullable();
                $table->timestamps();
            });

        if(!Schema::hasColumns('departments',['relation_type','relation_id']))
            Schema::table('departments',function (Blueprint $table){
                $table->string('relation_id')->nullable();
                $table->string('relation_type')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('department_groups');
    }
};
