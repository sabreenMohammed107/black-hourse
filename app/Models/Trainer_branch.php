<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainer_branch extends Model
{
    use HasFactory;
    protected $fillable = [
        'trainer_id',
    'branch_id',

    ];
    public function trainer(){
        return $this->belongsTo('App\Models\Trainer', 'trainer_id');
    }
    public function branch(){
        return $this->belongsTo('App\Models\Branch', 'branch_id');
    }
}
