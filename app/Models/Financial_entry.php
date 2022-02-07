<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Financial_entry extends Model
{
    use HasFactory;
    protected $fillable = [
        'start_balance_date',
        'enrty_type_id',
        'positive',
        'negative',
        'invoice_id',
        'payment_id',
        'notes',
    ];
}
