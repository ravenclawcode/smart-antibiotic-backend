<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MedicineHistoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $status = $this->route()->getActionMethod();

        $rules = [
            'schedule_time_id' => [
                'required',
                'exists:schedule_times,id'
            ],

            'scheduled_date' => [
                'required',
                'date'
            ],
        ];

        if ($status === 'skipped') {

            $rules['notes'] = [
                'required',
                'string',
                'max:255'
            ];
        }

        if ($status === 'reschedule') {

            $rules['rescheduled_time'] = [
                'required',
                'date'
            ];
        }

        return $rules;
    }
}