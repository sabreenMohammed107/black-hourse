<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_round extends Model
{
    use HasFactory;
    protected $fillable = [
        'round_id',
        'student_id',
        'status_id',
        'register_date',
        'total_fees',
        'total_paid',
        'note',
    ];
    public function student(){
        return $this->belongsTo('App\Models\Student', 'student_id');
    }
    public function status(){
        return $this->belongsTo('App\Models\Request_status', 'status_id');
    }
    public function round(){
        return $this->belongsTo('App\Models\Round', 'round_id');
    }
}