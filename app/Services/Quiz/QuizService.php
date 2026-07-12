<?php

namespace App\Services\Quiz;

use App\Models\Quiz;
use App\Repositories\Quiz\QuizRepository;

class QuizService
{
    public function __construct(
        protected QuizRepository $repository
    ){}

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update(
        Quiz $quiz,
        array $data
    ){
        return $this->repository->update(
            $quiz,
            $data
        );
    }

    public function delete(
        Quiz $quiz
    ){
        return $this->repository->delete($quiz);
    }
}