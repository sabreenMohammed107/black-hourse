<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'emp_name',
        'mobile',
        'hire_date',
        'branch_id',
        'job',
        'salary',
        'active',
        'notes',
    ];


    public function branch(){
        return $this->belongsTo('App\Models\Branch', 'branch_id');

    }

}
