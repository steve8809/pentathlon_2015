<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Results_team extends Model
{
    protected $fillable = ['name', 'competitiongroup_id', 'competitor1_id', 'competitor2_id', 'competitor3_id', 'fencing_points', 'fencing_order',
        'swimming_points', 'swimming_order', 'riding_points', 'ce_points', 'ce_order', 'total_points'];

    public function competitor1() {
        return $this->belongsTo('App\Competitor', 'competitor1_id');
    }

    public function competitor2() {
        return $this->belongsTo('App\Competitor', 'competitor2_id');
    }

    public function competitor3() {
        return $this->belongsTo('App\Competitor', 'competitor3_id');
    }
}
