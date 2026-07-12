<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Category\AntibioticCategoryService;
use App\Http\Requests\StoreAntibioticCategoryRequest;
use App\Http\Requests\UpdateAntibioticCategoryRequest;
use App\Models\AntibioticCategory;

class AntibioticCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAntibioticCategoryRequest $request)
    {
        $this->service->create(
            $request->validated()
        );

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AntibioticCategory $category)
    {
        return view(
            'admin.categories.edit',
            compact('category')
        );
    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        AntibioticCategory $category
    ) {
        $this->service->delete($category);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
