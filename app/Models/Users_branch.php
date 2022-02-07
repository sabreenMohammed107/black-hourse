<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users_branch extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'branch_id',

    ];

    public function branch(){
        return $this->belongsTo('App\Models\Branch', 'branch_id');
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
