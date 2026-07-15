<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\AntibioticService;

class AntibioticController extends Controller
{
    public function __construct(
        protected AntibioticService $service
    ) {}

    public function show(
        int $id
    )
    {
        return response()->json([

            'success' => true,

            'data' => $this->service->find(
                $id
            )

        ]);
    }
}