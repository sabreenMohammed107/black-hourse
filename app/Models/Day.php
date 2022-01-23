<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;
    public function days(){
        return $this->belongsToMany('App\Models\Round', 'round_days','day_id','round_id');
    }
}
