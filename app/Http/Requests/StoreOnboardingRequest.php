<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOnboardingRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:100'
            ],
            'reminder_type' => [
                'required',
                'in:Ringkas,Layar Penuh'
            ],
            'reminder_sound' => [
                'required',
                'string'
            ],
        ];
    }
}
