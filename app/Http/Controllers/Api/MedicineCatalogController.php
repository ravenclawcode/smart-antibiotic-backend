<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\MedicineCatalogService;

class MedicineCatalogController extends Controller
{
    public function __construct(
        protected MedicineCatalogService $service
    ) {}

    public function index()
    {
        return response()->json([

            'success' => true,

            'data' => $this->service->getAll()

        ]);
    }
}
