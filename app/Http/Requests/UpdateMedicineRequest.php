<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMedicineRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'medicine_catalog_id' => [
                'required',
                'exists:medicine_catalogs,id'
            ],
            'dosage' => [
                'required',
                'numeric',
                'min:1'
            ],
            'dosage_unit' => [
                'required',
                'string',
                'max:50',
            ],
            'instruction' => [
                'nullable',
                'string'
            ],
            'start_date' => [
                'required',
                'date'
            ],
            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date'
            ],
            'frequency_type' => [
                'required',
                'in:daily,certain_days,interval_days,interval_weeks,interval_months'
            ],
            'times_per_day' => [
                'required',
                'integer',
                'min:1'
            ],
            'interval_value' => [
                'nullable',
                'integer',
                'min:1'
            ],
            'times' => [
                'required',
                'array',
                'min:1'
            ],
            'times.*' => [
                'date_format:H:i'
            ],
            'days' => [
                'nullable',
                'array'
            ],
            'days.*' => [
                'string'
            ],
            'dates' => [
                'nullable',
                'array'
            ],
            'dates.*' => [
                'integer',
                'between:1,31'
            ]
        ];

        if ($this->frequency_type == 'certain_days') {

            $rules['days'] = [
                'required',
                'array',
                'min:1'
            ];
        }

        if ($this->frequency_type == 'interval_weeks') {

            $rules['days'] = [
                'required',
                'array',
                'min:1'
            ];
        }

        if (
            in_array(
                $this->frequency_type,
                [
                    'interval_days',
                    'interval_weeks',
                    'interval_months'
                ]
            )
        ) {

            $rules['interval_value'] = [
                'required',
                'integer',
                'min:1'
            ];
        }

        if ($this->frequency_type == 'interval_months') {

            $rules['dates'] = [
                'required',
                'array',
                'min:1'
            ];
        }
        return $rules;
    }
}
