<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $fillable = [
        'user_id',
        'medicine_catalog_id',
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

    public function catalog()
    {
        return $this->belongsTo(
            MedicineCatalog::class,
            'medicine_catalog_id'
        );
    }

    public function schedule()
    {
        return $this->hasOne(MedicineSchedule::class);
    }
}
