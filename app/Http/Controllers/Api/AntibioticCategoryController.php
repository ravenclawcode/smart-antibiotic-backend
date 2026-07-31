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
        $data = $this->service->antibiotics(
            $category
        );

        if ($data === null) {
            return response()->json([
                'success' => false,
                'message' => 'Kategori antibiotik tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => AntibioticListResource::collection(
                $data
            )
        ], 200);
    }

    public function show(
        int $category,
        int $antibiotic
    ) {
        $data = $this->service->find(
            $category,
            $antibiotic
        );

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Antibiotik tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new AntibioticDetailResource(
                $data
            )
        ], 200);
    }
}
