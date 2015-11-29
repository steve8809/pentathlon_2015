<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Swimming_ce_rule extends Model
{
    protected $fillable = ['type', 'age_group', 'swimming_time', 'ce_time', 'swimming_dist', 'ce_dist'];
}
