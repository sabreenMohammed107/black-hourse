<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    'mobile',
    'n_id',
    'email',
    'education',
    'job',
    'register_date',
    'company_id',
    'city_id',
    'age',
    'sale_fannel_id',
    'request_status_id',
    'note',
    'contact_date',
    'contact_times',
    'mobile2',
    ];
    public function status(){
        return $this->belongsTo('App\Models\Request_status', 'request_status_id');
    }
    public function funnel(){
        return $this->belongsTo('App\Models\Sale_funnel', 'sale_fannel_id');
    }
    public function company(){
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
    public function city(){
        return $this->belongsTo('App\Models\City', 'city_id');
    }
    public function branches(){
        return $this->belongsToMany('App\Models\Branch', 'student_branches','student_id','branch_id');
    }
    public function rounds(){
        return $this->belongsToMany('App\Models\Round', 'student_rounds','student_id','round_id');
    }
    public function follow()
{
    return $this->hasOne('App\Models\Followup_center')->latest();
}

public function courses(){
    return $this->belongsToMany('App\Models\Course', 'crm_courses','student_id','course_id');
}
}
