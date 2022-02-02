<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;
    protected $fillable = [
        'round_id',
    'session_no',
    'session_date',
    'is_done',
    'is_cancel',
    'notes',
    ];
    public function round(){
        return $this->belongsTo('App\Models\Round', 'round_id');
    }
}
