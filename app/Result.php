<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = ['competitiongroup_id', 'competitor_id', 'sex', 'age_group', 'fencing_status', 'fencing_win', 'fencing_lose', 'penalty_points_fencing', 'fencing_points', 'fencing_order',
        'swimming_status', 'swimming_time', 'penalty_swimming_points', 'swimming_points', 'swimming_order', 'riding_status', 'riding_point', 'riding_time', 'penalty_points_riding', 'riding_points', 'horse_id',
        'riding_order', 'ce_status', 'ce_time', 'penalty_points_ce', 'ce_points', 'ce_order', 'total_points', 'total_penalty_points', 'dsq_status'];

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
