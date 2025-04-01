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
        if(Schema::hasColumn('education_profiles','duration')){
            Schema::table('education_profiles', function (Blueprint $table) {
                $table->dropColumn('duration');
            });
        }

        if(!Schema::hasTable('durations')){
            Schema::create('durations', function (Blueprint $table) {

                $table->id();
                $table->string('type');
                $table->integer('duration')->unsigned();
                $table->string('comment')->nullable();
                $table->boolean('active')->default(true);
                $table->integer('sort')->unsigned()->default(1000);
                $table->integer('relation_id')->unsigned()->nullable();
                $table->string('relation_type')->nullable();
                $table->timestamps();

            });
        }


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(!Schema::hasColumn('education_profiles','duration')){
            Schema::table('education_profiles', function (Blueprint $table) {
                $table->integer('duration')->nullable()->unsigned();
            });
        }
        Schema::dropIfExists('durations');
    }
};
