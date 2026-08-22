<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicineScheduleException extends Model
{
    protected $fillable = [
        'medicine_id',
        'schedule_time_id',
        'scheduled_date',
        'action',
        'dosage',
        'dosage_unit',
        'instruction',
        'reminder_time',
    ];

    protected $casts = [
        'scheduled_date' => 'date',
        'reminder_time' => 'string',
    ];

    public function medicine(): BelongsTo
    {
        return $this->belongsTo(
            Medicine::class,
            'medicine_id'
        );
    }

    public function scheduleTime(): BelongsTo
    {
        return $this->belongsTo(
            ScheduleTime::class,
            'schedule_time_id'
        );
    }
}
