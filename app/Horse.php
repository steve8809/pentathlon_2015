<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horse extends Model
{
    protected $fillable = ['name', 'sex', 'colour', 'age', 'in_competition'];

    public function result() {
        return $this->hasMany('App\Result');
    }
}
