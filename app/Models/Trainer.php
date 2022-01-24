<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Trainer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    'mobile',
    'email',
    'image',
    'cv_pdf',
    'address',
    'notes',
    ];
    public function course(){
        return $this->belongsToMany('App\Models\Course', 'course_trainers','trainer_id','course_id');
    }
    public function branch(){
        return $this->belongsToMany('App\Models\Branch', 'trainer_branches','trainer_id','branch_id');
    }
    public function rounds_old(){
        return $this->hasMany('App\Models\Round', 'trainer_id','id')->where('status_id', '=',3);
        // return $this->hasMany('App\Models\Round', 'trainer_id','id')->where('end_date', '<',Carbon::now()->toDateString());

    }
    public function rounds_new(){
        // return $this->hasMany('App\Models\Round', 'trainer_id','id')->where('end_date', '>',Carbon::now()->toDateString());
        return $this->hasMany('App\Models\Round', 'trainer_id','id')->where('status_id', '=',2);

    }
}
