<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\News\Events;

return new class extends Migration
{
    public string $table;
    public function __construct()
    {
        $this->table = (new Events())->getTable();
    }
    public function up(): void
    {
        if(Schema::hasColumns($this->table, ['full', 'short', 'news', 'image', 'type', 'published_at'])){
            Schema::table($this->table, function (Blueprint $table) {
                $table->dropColumn('short');
                $table->dropColumn('full');
                $table->dropColumn('news');
                $table->dropColumn('image');
                $table->dropColumn('type');
                $table->dropColumn('published_at');
            });
        }

        if(Schema::hasColumn($this->table, 'author')){
            Schema::table($this->table, function (Blueprint $table) {
                $table->renameColumn('author', 'author_id');
                $table->renameIndex('events_author_foreign', 'events_author_id_foreign');
            });
        }

        if(Schema::hasColumn($this->table, 'category_id')){
            Schema::table($this->table, function (Blueprint $table) {
                $table->dropForeign(['category_id']);
                $table->dropColumn('category_id');

                $table->unsignedBigInteger('category_id')->nullable()->after('title');
                $table->foreign('category_id')->references('id')->on('event_categories')
                    ->onDelete('cascade')
                    ->onUpdate('cascade')
                ;
            });
        }

        if(!Schema::hasColumns($this->table, ['relation_id', 'relation_type'])){
            Schema::table($this->table, function (Blueprint $table) {
                $table->unsignedBigInteger('relation_id')->nullable()->after('event_datetime');
                $table->string('relation_type')->nullable()->after('relation_id');
            });
        }
    }
    public function down(): void
    {
        if(!Schema::hasColumns($this->table, ['full', 'short', 'news', 'image', 'type', 'published_at'])){
            Schema::table($this->table, function (Blueprint $table) {
                $table->text('short')->nullable();
                $table->text('full')->nullable();
                $table->text('news')->nullable();
                $table->string('image')->nullable();
                $table->string('type')->nullable();
                $table->datetime('published_at')->nullable();
            });
        }

        if(!Schema::hasColumn($this->table, 'author')){
            Schema::table($this->table, function (Blueprint $table) {
                $table->renameColumn('author_id', 'author');
                $table->renameIndex('events_author_id_foreign', 'events_author_foreign');
            });
        }

        if(Schema::hasColumn($this->table, 'category_id')){
            Schema::table($this->table, function (Blueprint $table) {
                $table->dropForeign(['category_id']);
                $table->dropColumn('category_id');

                $table->unsignedBigInteger('category_id')->nullable()->after('title');
                $table->foreign('category_id')->references('id')->on('news_categories')
                    ->onDelete('cascade')
                    ->onUpdate('cascade')
                ;
            });
        }

        if(Schema::hasColumns($this->table, ['relation_id', 'relation_type'])){
            Schema::table($this->table, function (Blueprint $table) {
                $table->dropColumn('relation_id');
                $table->dropColumn('relation_type');
            });
        }
    }
};
