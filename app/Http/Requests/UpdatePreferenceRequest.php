<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePreferenceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'reminder_type' => [
                'required',
                Rule::in([
                    'Ringkas',
                    'Layar Penuh'
                ])
            ],

            'reminder_sound' => [
                'required',
                'string',
                'max:100'
            ],

        ];
    }
}
