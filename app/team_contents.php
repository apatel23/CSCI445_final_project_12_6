<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class team_contents extends Model
{
    protected $table ='team_contents';

    protected $fillable = ['teamID','studentID'];
    public $timestamps = false;
}
