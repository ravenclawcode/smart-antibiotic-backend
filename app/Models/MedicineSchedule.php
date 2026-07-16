<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicineSchedule extends Model
{
    protected $fillable = [
        'medicine_id',
        'frequency_type',
        'times_per_day',
        'interval_value'
    ];

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }

    public function days()
    {
        return $this->hasMany(ScheduleDay::class, 'schedule_id');
    }

    public function times()
    {
        return $this->hasMany(ScheduleTime::class, 'schedule_id');
    }
}
