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
            'user_id' => [
                'required',
                'exists:users,id'
            ],

            'medicine_id' => [
                'nullable',
                'exists:medicines,id'
            ],

            'format' => [
                'nullable',
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
