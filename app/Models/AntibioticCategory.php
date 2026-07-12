<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AntibioticCategory extends Model
{
    protected $fillable = [
        'name',
        'image',
        'description'
    ];

    public function antibiotics()
    {
        return $this->hasMany(Antibiotic::class);
    }
}
