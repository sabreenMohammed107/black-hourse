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
        'certificate_status_id',
        'register_date',
        'total_fees',
        'total_paid',
        'note',
        'deploma_flag'
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

    public function attend(){
        return $this->hasMany('App\Models\Attendance', 'student_round_id','id');
    }
}
