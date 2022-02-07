<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    'category',
    'fees',
    'image',
    'pdf_file',
    'course_hours',
    'crm_link',
    'note',
    ];
    public function trainer(){
        return $this->belongsToMany('App\Models\Trainer', 'course_trainers','course_id','trainer_id');
    }
    public function rounds(){
        return $this->hasMany('App\Models\Round', 'course_id','id');
    }
    public function deploma(){
        return $this->belongsToMany('App\Models\Deploma', 'deploma_courses','course_id','deploma_id');
    }



}
