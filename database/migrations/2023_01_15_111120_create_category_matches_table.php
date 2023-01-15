<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('local_id');
            $table->foreignId('visitor_id')->nullable();
            $table->foreignId('prompter_id');
            $table->json('report');
            $table->string('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_matches');
    }
};
