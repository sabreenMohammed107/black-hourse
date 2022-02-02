<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Round_day extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable =
    ['day_id',
        'round_id',
        'from',
        'to',
    ];
    public function day(){
        return $this->belongsTo('App\Models\Day', 'day_id');
    }

    public function round(){
        return $this->belongsTo('App\Models\Round', 'round_id');
    }
}
