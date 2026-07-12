<?php

namespace App\Services\Quiz;

use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Repositories\Quiz\QuizQuestionRepository;

class QuizQuestionService
{
    public function __construct(
        protected QuizQuestionRepository $repository
    ){}

    public function getByQuiz(
        Quiz $quiz
    ){
        return $this->repository->getByQuiz($quiz);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update(
        QuizQuestion $question,
        array $data
    ){
        return $this->repository->update(
            $question,
            $data
        );
    }

    public function delete(
        QuizQuestion $question
    ){
        return $this->repository->delete(
            $question
        );
    }
}