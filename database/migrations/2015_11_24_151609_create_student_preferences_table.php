<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentPreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('student_preferences', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->foreign('id')->references('id')->on('users');
            $table->integer('python');
            $table->integer('java');
            $table->integer('c');
            $table->integer('teamStyle');
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
        Schema::drop('student_preferences');
    }
}
