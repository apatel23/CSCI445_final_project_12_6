<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentCompetitionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_competition', function (Blueprint $table) {
            $table->integer('compID')->unsigned();
            $table->foreign('compID')->references('compID')->on('competition');
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
        Schema::drop('student_competition');
    }
}
