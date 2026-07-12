<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAntibioticRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'antibiotic_category_id' => 'required|exists:antibiotic_categories,id',

            'name' => 'required|max:150',

            'image' => 'nullable|image|max:4096',

            'summary' => 'required',

            'indication' => 'required',

            'mechanism' => 'required',

            'dosage' => 'required',

            'video_url' => 'nullable|url'

        ];
    }
}
