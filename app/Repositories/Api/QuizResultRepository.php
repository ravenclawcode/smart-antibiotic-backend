<?php

namespace App\Repositories\Api;

use App\Models\QuizResult;

class QuizResultRepository
{
    public function create(array $data)
    {
        return QuizResult::create($data);
    }
}