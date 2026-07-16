<?php

namespace App\Repositories\Admin;

use App\Models\MedicineCatalog;

class MedicineCatalogRepository
{
    public function getAll()
    {
        return MedicineCatalog::latest()->paginate(10);
    }

    public function create(array $data)
    {
        return MedicineCatalog::create($data);
    }

    public function update(
        MedicineCatalog $medicine,
        array $data
    ) {
        $medicine->update($data);

        return $medicine;
    }

    public function delete(MedicineCatalog $medicine)
    {
        return $medicine->delete();
    }
}
