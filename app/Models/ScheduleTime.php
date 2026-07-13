<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduleTime extends Model
{
    public $timestamps = false;

    protected $fillable = [

        'schedule_id',

        'reminder_time'

    ];

    public function schedule()
    {
        return $this->belongsTo(
            MedicineSchedule::class,
            'schedule_id'
        );
    }

    public function histories()
    {
        return $this->hasMany(
            MedicineHistory::class
        );
    }
}