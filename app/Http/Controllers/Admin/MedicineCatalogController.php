<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMedicineCatalogRequest;
use App\Http\Requests\UpdateMedicineCatalogRequest;
use App\Models\MedicineCatalog;
use App\Services\Admin\MedicineCatalogService;

class MedicineCatalogController extends Controller
{
    public function __construct(
        protected MedicineCatalogService $service
    ) {}

    public function index()
    {
        $medicines = $this->service->getAll();

        return view(
            'admin.medicine-catalog.index',
            compact('medicines')
        );
    }

    public function create()
    {
        return view(
            'admin.medicine-catalog.create'
        );
    }

    public function store(
        StoreMedicineCatalogRequest $request
    ) {

        $this->service->create(
            $request->validated()
        );

        return redirect()
            ->route('admin.medicine-catalog.index')
            ->with(
                'success',
                'Data berhasil ditambahkan.'
            );
    }

    public function edit(
        MedicineCatalog $medicine_catalog
    ) {

        return view(
            'admin.medicine-catalog.edit',
            compact('medicine_catalog')
        );
    }

    public function update(
        UpdateMedicineCatalogRequest $request,
        MedicineCatalog $medicine_catalog
    ) {

        $this->service->update(
            $medicine_catalog,
            $request->validated()
        );

        return redirect()
            ->route('admin.medicine-catalog.index')
            ->with(
                'success',
                'Data berhasil diubah.'
            );
    }

    public function destroy(
        MedicineCatalog $medicine_catalog
    ) {

        $this->service->delete(
            $medicine_catalog
        );

        return back()->with(
            'success',
            'Data berhasil dihapus.'
        );
    }
}
