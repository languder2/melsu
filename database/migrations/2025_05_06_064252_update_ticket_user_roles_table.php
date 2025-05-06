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
        if(!Schema::hasColumn('ticket_user_roles', 'is_responsible')) {
            Schema::table('ticket_user_roles', function (Blueprint $table) {
               $table->boolean('is_responsible')->nullable()->default(null)->after('user_id');
               $table->timestamp('deleted_at')->nullable()->after('post');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasColumn('ticket_user_roles', 'is_responsible')) {
            Schema::table('ticket_user_roles', function (Blueprint $table) {
                $table->dropColumn('is_responsible');
                $table->dropColumn('deleted_at');
            });
        }
    }
};
