<?php

namespace App\Services\Api;

use App\Models\Quiz;
use App\Repositories\Api\QuizRepository;
use App\Repositories\Api\QuizResultRepository;

class QuizService
{
    public function __construct(
        protected QuizRepository $repository,
        protected QuizResultRepository $resultRepository
    ) {}

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function getDetail(
        Quiz $quiz
    ) {
        return $this->repository->getDetail($quiz);
    }



    public function submit(
        Quiz $quiz,
        array $data
    ) {
        $questions = $quiz->questions;

        $correct = 0;

        foreach ($questions as $question) {

            $answer = collect(
                $data['answers']
            )->firstWhere(
                'question_id',
                $question->id
            );

            if (!$answer) {
                continue;
            }

            if (
                strtoupper($answer['answer'])
                ===
                strtoupper($question->correct_answer)
            ) {
                $correct++;
            }
        }

        $total = $questions->count();

        $score = $total > 0
            ? round(($correct / $total) * 100)
            : 0;

        $this->resultRepository->create([
            'user_id' => $data['user_id'],
            'quiz_id' => $quiz->id,
            'score' => $score,
            'correct_answers' => $correct,
            'wrong_answers' => $total - $correct,
        ]);

        return [
            'score' => $score,
            'correct_answers' => $correct,
            'wrong_answers' => $total - $correct
        ];
    }
}
