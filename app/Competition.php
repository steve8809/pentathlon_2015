<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    protected $fillable = ['name', 'country', 'town', 'host', 'start_date', 'end_date', 'category'];
}
