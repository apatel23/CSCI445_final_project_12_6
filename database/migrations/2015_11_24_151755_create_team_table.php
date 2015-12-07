<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('team', function (Blueprint $table) {
            $table->increments('teamID');
            $table->string('teamName');
            $table->integer('competition')->unsigned();
            $table->foreign('competition')->references('compID')->on('competition');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('team');
    }
}
