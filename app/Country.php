<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['name', 'iso_alpha3', 'flag'];

    public function competition() {
        return $this->hasMany('App\Competition');
    }

}
