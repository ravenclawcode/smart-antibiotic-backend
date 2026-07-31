<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePreferenceRequest;
use App\Http\Resources\PreferenceResource;
use App\Services\Api\PreferenceService;
use Illuminate\Http\Request;

class PreferenceController extends Controller
{
    public function __construct(
        protected PreferenceService $service
    ) {}

    public function show(Request $request)
    {
        $user = $request->attributes->get('user');

        return response()->json([
            'success' => true,
            'data' => new PreferenceResource(
                $this->service->show(
                    $user->id
                )
            )
        ]);
    }

    public function update(
        Request $request,
        UpdatePreferenceRequest $preferenceRequest
    ) {
        $user = $request->attributes->get('user');

        $preference = $this->service->update(
            $user->id,
            $preferenceRequest->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Preferensi berhasil diperbarui.',
            'data' => new PreferenceResource(
                $preference
            )
        ]);
    }
}
