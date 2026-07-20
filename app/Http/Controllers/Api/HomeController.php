<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Api\HomeService;

class HomeController extends Controller
{
    public function __construct(
        protected HomeService $service
    ) {}

    public function index(
        Request $request
    ) {
        return response()->json([
            'success' => true,
            'data' => $this->service->home(
                $request->user_id,
                $request->date
            )
        ]);
    }
}
