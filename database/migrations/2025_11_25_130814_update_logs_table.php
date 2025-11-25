<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if(!Schema::hasColumn('logs','dataNew')){
            Schema::table('logs',function (Blueprint $table){
                $table->text('dataNew')->nullable()->after('action');
            });
        }

        if(!Schema::hasColumn('logs','dataOld')){
            Schema::table('logs',function (Blueprint $table){
               $table->text('dataOld')->nullable()->after('action');
            });
        }

        if(Schema::hasColumn('logs','origin_id')){
            Schema::table('logs',function (Blueprint $table){
               $table->dropColumn('origin_id');
               $table->dropColumn('origin_type');
            });
        }

    }

    public function down(): void
    {
        if(Schema::hasColumn('logs','dataOld')){
            Schema::table('logs',function (Blueprint $table){
                $table->dropColumn('dataOld');
            });
        }

        if(Schema::hasColumn('logs','dataNew')){
            Schema::table('logs',function (Blueprint $table){
                $table->dropColumn('dataNew');
            });
        }

        if(!Schema::hasColumn('logs','origin_id')){
            Schema::table('logs',function (Blueprint $table){
                $table->morphs('origin');
            });
        }
    }
};
