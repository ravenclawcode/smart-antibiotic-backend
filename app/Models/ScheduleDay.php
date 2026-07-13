<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduleDay extends Model
{
    public $timestamps = false;

    protected $fillable = [

        'schedule_id',

        'day_of_week'

    ];

    public function schedule()
    {
        return $this->belongsTo(
            MedicineSchedule::class,
            'schedule_id'
        );
    }
}