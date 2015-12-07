<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class team extends Model
{
    protected $table = 'team';

    protected $fillable = ['teamID','teamName','competition'];
    public $timestamps = false;
}
