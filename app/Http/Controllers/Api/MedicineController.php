<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMedicineRequest;
use App\Http\Requests\UpdateMedicineRequest;
use App\Http\Resources\MedicineDetailResource;
use App\Http\Resources\MedicineResource;
use App\Services\Api\MedicineService;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function __construct(
        protected MedicineService $service
    ) {}

    public function index(Request $request)
    {
        $user = $request->attributes->get('user');

        $medicines = $this->service->getByUser(
            $user->id
        );

        return response()->json([
            'success' => true,
            'data' => MedicineResource::collection(
                $medicines
            ),
        ]);
    }

    public function show(
        Request $request,
        int $medicineId
    ) {
        $user = $request->attributes->get('user');

        $medicine = $this->service->findByUser(
            $medicineId,
            $user->id
        );

        if (!$medicine) {
            return response()->json([
                'success' => false,
                'message' => 'Obat tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new MedicineDetailResource(
                $medicine
            ),
        ]);
    }

    public function store(
        Request $request,
        StoreMedicineRequest $medicineRequest
    ) {
        $user = $request->attributes->get('user');

        $medicine = $this->service->create(
            $user->id,
            $medicineRequest->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Obat berhasil ditambahkan.',
            'data' => new MedicineDetailResource(
                $medicine
            ),
        ], 201);
    }

    public function update(
        Request $request,
        UpdateMedicineRequest $medicineRequest,
        int $medicineId
    ) {
        $user = $request->attributes->get('user');

        $medicine = $this->service->updateByUser(
            $medicineId,
            $user->id,
            $medicineRequest->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Obat berhasil diperbarui.',
            'data' => new MedicineDetailResource(
                $medicine
            ),
        ]);
    }

    public function destroy(
        Request $request,
        int $medicineId
    ) {
        $user = $request->attributes->get('user');

        $this->service->deleteByUser(
            $medicineId,
            $user->id
        );

        return response()->json([
            'success' => true,
            'message' =>
            'Obat berhasil dihapus. Riwayat penggunaan tetap tersimpan.',
        ]);
    }

    public function destroyPermanent(
        Request $request,
        int $medicineId
    ) {
        $user = $request->attributes->get('user');

        $this->service->deletePermanentByUser(
            $medicineId,
            $user->id
        );

        return response()->json([
            'success' => true,
            'message' =>
            'Obat dan seluruh riwayatnya berhasil dihapus.',
        ]);
    }

    public function updateDose(
        Request $request,
        int $medicineId
    ) {
        $user = $request->attributes->get('user');

        $data = $request->validate([
            'schedule_time_id' => [
                'required',
                'integer',
            ],

            'scheduled_date' => [
                'required',
                'date',
            ],

            'dosage' => [
                'required',
                'numeric',
                'min:1',
            ],

            'dosage_unit' => [
                'required',
                'string',
                'max:50',
            ],

            'instruction' => [
                'nullable',
                'string',
            ],

            'reminder_time' => [
                'nullable',
                'date_format:H:i',
            ],
        ]);

        $medicine = $this->service->updateDoseByUser(
            $medicineId,
            $user->id,
            $data
        );

        return response()->json([
            'success' => true,
            'message' => 'Dosis berhasil diperbarui.',
            'data' => new MedicineDetailResource(
                $medicine
            ),
        ]);
    }

    public function destroySingleDose(
        Request $request,
        int $medicineId
    ) {
        $user = $request->attributes->get('user');

        $data = $request->validate([
            'schedule_time_id' => [
                'required',
                'integer',
            ],

            'scheduled_date' => [
                'required',
                'date',
            ],
        ]);

        $this->service->deleteSingleDose(
            $medicineId,
            $user->id,
            $data['schedule_time_id'],
            $data['scheduled_date']
        );

        return response()->json([
            'success' => true,
            'message' => 'Dosis berhasil dihapus.',
        ]);
    }
}
