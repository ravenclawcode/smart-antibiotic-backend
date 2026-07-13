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
}
