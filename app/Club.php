<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    protected $fillable = ['name', 'country', 'town'];

    public function competitor() {
        return $this->hasMany('App\Competitor');
    }
}
