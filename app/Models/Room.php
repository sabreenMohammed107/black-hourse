<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'room_no',
        'capacity',
        'branch_id',
    ];
    public function branch(){
        return $this->belongsTo('App\Models\Branch', 'branch_id');
    }

    public function rounds(){
        return $this->hasMany('App\Models\Round', 'room_id','id');
    }
    public function sessions()
    {
        return $this->hasManyThrough(
            Session::class,
            Round::class,

            'room_id', // Foreign key on rounds table...
            'round_id', // Foreign key on sessions table...
            'id', // Local key on countries table...
            'id' // Local key on users table...
        );
    }


    public function days()
    {
        return $this->hasManyThrough(
            Round_day::class,
            Round::class,

            'room_id', // Foreign key on rounds table...
            'round_id', // Foreign key on round-days table...
            'id', // Local key on countries table...
            'id' // Local key on users table...
        );
    }
}
