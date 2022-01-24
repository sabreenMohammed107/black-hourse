<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'session_id',
        'student_round_id',
        'is_atend',
        'room_rent_fees',
        'room_rent_paid',
        'certificate_fees',
        'certificate_paid',
        'notes',
    ];
}
