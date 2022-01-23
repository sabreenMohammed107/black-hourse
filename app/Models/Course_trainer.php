<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course_trainer extends Model
{
    use HasFactory;
    protected $fillable = [
        'trainer_id',
    'course_id',

    ];
    public function trainer(){
        return $this->belongsTo('App\Models\Trainer', 'trainer_id');
    }
    public function course(){
        return $this->belongsTo('App\Models\Course', 'course_id');
    }
}
