<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Staff\Staff;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {


        if (!Schema::hasTable('staff_posts')){
            Schema::create('staff_posts', function (Blueprint $table) {
                $table->id();

                $table->text('post');
                $table->date('employment')->nullable();
                $table->date('dismissal')->nullable();
                $table->tinyInteger('show')->default(true)->nullable();

                $table->integer('relation_id')->nullable();
                $table->string('relation_type')->nullable();

                $table->integer('order')->default(10000);
                $table->timestamp('deleted_at')->nullable();

                $table->timestamps();
            });

            if (Schema::hasColumn('staffs','works'))
                Staff::DataTransfer();
        }

        if (Schema::hasColumn('staffs','works'))
            Schema::table('staffs', function (Blueprint $table) {
                $table->dropColumn('works');

            });

        if (Schema::hasColumn('staffs','post'))
            Schema::table('staffs', function (Blueprint $table) {
                $table->dropColumn('post');

            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_posts');
    }
};
