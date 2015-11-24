<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    protected $fillable = ['name', 'country_id', 'town', 'host', 'date', 'category'];

    public function country() {
        return $this->belongsTo('App\Country');
    }

    public function competitiongroup() {
        return $this->hasMany('App\Competitiongroup');
    }
}
