<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AntibioticCategoryService;
use App\Http\Requests\StoreAntibioticCategoryRequest;
use App\Http\Requests\UpdateAntibioticCategoryRequest;
use App\Models\AntibioticCategory;

class AntibioticCategoryController extends Controller
{
    protected AntibioticCategoryService $service;

    public function __construct(
        AntibioticCategoryService $service
    ) {
        $this->service = $service;
    }

    public function index()
    {
        $categories = $this->service->getAll();

        return view(
            'admin.categories.index',
            compact('categories')
        );
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(StoreAntibioticCategoryRequest $request)
    {
        $this->service->create(
            $request->validated()
        );

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(AntibioticCategory $category)
    {
        return view(
            'admin.categories.edit',
            compact('category')
        );
    }

    public function update(
        UpdateAntibioticCategoryRequest $request,
        AntibioticCategory $category
    ) {
        $this->service->update(
            $category,
            $request->validated()
        );

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil diubah.');
    }

    public function destroy(
        AntibioticCategory $category
    ) {
        $this->service->delete($category);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
