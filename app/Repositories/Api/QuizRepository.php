<?php

namespace App\Repositories\Api;

use App\Models\Quiz;

class QuizRepository
{
    public function getAll()
    {
        return Quiz::orderBy('level')
            ->get()
            ->map(function ($quiz) {
                return [
                    'id' => $quiz->id,
                    'level' => $quiz->level,
                    'description' => $quiz->description,
                ];
            });
    }

    public function getDetail(
        Quiz $quiz
    ) {
        $quiz->load('questions');

        return [
            'id' => $quiz->id,
            'level' => $quiz->level,
            'description' => $quiz->description,

            'questions' => $quiz->questions->map(function ($question) {
                return [
                    'id' => $question->id,
                    'question' => $question->question,
                    'option_a' => $question->option_a,
                    'option_b' => $question->option_b,
                    'option_c' => $question->option_c,
                    'option_d' => $question->option_d,
                ];
            })->values(),
        ];
    }
}
