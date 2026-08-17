<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
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
            'name' => [
                'required',
                'string',
                'max:100',
            ],

            'dosage' => [
                'required',
                'numeric',
                'min:1',
            ],

            'dosage_unit' => [
                'required',
                'string',
                'max:50',
            ],

            'instruction' => [
                'nullable',
                'string',
            ],

            'start_date' => [
                'required',
                'date',
            ],

            'end_date' => [
                'required',
                'date',
                'after_or_equal:start_date',
            ],

            'frequency_type' => [
                'required',
                Rule::in([
                    'daily',
                    'certain_days',
                    'interval_days',
                    'interval_weeks',
                    'interval_months',
                ]),
            ],

            'times_per_day' => [
                'required_if:frequency_type,daily',
                'nullable',
                'integer',
                'min:1',
            ],

            'interval_value' => [
                'required_if:frequency_type,interval_days,interval_weeks,interval_months',
                'nullable',
                'integer',
                'min:1',
            ],

            'days' => [
                'nullable',
                'array',
            ],

            'days.*' => [
                'integer',
                'between:1,7',
            ],

            'dates' => [
                'nullable',
                'array',
            ],

            'dates.*' => [
                'integer',
                'between:1,31',
            ],

            'times' => [
                'required',
                'array',
                'min:1',
            ],

            'times.*' => [
                'date_format:H:i',
            ],
        ];
    }

    public function withValidator(
        Validator $validator
    ): void {
        $validator->after(
            function ($validator) {

                $frequency = $this->frequency_type;

                $times = $this->times ?? [];

                $timesPerDay =
                    $this->times_per_day;

                /*
                |--------------------------------------------------------------------------
                | DAILY
                |--------------------------------------------------------------------------
                */

                if ($frequency === 'daily') {

                    if (!$timesPerDay) {
                        $validator->errors()->add(
                            'times_per_day',
                            'Times per day wajib diisi.'
                        );
                    }

                    if (
                        $timesPerDay &&
                        count($times) !==
                        (int) $timesPerDay
                    ) {
                        $validator->errors()->add(
                            'times',
                            'Jumlah reminder harus sama dengan times_per_day.'
                        );
                    }
                }

                /*
                |--------------------------------------------------------------------------
                | CERTAIN DAYS
                |--------------------------------------------------------------------------
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
                |--------------------------------------------------------------------------
                | INTERVAL WEEKS
                |--------------------------------------------------------------------------
                */

                if ($frequency === 'interval_weeks') {

                    if (empty($this->days)) {
                        $validator->errors()->add(
                            'days',
                            'Minimal pilih satu hari.'
                        );
                    }
                }

                /*
                |--------------------------------------------------------------------------
                | INTERVAL
                |--------------------------------------------------------------------------
                */

                if (
                    in_array(
                        $frequency,
                        [
                            'interval_days',
                            'interval_weeks',
                            'interval_months',
                        ],
                        true
                    )
                ) {
                    if (!$this->interval_value) {
                        $validator->errors()->add(
                            'interval_value',
                            'Interval wajib diisi.'
                        );
                    }
                }

                /*
                |--------------------------------------------------------------------------
                | INTERVAL MONTHS
                |--------------------------------------------------------------------------
                */

                if (
                    $frequency ===
                    'interval_months'
                ) {
                    if (empty($this->dates)) {
                        $validator->errors()->add(
                            'dates',
                            'Minimal pilih satu tanggal.'
                        );
                    }
                }
            }
        );
    }
}
