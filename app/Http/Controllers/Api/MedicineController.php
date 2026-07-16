<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\MedicineService;
use Illuminate\Http\Request;
use App\Http\Resources\MedicineResource;
use App\Http\Resources\MedicineDetailResource;
use App\Models\Medicine;
use App\Http\Requests\StoreMedicineRequest;
use App\Http\Requests\UpdateMedicineRequest;

class MedicineController extends Controller
{
    public function __construct(
        protected MedicineService $service
    ) {}

    public function index(Request $request)
    {
        $request->validate([
            'uuid' => [
                'required',
                'uuid'
            ]
        ]);

        $medicines = $this->service->getByUuid(
            $request->uuid
        );

        return response()->json([
            'success' => true,
            'data' => MedicineResource::collection(
                $medicines
            )
        ]);
    }

    public function show(
        Request $request,
        Medicine $medicine
    ) {
        $request->validate([
            'uuid' => [
                'required',
                'uuid'
            ]
        ]);

        $medicine = $this->service->findByUuid(
            $medicine->id,
            $request->uuid
        );

        return response()->json([
            'success' => true,
            'data' => new MedicineDetailResource(
                $medicine
            )
        ]);
    }

    public function store(
        StoreMedicineRequest $request
    ) {
        $medicine = $this->service->create(
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Obat berhasil ditambahkan.',
            'data' => new MedicineDetailResource(
                $medicine
            )
        ], 201);
    }

    public function update(
        UpdateMedicineRequest $request,
        Medicine $medicine
    ) {
        $medicine = $this->service->updateByUuid(
            $medicine->id,
            $request->uuid,
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Obat berhasil diperbarui.',
            'data' => new MedicineDetailResource(
                $medicine
            )
        ]);
    }

    public function destroy(
        Request $request,
        Medicine $medicine
    ) {
        $request->validate([
            'uuid' => [
                'required',
                'uuid'
            ]
        ]);

        $this->service->deleteByUuid(
            $medicine->id,
            $request->uuid
        );

        return response()->json([
            'success' => true,
            'message' => 'Obat berhasil dihapus.'
        ]);
    }
}
