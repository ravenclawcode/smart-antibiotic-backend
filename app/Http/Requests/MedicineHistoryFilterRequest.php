<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicineHistoryFilterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'medicine_id' => [
                'nullable',
                'integer',
                'exists:medicines,id'
            ],

            'format' => [
                'nullable',
                'string',
                'in:daily,weekly,monthly'
            ],

            'start_date' => [
                'nullable',
                'date'
            ],

            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date'
            ]
        ];
    }
}
