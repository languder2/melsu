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
        Schema::table('divisions', function (Blueprint $table) {
            $table->renameColumn('parent_id', 'parent_id_old');
            $table->nestedSet();
        });

         \App\Models\Division\Division::fixTree();
    }

    public function down(): void
    {
        Schema::table('divisions', function (Blueprint $table) {
            $table->dropColumn('_lft');
            $table->dropColumn('_rgt');
            $table->dropColumn('parent_id');
            $table->renameColumn('parent_id_old', 'parent_id');
        });

    }
};
