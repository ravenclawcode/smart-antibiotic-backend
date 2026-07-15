<?php

namespace App\Services\Admin;

use App\Models\Antibiotic;
use App\Repositories\Admin\AntibioticRepository;
use Illuminate\Support\Facades\Storage;

class AntibioticService
{
    protected AntibioticRepository $repository;

    public function __construct(AntibioticRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function create(array $data)
    {
        if (isset($data['image']) && $data['image']) {

            $data['image'] = $data['image']->store(
                'antibiotics',
                'public'
            );
        }

        return $this->repository->create($data);
    }

    public function update(
        Antibiotic $antibiotic,
        array $data
    ) {

        if (isset($data['image']) && $data['image']) {

            if ($antibiotic->image) {

                Storage::disk('public')
                    ->delete($antibiotic->image);
            }

            $data['image'] = $data['image']->store(
                'antibiotics',
                'public'
            );
        }

        return $this->repository->update(
            $antibiotic,
            $data
        );
    }

    public function delete(Antibiotic $antibiotic)
    {
        if ($antibiotic->image) {

            Storage::disk('public')
                ->delete($antibiotic->image);
        }

        return $this->repository->delete($antibiotic);
    }
}
