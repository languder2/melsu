<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    protected string $table;
    public function __construct()
    {
        $model = new \App\Models\News\News();

        $this->table = $model->getTable();
    }
    public function up(): void
    {
        if(!Schema::hasColumn($this->table, 'has_approval'))
            Schema::table($this->table, function (Blueprint $table) {
                $table->boolean('has_approval')->default(false)->after('title');
            });

        if(!Schema::hasColumn($this->table, 'author_id'))
            Schema::table($this->table, function (Blueprint $table) {
                $table->unsignedBigInteger('author_id')->nullable()->after('title');

                $table->foreign('author_id')->references('id')->on('users')
                    ->onDelete('set null')
                    ->onUpdate('cascade')
                ;
            });

        if(!Schema::hasColumn($this->table, 'relation_id'))
            Schema::table($this->table, function (Blueprint $table) {
                $table->string('relation_type')->nullable()->after('sort');
                $table->unsignedBigInteger('relation_id')->nullable()->after('sort');
            });

        if(!Schema::hasColumn($this->table, 'is_show'))
            Schema::table($this->table, function (Blueprint $table) {
                $table->boolean('is_show')->default(false)->after('is_favorite');
            });

        if(Schema::hasColumn($this->table, 'author'))
            Schema::table($this->table, function (Blueprint $table) {
                $table->dropForeign(['author']);
                $table->dropColumn('author');
            });

        if(Schema::hasColumn($this->table, 'image'))
            Schema::table($this->table, function (Blueprint $table) {
                $table->dropColumn('image');
            });

        if(Schema::hasColumn($this->table, 'short'))
            Schema::table($this->table, function (Blueprint $table) {
                $table->dropColumn('short');
            });

        if(Schema::hasColumn($this->table, 'full'))
            Schema::table($this->table, function (Blueprint $table) {
                $table->dropColumn('full');
            });

        if(Schema::hasColumn($this->table, 'news'))
            Schema::table($this->table, function (Blueprint $table) {
                $table->dropColumn('news');
            });

    }
    public function down(): void
    {
        if(Schema::hasColumn($this->table, 'has_approval'))
            Schema::table($this->table, function (Blueprint $table) {
                $table->dropColumn('has_approval');
            });

        if(Schema::hasColumn($this->table, 'author_id'))
            Schema::table($this->table, function (Blueprint $table) {
                $table->dropForeign(['author_id']);
                $table->dropColumn('author_id');
            });

        if(Schema::hasColumn($this->table, 'relation_id'))
            Schema::table($this->table, function (Blueprint $table) {
                $table->dropColumn('relation_type');
                $table->dropColumn('relation_id');
            });

        if(!Schema::hasColumn($this->table, 'author'))
            Schema::table($this->table, function (Blueprint $table) {
                $table->unsignedBigInteger('author')->nullable()->after('id');

                $table->foreign('author')->references('id')->on('users')
                    ->onDelete('set null')
                    ->onUpdate('cascade')
                ;
            });

        if(!Schema::hasColumn($this->table, 'image'))
            Schema::table($this->table, function (Blueprint $table) {
                $table->string('image')->nullable();
            });

        if(!Schema::hasColumn($this->table, 'short'))
            Schema::table($this->table, function (Blueprint $table) {
                $table->longText('short')->nullable();
            });

        if(!Schema::hasColumn($this->table, 'full'))
            Schema::table($this->table, function (Blueprint $table) {
                $table->longText('full')->nullable();
            });

        if(!Schema::hasColumn($this->table, 'news'))
            Schema::table($this->table, function (Blueprint $table) {
                $table->longText('news')->nullable();
            });

        if(Schema::hasColumn($this->table, 'is_show'))
            Schema::table($this->table, function (Blueprint $table) {
                $table->dropColumn('is_show');
            });
    }
};
