<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Followup_center extends Model
{
    use HasFactory;
    protected $fillable = [
        'round_id',
        'student_id',
        'followup_type_id',
        'user_id',
        'followup_date',
        'text',
        'followup_flag',
        'notes',
    ];
    public function type()
    {
        return $this->belongsTo('App\Models\Followup_type', 'followup_type_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function round()
    {
        return $this->belongsTo('App\Models\Round', 'round_id');
    }

    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id');
    }
}
