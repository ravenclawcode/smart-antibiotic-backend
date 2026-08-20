<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MedicineHistoryRequest;
use App\Http\Requests\MedicineHistoryFilterRequest;
use App\Services\Api\MedicineHistoryService;
use Illuminate\Http\Request;

class MedicineHistoryController extends Controller
{
    public function __construct(
        protected MedicineHistoryService $service
    ) {}

    public function taken(
        MedicineHistoryRequest $request
    ) {
        return response()->json([
            'success' => true,
            'message' => 'Obat berhasil ditandai diminum.',
            'data' => $this->service->taken(
                $request->validated()
            )
        ]);
    }

    public function skipped(
        MedicineHistoryRequest $request
    ) {
        return response()->json([
            'success' => true,
            'message' => 'Obat berhasil dilewati.',
            'data' => $this->service->skipped(
                $request->validated()
            )
        ]);
    }

    public function reschedule(
        MedicineHistoryRequest $request
    ) {
        return response()->json([
            'success' => true,
            'message' => 'Jadwal berhasil diubah.',
            'data' => $this->service->reschedule(
                $request->validated()
            )
        ]);
    }

    public function missed(
        MedicineHistoryRequest $request
    ) {
        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diperbarui.',
            'data' => $this->service->missed(
                $request->validated()
            )
        ]);
    }

    public function cancel(
        MedicineHistoryRequest $request
    ) {
        return response()->json([
            'success' => true,
            'message' => 'Status obat berhasil dibatalkan.',
            'data' => $this->service->cancel(
                $request->validated()
            )
        ]);
    }

    public function index(Request $request)
    {
        return response()->json([
            'success' => true,
            'data' => $this->service->history($request)
        ]);
    }

    public function filterMedicines(
        MedicineHistoryFilterRequest $request
    ) {
        return response()->json([
            'success' => true,
            'data' => $this->service->filterMedicines(
                $request->user_id
            )
        ]);
    }

    public function exportPdf(Request $request)
    {
        return $this->service->exportPdf($request);
    }
}
