<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if(!Schema::hasColumn('employees','staff_id')){
            Schema::table('employees', function (Blueprint $table) {
                $table->unsignedBigInteger('staff_id')->nullable()->after('id');

                $table->foreign('staff_id')->references('id')->on('staffs')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
                ;
            });
        }
        if(Schema::hasColumn('employees','fio')){
            Schema::table('employees', function (Blueprint $table) {
                $table->dropColumn('fio');
            });
        }
        if(Schema::hasColumn('employees','post')){
            Schema::table('employees', function (Blueprint $table) {
                $table->dropColumn('post');
            });
        }

        if(Schema::hasTable('employees')){
            Schema::table('employees', function (Blueprint $table) {
                $table->text('teachingDiscipline')->nullable()->change();
                $table->text('teachingLevel')->nullable()->change();
                $table->text('degree')->nullable()->change();
                $table->text('academStat')->nullable()->change();
                $table->text('qualification')->nullable()->change();
                $table->text('profDevelopment')->nullable()->change();
                $table->text('specExperience')->nullable()->change();
                $table->text('teachingOp')->nullable()->change();
            });
        }
    }

    public function down(): void
    {
        if(Schema::hasColumn('employees','staff_id')){
            Schema::table('employees', function (Blueprint $table) {
                $table->dropForeign('employees_staff_id_foreign');
                $table->dropIndex('employees_staff_id_foreign');
                $table->dropColumn('staff_id');
            });
        }
        if(!Schema::hasColumn('employees','fio')){
            Schema::table('employees', function (Blueprint $table) {
                $table->string('fio')->after('id')->nullable();
            });
        }
        if(!Schema::hasColumn('employees','post')){
            Schema::table('employees', function (Blueprint $table) {
                $table->string('post')->after('fio')->nullable();
            });
        }

    }
};
