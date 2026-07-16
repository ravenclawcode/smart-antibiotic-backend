<?php

namespace App\Repositories\Admin;

use App\Models\Quiz;
use App\Models\QuizQuestion;

class QuizQuestionRepository
{
    public function getByQuiz(
        Quiz $quiz
    ) {
        return $quiz
            ->questions()
            ->latest()
            ->get();
    }

    public function create(array $data)
    {
        return QuizQuestion::create($data);
    }

    public function update(
        QuizQuestion $question,
        array $data
    ) {
        $question->update($data);

        return $question;
    }

    public function delete(
        QuizQuestion $question
    ) {
        return $question->delete();
    }
}
