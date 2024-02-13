<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'start_time',
        'end_time',
        'break_duration',
        'work_duration',
    ];

    protected $table = 'attendances';

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function getData()
    {
        return $this->all();
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
