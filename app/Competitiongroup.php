<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competitiongroup extends Model
{
    protected $fillable = ['name', 'competition_id', 'date', 'type', 'age_group', 'sex', 'bouts_per_match', 'fencing_bouts', 'riding_time'];

    public function competition() {
        return $this->belongsTo('App\Competition');
    }
}
