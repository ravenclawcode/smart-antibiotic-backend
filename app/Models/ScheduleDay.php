<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScheduleDay extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'schedule_id',
        'value',
    ];

    protected $casts = [
        'value' => 'integer',
    ];

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(
            MedicineSchedule::class,
            'schedule_id'
        );
    }
}
