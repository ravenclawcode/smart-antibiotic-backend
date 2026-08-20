<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
                'exists:schedule_times,id',
            ],

            'scheduled_date' => [
                'required',
                'date',
            ],
        ];

        if (in_array($status, ['taken', 'skipped'], true)) {
            $rules['action_time'] = [
                'required',
                'in:now,scheduled',
            ];
        }

        if ($status === 'skipped') {
            $rules['notes'] = [
                'required',
                'string',
                'max:255',
            ];
        }

        if ($status === 'reschedule') {
            $rules['rescheduled_time'] = [
                'required',
                'date',
            ];
        }

        return $rules;
    }
}
