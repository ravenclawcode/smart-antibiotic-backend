<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Antibiotic extends Model
{
    protected $fillable = [
        'antibiotic_category_id',
        'name',
        'image',
        'summary',
        'indication',
        'mechanism',
        'dosage',
        'video_url',
        'video_title',
        'video_duration',
        'video_thumbnail',
    ];

    public function category()
    {
        return $this->belongsTo(
            AntibioticCategory::class,
            'antibiotic_category_id'
        );
    }

    public function medicines()
    {
        return $this->hasMany(
            Medicine::class
        );
    }
}
