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
}
