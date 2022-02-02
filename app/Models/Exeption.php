<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exeption extends Model
{
    use HasFactory;
    protected $fillable = [
        'exeption_type_id',
    'deploma_id',
    'round_id',
    'student_id',
    'exeption_date',
    'exeption_status',
    'notes',
    ];
    public function type(){
        return $this->belongsTo('App\Models\Exeption_type', 'exeption_type_id');
    }

    public function deploma(){
        return $this->belongsTo('App\Models\Deploma', 'deploma_id');
    }

    public function round(){
        return $this->belongsTo('App\Models\Round', 'round_id');
    }

    public function student(){
        return $this->belongsTo('App\Models\Student', 'student_id');
    }

}
