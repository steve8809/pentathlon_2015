<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competitor extends Model
{
    protected $fillable = ['first_name', 'last_name', 'sex', 'birthday', 'country_id', 'club', 'full_name'];

    public function country() {
        return $this->belongsTo('App\Country');
    }

    public function result() {
        return $this->hasMany('App\Result');
    }


}