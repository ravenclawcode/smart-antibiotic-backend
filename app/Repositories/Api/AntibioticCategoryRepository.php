<?php

namespace App\Repositories\Api;

use App\Models\AntibioticCategory;
use App\Models\Antibiotic;

class AntibioticCategoryRepository
{
    public function getAll()
    {
        return AntibioticCategory::latest()->get();
    }

    public function antibiotics(
        int $categoryId
    ) {
        return Antibiotic::where(
            'antibiotic_category_id',
            $categoryId
        )->latest()->get();
    }

    public function find(
        int $categoryId,
        int $antibioticId
    ) {
        return Antibiotic::where(
            'antibiotic_category_id',
            $categoryId
        )
            ->where(
                'id',
                $antibioticId
            )
            ->firstOrFail();
    }
}
