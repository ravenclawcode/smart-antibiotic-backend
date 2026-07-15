<?php

namespace App\Repositories\Api;

use App\Models\Antibiotic;

class AntibioticRepository
{
    public function find(
        int $id
    ) {
        return Antibiotic::with(
            'category'
        )->findOrFail($id);
    }
}
