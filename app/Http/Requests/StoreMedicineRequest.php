<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMedicineRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'uuid' => [
                'required',
                'uuid'
            ],
            'medicine_catalog_id' => [
                'required',
                'exists:medicine_catalogs,id'
            ],
            'dosage' => [
                'required',
                'string',
                'max:100'
            ],
            'instruction' => [
                'nullable',
                'string'
            ],
            'start_date' => [
                'required',
                'date',
                'after_or_equal:today'
            ],
            'end_date' => [
                'required',
                'date',
                'after_or_equal:start_date'
            ],
            'frequency_type' => [
                'required',
                Rule::in([
                    'daily',
                    'certain_days',
                    'interval_days',
                    'interval_weeks',
                    'interval_months'
                ])
            ],
            'times_per_day' => [
                'required_if:frequency_type,daily',
                'nullable',
                'integer',
                'min:1'
            ],
            'interval_value' => [
                'required_if:frequency_type,interval_days,interval_weeks,interval_months',
                'nullable',
                'integer',
                'min:1'
            ],
            'days' => [
                'required_if:frequency_type,certain_days',
                'nullable',
                'array'
            ],
            'days.*' => [

                Rule::in([
                    'senin',
                    'selasa',
                    'rabu',
                    'kamis',
                    'jumat',
                    'sabtu',
                    'minggu'
                ])

            ],
            'dates' => [
                'nullable',
                'array'
            ],
            'dates.*' => [
                'integer',
                'between:1,31'
            ],
            'times' => [
                'required',
                'array',
                'min:1'
            ],
            'times.*' => [
                'date_format:H:i'
            ]
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $frequency = $this->frequency_type;
            $times = $this->times ?? [];
            $timesPerDay = $this->times_per_day;

            /*
         |---------------------------------
         | DAILY
         |---------------------------------
         */
            if ($frequency === 'daily') {
                if (!$timesPerDay) {
                    $validator->errors()->add(
                        'times_per_day',
                        'Times per day wajib diisi.'
                    );
                }

                if (count($times) != $timesPerDay) {
                    $validator->errors()->add(
                        'times',
                        'Jumlah reminder harus sama dengan times_per_day.'
                    );
                }
            }

            /*
         |---------------------------------
         | CERTAIN DAYS
         |---------------------------------
         */
            if ($frequency === 'certain_days') {
                if (empty($this->days)) {
                    $validator->errors()->add(
                        'days',
                        'Minimal pilih satu hari.'
                    );
                }
            }

            /*
         |---------------------------------
         | INTERVAL
         |---------------------------------
         */
            if ($this->frequency_type == 'interval_months') {
                $rules['dates'] = [
                    'required',
                    'array',
                    'min:1'
                ];
            }

            if (
                in_array($frequency, [
                    'interval_days',
                    'interval_weeks',
                    'interval_months'
                ])
                &&
                !$this->interval_value
            ) {

                $validator->errors()->add(
                    'interval_value',
                    'Interval wajib diisi.'
                );
            }
        });
    }
}
