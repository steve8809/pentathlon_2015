<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competitiongroup extends Model
{
    protected $fillable = ['name', 'competition', 'date', 'type', 'age_group', 'sex'];
}
