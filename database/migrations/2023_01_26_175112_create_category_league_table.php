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
        Schema::create('category_league', function (Blueprint $table) {
            $table->id();
            $table->foreignId('league_id');
            $table->foreignId('category_id');
            $table->integer('points')->default(0);
            $table->integer('played')->default(0);
            $table->integer('wins')->default(0);
            $table->integer('draws')->default(0);
            $table->integer('losts')->default(0);
            $table->integer('goals_scored')->default(0);
            $table->integer('goals_against')->default(0);
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
        Schema::dropIfExists('category_league');
    }
};
