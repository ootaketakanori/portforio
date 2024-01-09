<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work_time extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_id',
        'start_time',
        'end_time',
        'break_start_time',
        'break_end_time',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
