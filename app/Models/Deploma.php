<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deploma extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'fees',
        'notes',
    ];
    public function course(){
        return $this->belongsToMany('App\Models\Course', 'deploma_courses','deploma_id','course_id');
    }
}
