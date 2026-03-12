<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Division\Division;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

//            $table->nestedSet();

        Schema::table('divisions', function (Blueprint $table) {
            $table->unsignedInteger('_rgt')->after('parent_id')->default(0)->index();
            $table->unsignedInteger('_lft')->after('parent_id')->default(0)->index();
        });

        if(!Schema::hasIndex('divisions', 'divisions_parent_id_index'))
            Schema::table('divisions', function (Blueprint $table) {
                $table->index('parent_id');
            });

        Division::fixTree();

    }

    public function down(): void
    {
        Schema::table('divisions', function (Blueprint $table) {
            $table->dropColumn(['_lft', '_rgt']);
        });

    }
};
