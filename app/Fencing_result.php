<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fencing_result extends Model
{
    protected $fillable = ['competitiongroup_id', 'competitor1_id', 'competitor2_id', 'competitor1_bouts', 'competitor2_bouts'];

    protected $table = 'fencing_results';
}
