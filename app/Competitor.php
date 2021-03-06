<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competitor extends Model
{
    protected $fillable = ['first_name', 'last_name', 'sex', 'birthday', 'country_id', 'club_id', 'full_name', 'in_competition'];

    public function country() {
        return $this->belongsTo('App\Country');
    }

    public function result() {
        return $this->hasMany('App\Result');
    }

    public function club() {
        return $this->belongsTo('App\Club');
    }

    public function getFullNameBirthdayAttribute()
    {
        return $this->full_name.' ('.$this->birthday.')';
    }

}
