<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MedicineCatalogResource;
use App\Services\Api\MedicineCatalogService;

class MedicineCatalogController extends Controller
{
    public function __construct(

        protected MedicineCatalogService $service

    ) {}

    public function index(Request $request)
    {
        $catalogs = $this->service->getAll(
            $request->search
        );

        return response()->json([
            'success' => true,
            'data' => MedicineCatalogResource::collection(
                $catalogs
            )
        ]);
    }
}
