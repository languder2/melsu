<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if(!Schema::hasColumn('partners','category_id')){
            Schema::table('partners', function (Blueprint $table) {
                $table->unsignedBigInteger('category_id')->after('name')->nullable();

                $table->foreign('category_id')
                    ->references('id')
                    ->on('partner_categories')
                    ->cascadeOnDelete()
                    ->cascadeOnUpdate();
                ;
            });
        }
    }

    public function down(): void
    {
        if(Schema::hasColumn('partners','category_id')){
            Schema::table('partners', function (Blueprint $table) {
                $table->dropForeign(['category_id']);
                $table->dropColumn('category_id');
            });
        }
    }
};
