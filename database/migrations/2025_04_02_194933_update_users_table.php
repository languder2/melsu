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
        if(!Schema::hasColumn('users','role')){
            Schema::table('users', function (Blueprint $table) {
               $table->string('role')->default('user')->after('email');
               $table->string('lastname')->nullable()->after('role');
               $table->string('firstname')->nullable()->after('lastname');
               $table->string('middlename')->nullable()->after('firstname');
               $table->string('post')->nullable()->after('middlename');

               $table->timestamp('deleted_at')->nullable()->after('remember_token');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasColumn('users','role')){
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('role');
                $table->dropColumn('deleted_at');
                $table->dropColumn('lastname');
                $table->dropColumn('firstname');
                $table->dropColumn('middlename');
                $table->dropColumn('post');
            });
        }
    }
};
