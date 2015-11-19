<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = ['competitiongroup_id', 'competitor_id', 'fencing_win', 'fencing_lose', 'fencing_points', 'swimming_time', 'swimming_points', 'riding_points', 'riding_horse', 'ce_time', 'ce_points'];

    public function competitor() {
        return $this->belongsTo('App\Competitor');
    }
}
