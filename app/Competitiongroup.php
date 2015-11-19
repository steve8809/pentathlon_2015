<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competitiongroup extends Model
{
    protected $fillable = ['name', 'competition_id', 'date', 'type', 'age_group', 'sex'];

    public function competition() {
        return $this->belongsTo('App\Competition');
    }
}
