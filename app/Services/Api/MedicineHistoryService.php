<?php

namespace App\Services\Api;

use App\Repositories\Api\MedicineHistoryRepository;
use Illuminate\Http\Request;

class MedicineHistoryService
{
    public function __construct(
        protected MedicineHistoryRepository $repository
    ) {}

    public function taken(array $data)
    {
        return $this->repository->taken($data);
    }

    public function skipped(array $data)
    {
        return $this->repository->skipped($data);
    }

    public function reschedule(array $data)
    {
        return $this->repository->reschedule($data);
    }

    public function missed(array $data)
    {
        return $this->repository->missed($data);
    }

    public function history(Request $request)
    {
        return $this->repository->history($request);
    }

    public function filterMedicines(int $userId)
    {
        return $this->repository->filterMedicines($userId);
    }

    public function exportPdf($request)
    {
        return $this->repository->exportPdf($request);
    }
}
