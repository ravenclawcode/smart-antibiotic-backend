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
        $user = $request->attributes->get('user');

        return response()->json([
            'success' => true,
            'data' => $this->service->home(
                $user->id,
                $request->input('date')
            )
        ]);
    }
}
