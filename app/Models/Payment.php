<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'start_balance_date',
        'deploma_id',
        'round_id',
        'amount',
        'cashbox_id',
        'student_id',
        'trainer_id',
        'employee_id',
        'user_id',
        'payment_type_id',
        'notes',
        'system_notes',
    ];

    public function type(){
        return $this->belongsTo('App\Models\Payment_type', 'payment_type_id');
    }
    public function round(){
        return $this->belongsTo('App\Models\Round', 'round_id');

    }

    public function student(){
        return $this->belongsTo('App\Models\Student', 'student_id');

    }


    public function trainer(){
        return $this->belongsTo('App\Models\Trainer', 'trainer_id');

    }
    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function cashbox(){
        return $this->belongsTo('App\Models\Cashbox', 'cashbox_id');
    }
}
