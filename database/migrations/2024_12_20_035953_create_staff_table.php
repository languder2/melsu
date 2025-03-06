<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('staffs', function (Blueprint $table) {
            $table->id();

            $table->text('post')->nullable();

            $table->string('photo')->nullable();

            $table->string('lastname');
            $table->string('firstname');
            $table->string('middle_name')->nullable();

            $table->date('birthday')->nullable();
            $table->text('birthplace')->nullable();
            $table->text('residence')->nullable();
            $table->text('education')->nullable();
            $table->text('awards')->nullable();
            $table->text('affiliation')->nullable();
            $table->text('family_status')->nullable();


            $table->text('title')->nullable();
            $table->text('title_alt')->nullable();
            $table->text('reception_time')->nullable();
            $table->string('phones')->nullable();
            $table->text('emails')->nullable();

            $table->text('address')->nullable();

            $table->string('link')->nullable();
            $table->string('alias')->unique()->nullable();

            $table->longText('works')->nullable();

            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staffs');
    }
};
