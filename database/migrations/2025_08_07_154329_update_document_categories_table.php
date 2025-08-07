<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if(!Schema::hasColumn('document_categories', 'parent_id')) {
            Schema::table('document_categories', function (Blueprint $table) {
                $table->unsignedBigInteger('parent_id')->nullable()->after('name');

                $table->foreign('parent_id')->references('id')->on('document_categories');
            });
        }
    }
    public function down(): void
    {
        if(Schema::hasColumn('document_categories', 'parent_id')) {
            Schema::table('document_categories', function (Blueprint $table) {
                $table->dropForeign('document_categories_parent_id_foreign');
                $table->dropIndex('document_categories_parent_id_foreign');
                $table->dropColumn('parent_id');
            });
        }
    }

};
