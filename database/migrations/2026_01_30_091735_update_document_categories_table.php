<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected string $table;

    public function __construct()
    {
        $model =  new \App\Models\Documents\DocumentCategory();

        $this->table = $model->getTable();
    }

    public function up(): void
    {

        if(!Schema::hasColumn($this->table, 'is_approved')) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->unsignedTinyInteger('is_approved')
                    ->after('is_show')
                    ->default(1);

                $table->unsignedTinyInteger('is_approved')
                    ->default(0)
                    ->change()
                ;

            });
        }

    }

    public function down(): void
    {
        if(Schema::hasColumn($this->table, 'is_approved')) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->dropColumn('is_approved');
            });
        }
    }
};
