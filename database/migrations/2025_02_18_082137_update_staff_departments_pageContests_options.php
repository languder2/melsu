<?php

use App\Models\Global\DataTransfer;
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

        if(!Schema::hasTable('options')){
            Schema::create('options', function (Blueprint $table) {
                $table->id();

                $table->string('name')->nullable();
                $table->string('code');

                $table->string('property')->default('default');

                $table->integer('relation_id')->nullable();
                $table->string('relation_type')->nullable();

                $table->timestamps();
            });
        }

        if(!Schema::hasTable('page_contents')){
            Schema::create('page_contents', function (Blueprint $table) {
                $table->id();

                $table->string('title');
                $table->tinyInteger('show_title')->default(1)->nullable();
                $table->string('code')->nullable();
                $table->string('component')->nullable();
                $table->longText('content')->nullable();

                $table->integer('relation_id')->nullable();
                $table->string('relation_type')->nullable();

                $table->tinyInteger('show')->default(1)->nullable();
                $table->integer('order')->default(10000)->nullable();

                $table->timestamp('deleted_at')->nullable();
                $table->timestamps();
            });
        }


        if(!Schema::hasColumn('staff_affiliation','type')){
            Schema::table('staff_affiliation', function (Blueprint $table) {
                $table->string('type')->after('id')->nullable();
            });
        }

        if(Schema::hasColumn('staff_posts','type')){
            Schema::table('staff_posts', function (Blueprint $table) {
                $table->dropColumn('type');
            });
        }

        if(Schema::hasColumn('staff_affiliation','show')){
            Schema::table('staff_affiliation', function (Blueprint $table) {
                $table->tinyInteger('show')->default(1)->after('order')->change();
            });
        }

        DataTransfer::DepartmentSections();
        DataTransfer::DepartmentsStaff();

        Schema::dropIfExists('department_staffs');

        Schema::dropIfExists('department_documents');

        Schema::dropIfExists('department_sections');

        if(Schema::hasColumn('departments','chief'))
            Schema::table('departments',function(Blueprint $table){
                $table->dropColumn('chief');
            });

        if(Schema::hasColumn('departments','chief_post'))
            Schema::table('departments',function(Blueprint $table){
                $table->dropColumn('chief_post');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_contents');
        Schema::dropIfExists('options');
    }
};
