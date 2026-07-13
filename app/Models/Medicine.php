<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $fillable = [

        'user_id',

        'antibiotic_id',

        'dosage',

        'instruction',

        'start_date',

        'end_date',

        'is_active'

    ];

    protected $casts = [

        'start_date' => 'date',

        'end_date' => 'date',

        'is_active' => 'boolean'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function antibiotic()
    {
        return $this->belongsTo(Antibiotic::class);
    }

    public function schedule()
    {
        return $this->hasOne(MedicineSchedule::class);
    }
}