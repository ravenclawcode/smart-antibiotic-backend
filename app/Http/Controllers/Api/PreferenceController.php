<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePreferenceRequest;
use App\Http\Resources\PreferenceResource;
use App\Services\Api\PreferenceService;

class PreferenceController extends Controller
{
    public function __construct(
        protected PreferenceService $service
    ) {}

    public function show(
        string $uuid
    ) {

        return response()->json([
            'success' => true,
            'data' => new PreferenceResource(
                $this->service->show($uuid)
            )

        ]);
    }

    public function update(
        UpdatePreferenceRequest $request,
        string $uuid
    ) {

        $preference = $this->service->update(
            $uuid,
            $request->validated()
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
