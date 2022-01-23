<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deploma_student extends Model
{
    use HasFactory;
    protected $fillable = [
        'deploma_id',
        'student_id',
        'status_id',
        'register_date',
        'total_fees',
        'total_paid',
        'notes',
    ];
    public function student(){
        return $this->belongsTo('App\Models\Student', 'student_id');
    }
    public function status(){
        return $this->belongsTo('App\Models\Request_status', 'status_id');
    }
    public function deploma(){
        return $this->belongsTo('App\Models\Deploma', 'deploma_id');
    }
}
