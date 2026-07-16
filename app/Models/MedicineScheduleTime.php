<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicineScheduleTime extends Model
{
    protected $fillable = [
        'medicine_schedule_id',
        'time',
    ];

    public function schedule()
    {
        return $this->belongsTo(MedicineSchedule::class);
    }

    public function histories()
    {
        return $this->hasMany(MedicineHistory::class);
    }
}
