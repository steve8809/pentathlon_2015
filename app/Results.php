<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Results extends Model
{
    public function competitor() {
        return $this->belongsTo('App\Competitor');
    }
}
