<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuizSubmitRequest extends FormRequest
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

            'answers' => [
                'required',
                'array',
                'min:1'
            ],

            'answers.*.question_id' => [
                'required',
                'exists:quiz_questions,id'
            ],

            'answers.*.answer' => [
                'required',
                'in:A,B,C,D'
            ]
        ];
    }
}
