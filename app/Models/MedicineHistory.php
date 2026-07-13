<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicineHistory extends Model
{
    protected $fillable = [

        'schedule_time_id',

        'status',

        'taken_at',

        'reason',

        'notes'

    ];

    protected $casts = [

        'taken_at' => 'datetime'

    ];

    public function scheduleTime()
    {
        return $this->belongsTo(
            ScheduleTime::class
        );
    }
}