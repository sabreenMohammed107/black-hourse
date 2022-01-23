<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deploma_course extends Model
{
    use HasFactory;
    protected $fillable = [
        'deploma_id',
    'course_id',

    ];
    public function deploma(){
        return $this->belongsTo('App\Models\Deploma', 'deploma_id');
    }
    public function course(){
        return $this->belongsTo('App\Models\Course', 'course_id');
    }
}
