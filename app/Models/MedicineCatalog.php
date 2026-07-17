<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicineCatalog extends Model
{
    protected $fillable = [
        'name',
        'image',
    ];

    public function medicines()
    {
        return $this->hasMany(
            Medicine::class,
            'medicine_catalog_id'
        );
    }
}
