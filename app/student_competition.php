<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class student_competition extends Model
{
    protected $table ='student_competition';

    protected $fillable = ['compID','studentID'];
    public $timestamps = false;
}