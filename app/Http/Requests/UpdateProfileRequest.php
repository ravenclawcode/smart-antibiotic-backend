<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
                'max:100'
            ],
            'age' => [
                'nullable',
                'integer',
                'min:1',
                'max:120'
            ],
            'gender' => [
                'nullable',
                'in:Laki-laki,Perempuan'
            ],
        ];
    }
}
