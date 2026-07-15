<?php

namespace App\Repositories\Admin;

use App\Models\Antibiotic;

class AntibioticRepository
{
    public function getAll()
    {
        return Antibiotic::latest()->paginate(10);
    }

    public function create(array $data)
    {
        return Antibiotic::create($data);
    }

    public function update(Antibiotic $antibiotic, array $data)
    {
        $antibiotic->update($data);

        return $antibiotic;
    }

    public function delete(Antibiotic $antibiotic)
    {
        return $antibiotic->delete();
    }

    public function find(Antibiotic $antibiotic)
    {
        return $antibiotic;
    }
}