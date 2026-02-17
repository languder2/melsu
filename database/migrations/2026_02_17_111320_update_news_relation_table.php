<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected string $tableName = 'news_relations';
    public function up(): void
    {
        if(!Schema::hasIndex($this->tableName, ['news_id', 'relation_type', 'relation_id']))
            Schema::table($this->tableName, function (Blueprint $table) {
                $table->index(['news_id', 'relation_type', 'relation_id']);
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasIndex($this->tableName, ['news_id', 'relation_type', 'relation_id']))
            Schema::table($this->tableName, function (Blueprint $table) {
                $table->dropIndex(['news_id', 'relation_type', 'relation_id']);
            });
    }
};
