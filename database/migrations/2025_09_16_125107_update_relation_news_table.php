<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    protected string $table = "relation_news";
    public function up(): void
    {

        if(!Schema::hasColumn($this->table, 'author_id')) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->unsignedBigInteger('author_id')->nullable()->after('id');
                $table->foreign('author_id')->references('id')->on('users')
                    ->onDelete('set null')
                    ->onUpdate('cascade')
                ;
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasColumn($this->table, 'author_id')) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->dropForeign(['author_id']);
                $table->dropColumn('author_id');
            });
        }
    }
};
