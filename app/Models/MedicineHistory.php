<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicineHistory extends Model
{
    protected $fillable = [
        'schedule_time_id',
        'medicine_name',
        'dosage',
        'dosage_unit',
        'scheduled_date',
        'status',
        'taken_at',
        'notes',
        'rescheduled_time',
    ];

    protected $casts = [
        'scheduled_date' => 'date',
        'taken_at' => 'datetime',
        'rescheduled_time' => 'datetime'
    ];

    public function scheduleTime()
    {
        return $this->belongsTo(
            ScheduleTime::class,
            'schedule_time_id'
        );
    }
}
