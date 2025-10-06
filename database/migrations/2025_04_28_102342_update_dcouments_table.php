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
        Schema::table('documents', function (Blueprint $table) {
            $table->renameColumn('show','is_show');
            $table->boolean('is_show')->default(true)->after('filetype')->change();
            $table->renameColumn('order','sort');
            $table->integer('sort')->after('is_show')->change();

            $table->string('filename')->nullable()->change();
            $table->text('filename')->nullable()->change();
            $table->string('filetype')->nullable()->change();

            $table->unsignedBigInteger('parent_id')->nullable()->after('title');
            $table->foreign('parent_id')->references('id')->on('documents')
                ->onDelete('set null')->onUpdate('cascade');

            $table->unsignedBigInteger('category_id')->nullable()->after('title');
            $table->foreign('category_id')->references('id')->on('document_categories')
                ->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
