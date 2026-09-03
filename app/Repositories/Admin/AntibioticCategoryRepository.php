<?php

namespace App\Repositories\Admin;

use App\Models\AntibioticCategory;

class AntibioticCategoryRepository
{
    public function getAll()
    {
        return AntibioticCategory::oldest()->paginate(10);
    }

    public function find(int|string $id)
    {
        return AntibioticCategory::findOrFail($id);
    }

    public function create(array $data)
    {
        return AntibioticCategory::create($data);
    }

    public function update(AntibioticCategory $category, array $data)
    {
        $category->update($data);

        return $category;
    }

    public function delete(AntibioticCategory $category)
    {
        return $category->delete();
    }
}
