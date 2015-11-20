<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fencing_rule extends Model
{
    protected $fillable = ['bouts_250', 'victory_points'];
}
