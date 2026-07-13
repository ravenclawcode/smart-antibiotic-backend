<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Medicine\MedicineService;

class MedicineController extends Controller
{
    public function __construct(
        protected MedicineService $service
    ) {}

    public function index()
    {
        $medicines = $this->service->getAll();

        return view(
            'admin.medicines.index',
            compact('medicines')
        );
    }

    public function show($id)
    {
        $medicine = $this->service->find($id);

        return view(
            'admin.medicines.show',
            compact('medicine')
        );
    }

    public function destroy($id)
    {
        $medicine = $this->service->find($id);

        $this->service->delete($medicine);

        return redirect()
            ->route('admin.medicines.index')
            ->with(
                'success',
                'Data obat berhasil dihapus.'
            );
    }
}
