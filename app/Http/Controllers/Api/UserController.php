<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\UserService;
use App\Http\Requests\StoreOnboardingRequest;
use App\Http\Requests\UpdateProfileRequest;

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

    public function splash(
        string $uuid
    ) {
        $user = $this->service
            ->findByUuid($uuid);

        if (!$user) {

            return response()->json([

                'success' => true,

                'is_registered' => false

            ]);
        }

        return response()->json([

            'success' => true,

            'is_registered' => true,

            'data' => $user

        ]);
    }

    public function profile(
        string $uuid
    ) {
        $user = $this->service
            ->getProfile($uuid);

        return response()->json([

            'success' => true,

            'data' => $user

        ]);
    }

    public function updateProfile(
        UpdateProfileRequest $request,
        string $uuid
    ) {
        $user = $this->service->updateProfile(
            $uuid,
            $request->validated()
        );

        return response()->json([

            'success' => true,

            'message' => 'Profil berhasil diperbarui.',

            'data' => $user

        ]);
    }
}
