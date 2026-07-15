<?php

namespace App\Repositories\Api;

use App\Models\MedicineCatalog;

class MedicineCatalogRepository
{
    public function getAll()
    {
        return MedicineCatalog::latest()->get();
    }
}