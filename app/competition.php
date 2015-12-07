<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class competition extends Model
{
    protected $table = 'competition';

    protected $fillable = ['compID','compName','maxTeamSize'];
    public $timestamps = false;
}
