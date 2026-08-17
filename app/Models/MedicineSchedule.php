<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MedicineSchedule extends Model
{
    protected $fillable = [
        'medicine_id',
        'frequency_type',
        'times_per_day',
        'interval_value',
    ];

    protected $casts = [
        'times_per_day' => 'integer',
        'interval_value' => 'integer',
    ];

    public function medicine(): BelongsTo
    {
        return $this->belongsTo(
            Medicine::class
        );
    }

    public function days(): HasMany
    {
        return $this->hasMany(
            ScheduleDay::class,
            'schedule_id'
        );
    }

    public function times(): HasMany
    {
        return $this->hasMany(
            ScheduleTime::class,
            'schedule_id'
        );
    }
}
