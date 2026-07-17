<?php

namespace App\Repositories\Api;

use App\Models\MedicineCatalog;

class MedicineCatalogRepository
{
    public function getAll(?string $search = null)
    {
        return MedicineCatalog::query()

            ->when($search, function ($query) use ($search) {

                $query->where(
                    'name',
                    'like',
                    "%{$search}%"
                );

            })

            ->orderBy('name')
            ->get();
    }
}