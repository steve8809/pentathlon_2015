<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    protected $fillable = ['name', 'country_id', 'town', 'host', 'date', 'category', 'in_competition'];

    public function country() {
        return $this->belongsTo('App\Country');
    }

    public function competitiongroup() {
        return $this->hasMany('App\Competitiongroup');
    }

    public function getNameTownDateCategoryAttribute()
    {
        return $this->name.'; '.$this->town.'; '.$this->date.'; '.$this->category;
    }
}