<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    protected string $table;

    public function __construct()
    {
        $model = new \App\Models\News\RelationNews();

        $this->table = $model->getTable();
    }
    public function up(): void
    {

        if(!Schema::hasColumn($this->table, 'has_approval')) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->boolean('has_approval')->after('sort');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasColumn($this->table, 'has_approval')) {
            Schema::table($this->table, function (Blueprint $table) {

                $table->dropColumn('has_approval');

            });
        }
    }
};
