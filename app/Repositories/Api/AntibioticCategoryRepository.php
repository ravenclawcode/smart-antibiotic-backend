<?php

namespace App\Repositories\Api;

use App\Models\AntibioticCategory;

class AntibioticCategoryRepository
{
    public function getAll()
    {
        return AntibioticCategory::latest()->get();
    }

    public function antibiotics(
        int $categoryId
    ) {
        return \App\Models\Antibiotic::where(
            'antibiotic_category_id',
            $categoryId
        )->latest()->get();
    }
}
