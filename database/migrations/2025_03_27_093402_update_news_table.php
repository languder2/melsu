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
        if(Schema::hasColumn('news','publication_at')){
            Schema::table('news',function(Blueprint $table){
                $table->renameColumn('publication_at','published_at');
            });
        }

        if(Schema::hasColumn('events','publication_at')){
            Schema::table('events',function(Blueprint $table){
                $table->renameColumn('publication_at','published_at');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasColumn('news','published_at')){
            Schema::table('news',function(Blueprint $table){
                $table->renameColumn('published_at','publication_at');
            });
        }

        if(Schema::hasColumn('events','published_at')){
            Schema::table('events',function(Blueprint $table){
                $table->renameColumn('published_at','publication_at');
            });
        }
    }
};
