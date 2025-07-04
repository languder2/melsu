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
        if(!Schema::hasColumn('info','parent_id')){
            Schema::table('info', function (Blueprint $table) {
                $table->unsignedBigInteger('parent_id')->nullable()->after('type');

                $table->foreign('parent_id')->references('id')->on('info')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
                ;
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasColumn('info','parent_id')) {
            Schema::table('info', function (Blueprint $table) {
                $table->dropForeign('info_parent_id_foreign');
                $table->dropIndex('info_parent_id_foreign');
                $table->dropColumn('parent_id');
            });
        }
    }
};
