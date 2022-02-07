<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_no',
    'invoice_date',
    'student_id',
    'payment_type_id',
    'deploma_id',
    'round_id',
    'total_required_fees',
    'total_paid_before',
    'total_fees_new',
    'user_id',
    'cashbox_id',
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
    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function cashbox(){
        return $this->belongsTo('App\Models\Cashbox', 'cashbox_id');
    }
}
