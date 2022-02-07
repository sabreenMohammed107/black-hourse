<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'company_id',
        'image',
        'active',
    ];
    public function company(){
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
    public function trainer(){
        return $this->belongsToMany('App\Models\Trainer', 'trainer_branches','branch_id','trainer_id');
    }

    public function cashbox(){
        return $this->hasMany('App\Models\Cashbox', 'branch_id','id');
    }
}
