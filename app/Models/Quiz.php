<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [

        'level',

        'description'

    ];

    public function questions()
    {
        return $this->hasMany(
            QuizQuestion::class
        );
    }
}
