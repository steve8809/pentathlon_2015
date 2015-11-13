<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competitor extends Model
{
    protected $fillable = ['first_name', 'last_name', 'sex', 'birthday', 'country', 'club', 'full_name'];

    public function results() {
        return $this->belongsTo('App\Results');
    }
}
