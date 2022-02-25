<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id',
        'branch_id',
        'room_id',
        'trainer_id',
        'status_id',
        'round_no',
        'start_date',
        'end_date',
        'rent_room_fees',
        'certificate_fees',
        'fees',
        'discount_per',
        'fees_after_discount',
    ];
    public function course(){
        return $this->belongsTo('App\Models\Course', 'course_id');
    }

    public function branch(){
        return $this->belongsTo('App\Models\Branch', 'branch_id');
    }
    public function room(){
        return $this->belongsTo('App\Models\Room', 'room_id');
    }

    public function trainer(){
        return $this->belongsTo('App\Models\Trainer', 'trainer_id');
    }

    public function days(){
        return $this->belongsToMany('App\Models\Day', 'round_days','round_id','day_id');
    }
}
