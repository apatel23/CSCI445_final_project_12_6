<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('team_contents', function (Blueprint $table) {
            $table->integer('teamID')->unsigned();
            $table->foreign('teamID')->references('teamID')->on('team');
            $table->integer('studentID')->unsigned();
            $table->foreign('studentID')->references('id')->on('users');

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
        Schema::drop('team_contents');
    }
}
