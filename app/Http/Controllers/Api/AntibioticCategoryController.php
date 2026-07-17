<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\AntibioticCategoryService;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\AntibioticListResource;
use App\Http\Resources\AntibioticDetailResource;

class AntibioticCategoryController extends Controller
{
    public function __construct(
        protected AntibioticCategoryService $service
    ) {}

    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => CategoryResource::collection(
                $this->service->getAll()
            )
        ]);
    }

    public function antibiotics(
        int $category
    ) {
        return response()->json([
            'success' => true,
            'data' => AntibioticListResource::collection(
                $this->service->antibiotics(
                    $category
                )
            )
        ]);
    }

    public function show(
        int $category,
        int $antibiotic
    ) {
        return response()->json([

            'success' => true,

            'data' => new AntibioticDetailResource(

                $this->service->find(
                    $category,
                    $antibiotic
                )

            )

        ]);
    }
}
