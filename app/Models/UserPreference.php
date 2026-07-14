<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model
{
    protected $fillable = [
        'user_id',
        'reminder_type',
        'reminder_sound',
        'pre_reminder_minutes'
    ];

    public function user()
    {
        return $this->belongsTo(
            User::class
        );
    }
}
