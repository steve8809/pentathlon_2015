<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Results_team extends Model
{
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
