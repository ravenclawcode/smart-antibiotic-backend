<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAntibioticRequest;
use App\Http\Requests\UpdateAntibioticRequest;
use App\Models\Antibiotic;
use App\Models\AntibioticCategory;
use App\Services\Antibiotic\AntibioticService;

class AntibioticController extends Controller
{
    public function __construct(
        protected AntibioticService $service
    ) {}

    public function index()
    {
        $antibiotics = $this->service->getAll();

        return view(
            'admin.antibiotics.index',
            compact('antibiotics')
        );
    }

    public function create()
    {
        $categories = AntibioticCategory::orderBy('name')->get();

        return view(
            'admin.antibiotics.create',
            compact('categories')
        );
    }

    public function store(StoreAntibioticRequest $request)
    {
        $this->service->create(
            $request->validated()
        );

        return redirect()
            ->route('admin.antibiotics.index')
            ->with('success','Data berhasil ditambahkan.');
    }

    public function edit(Antibiotic $antibiotic)
    {
        $categories = AntibioticCategory::orderBy('name')->get();

        return view(
            'admin.antibiotics.edit',
            compact(
                'antibiotic',
                'categories'
            )
        );
    }

    public function update(
        UpdateAntibioticRequest $request,
        Antibiotic $antibiotic
    ) {
        $this->service->update(
            $antibiotic,
            $request->validated()
        );

        return redirect()
            ->route('admin.antibiotics.index')
            ->with('success','Data berhasil diubah.');
    }

    public function destroy(Antibiotic $antibiotic)
    {
        $this->service->delete($antibiotic);

        return back()->with(
            'success',
            'Data berhasil dihapus.'
        );
    }
}