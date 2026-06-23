<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEducationPlaces extends Migration
{
    public function up(): void
    {
        Schema::table('education_places', function (Blueprint $table) {
            $table->dropColumn(['order', 'show', 'deleted_at', 'relation_type']);

            $table->renameColumn('relation_id', 'profile_id');

            $table->unsignedBigInteger('profile_id')->after('id')->change();
        });

        Schema::table('education_places', function (Blueprint $table) {
            DB::statement("DELETE FROM education_places WHERE profile_id NOT IN (SELECT id FROM education_profiles)");

            $table->foreign('profile_id')
                ->references('id')
                ->on('education_profiles')
                ->onDelete('cascade')
                ->onUpdate('cascade')
            ;
        });

    }
}
