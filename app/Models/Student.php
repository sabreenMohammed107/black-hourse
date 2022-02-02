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
}
