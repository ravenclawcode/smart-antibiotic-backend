<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOnboardingRequest;
use App\Services\User\UserService;

class UserController extends Controller
{
    public function __construct(
        protected UserService $service
    ) {}

    public function onboarding(
        StoreOnboardingRequest $request
    ) {

        $user = $this->service->onboarding(
            $request->validated()
        );

        if (!$user) {

            return response()->json([
                'success' => false,
                'message' => 'UUID sudah terdaftar.'
            ], 409);
        }

        return response()->json([
            'success' => true,
            'message' => 'Onboarding berhasil.',
            'data' => $user
        ], 201);
    }
}
