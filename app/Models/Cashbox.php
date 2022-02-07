<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashbox extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    'branch_id',
    'start_balance_date',
    'current_balance_date',
    'start_blalnc_amount',
    'current_blalnc_amount',
    'notes',
    ];
    public function branch(){
        return $this->belongsTo('App\Models\Branch', 'branch_id');
    }
}
