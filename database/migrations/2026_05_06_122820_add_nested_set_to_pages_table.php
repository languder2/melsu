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
        Schema::table('pages', function (Blueprint $table) {
            $table->unsignedInteger('_rgt')->nullable()->after('parent_id');
            $table->unsignedInteger('_lft')->nullable()->after('parent_id');
        });

        \App\Models\Page\Page::fixTree();

        Schema::table('pages', function (Blueprint $table) {
            $table->unsignedInteger('_lft')->nullable(false)->change();
            $table->unsignedInteger('_rgt')->nullable(false)->change();

            $table->index(['_lft', '_rgt', 'parent_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropIndex('pages__lft__rgt_parent_id_index');
            $table->dropColumn(['_lft', '_rgt']);
        });
    }
};
