<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAntibioticCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100|unique:antibiotic_categories,name',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:4096',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.unique' => 'Kategori sudah ada.',
            'image.image' => 'Image harus berupa gambar.',
        ];
    }
}
