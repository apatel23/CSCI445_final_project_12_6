<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class student_preferences extends Model
{
    protected $table = 'student_preferences';

    protected $fillable = ['id','c','python','java','teamStyle'];
    public $timestamps = false;
}
