<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'uuid',
        'name',
        'age',
        'gender'
    ];

    public function preference()
    {
        return $this->hasOne(
            UserPreference::class
        );
    }

    public function timezone()
    {
        return $this->preference?->timezone
            ?? 'Asia/Jakarta';
    }

    public function medicines()
    {
        return $this->hasMany(
            Medicine::class
        );
    }

    public function chatSessions()
    {
        return $this->hasMany(
            ChatSession::class
        );
    }
}
