<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\AntibioticCategoryService;

class AntibioticCategoryController extends Controller
{
    public function __construct(
        protected AntibioticCategoryService $service
    ) {}

    public function index()
    {
        return response()->json([

            'success' => true,

            'data' => $this->service->getAll()

        ]);
    }

    public function antibiotics(
        int $category
    ) {
        return response()->json([

            'success' => true,

            'data' => $this->service->antibiotics(
                $category
            )

        ]);
    }
}
