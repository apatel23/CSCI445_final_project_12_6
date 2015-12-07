<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class student_classes extends Model
{
    protected $table = 'student_classes';

    protected $fillable = ['id','classID'];
    public $timestamps = false;
}
