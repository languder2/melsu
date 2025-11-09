<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    protected string $table = "relation_news";
    public function up(): void
    {

        if(!Schema::hasColumn($this->table, 'has_approval')) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->boolean('has_approval')->after('sort');
            });
        }
    }
    public function down(): void
    {
        if(Schema::hasColumn($this->table, 'has_approval')) {
            Schema::table($this->table, function (Blueprint $table) {

                $table->dropColumn('has_approval');

            });
        }
    }
};
