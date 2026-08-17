<?php

namespace App\Repositories\Api;

use App\Models\AntibioticCategory;
use App\Models\Antibiotic;

class AntibioticCategoryRepository
{
    public function getAll()
    {
        return AntibioticCategory::withCount('antibiotics')
            ->oldest()
            ->get();
    }

    public function antibiotics(
        int $categoryId
    ) {
        $category = AntibioticCategory::find(
            $categoryId
        );

        if (!$category) {
            return null;
        }

        return Antibiotic::where(
            'antibiotic_category_id',
            $categoryId
        )
            ->oldest()
            ->get();
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
            ->first();
    }

    public function searchCategories(string $keyword)
    {
        return AntibioticCategory::withCount('antibiotics')
            ->where('name', 'like', '%' . $keyword . '%')
            ->latest()
            ->get();
    }
}
