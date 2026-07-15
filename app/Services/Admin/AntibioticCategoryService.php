<?php

namespace App\Services\Admin;

use App\Models\AntibioticCategory;
use App\Repositories\Admin\AntibioticCategoryRepository;
use Illuminate\Support\Facades\Storage;

class AntibioticCategoryService
{
    public function __construct(
        protected AntibioticCategoryRepository $repository
    ) {}

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function create(array $data)
    {
        if (!empty($data['image'])) {

            $data['image'] = $data['image']->store(
                'categories',
                'public'
            );
        }

        return $this->repository->create($data);
    }

    public function update(
        AntibioticCategory $category,
        array $data
    ) {

        if (!empty($data['image'])) {

            if ($category->image) {

                Storage::disk('public')
                    ->delete($category->image);
            }

            $data['image'] = $data['image']->store(
                'categories',
                'public'
            );
        }

        return $this->repository->update(
            $category,
            $data
        );
    }

    public function delete(AntibioticCategory $category)
    {
        if ($category->image) {

            Storage::disk('public')
                ->delete($category->image);
        }

        return $this->repository->delete($category);
    }
}
