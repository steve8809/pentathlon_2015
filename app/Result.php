<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = ['competitiongroup_id', 'competitor_id', 'fencing_status', 'fencing_win', 'fencing_lose', 'fencing_points', 'swimming_time', 'swimming_points',
        'riding_time', 'riding_points', 'horse_id', 'ce_time', 'ce_points'];

    public function competitor() {
        return $this->belongsTo('App\Competitor');
    }

    public function competitiongroup() {
        return $this->belongsTo('App\Competitiongroup');
    }

    public function horse() {
        return $this->belongsTo('App\Horse');
    }
}
