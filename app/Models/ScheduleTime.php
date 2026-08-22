<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ScheduleTime extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'schedule_id',
        'reminder_time',
    ];

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(
            MedicineSchedule::class,
            'schedule_id'
        );
    }

    public function histories(): HasMany
    {
        return $this->hasMany(
            MedicineHistory::class,
            'schedule_time_id'
        );
    }

    public function exceptions(): HasMany
    {
        return $this->hasMany(
            MedicineScheduleException::class,
            'schedule_time_id'
        );
    }
}
