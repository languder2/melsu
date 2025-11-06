<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if(Schema::hasColumn('pages', 'alias')){
            Schema::table('pages', function (Blueprint $table) {
               $table->renameColumn('alias', 'code');
            });
        }

        if(Schema::hasColumn('pages', 'show')){
            Schema::table('pages', function (Blueprint $table) {
               $table->renameColumn('show', 'is_show');
            });
        }

        if(Schema::hasColumn('pages', 'comment')){
            Schema::table('pages', function (Blueprint $table) {
               $table->dropColumn('comment');
            });
        }

        if(Schema::hasColumn('pages', 'view')){
            Schema::table('pages', function (Blueprint $table) {
               $table->dropColumn('view');
            });
        }

        if(Schema::hasColumn('pages', 'without_bg')){
            Schema::table('pages', function (Blueprint $table) {
               $table->dropColumn('without_bg');
            });
        }

        if(Schema::hasColumn('pages', 'content')){
            Schema::table('pages', function (Blueprint $table) {
               $table->dropColumn( 'title', 'keywords', 'description', 'content');
            });
        }
    }


    public function down(): void
    {
        if(Schema::hasColumn('pages', 'is_show')){
            Schema::table('pages', function (Blueprint $table) {
                $table->renameColumn('is_show', 'show');
            });
        }

        if(Schema::hasColumn('pages', 'is_show')){
            Schema::table('pages', function (Blueprint $table) {
                $table->renameColumn('is_show', 'show');
            });
        }

        if(!Schema::hasColumn('pages','comment')){
            Schema::table('pages', function (Blueprint $table) {
                $table->string('comment')->nullable()->after('code');
            });
        }

        if(!Schema::hasColumn('pages', 'view')){
            Schema::table('pages', function (Blueprint $table) {
                $table->string('view')->nullable()->after('code');
            });
        }

        if(!Schema::hasColumn('pages', 'without_bg')){
            Schema::table('pages', function (Blueprint $table) {
                $table->unsignedTinyInteger('without_bg')->default(0);
            });
        }

        if(!Schema::hasColumn('pages', 'content')){
            Schema::table('pages', function (Blueprint $table) {
                $table->text('content')->after('route')->nullable();
                $table->string('description')->after('content')->nullable();
                $table->string('keywords')->after('content')->nullable();
                $table->string('title')->after('content')->nullable();
            });
        }
    }
};
