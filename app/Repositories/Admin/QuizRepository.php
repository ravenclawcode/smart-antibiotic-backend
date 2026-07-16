<?php

namespace App\Repositories\Admin;

use App\Models\Quiz;

class QuizRepository
{
    public function getAll()
    {
        return Quiz::latest()
            ->paginate(10);
    }

    public function create(array $data)
    {
        return Quiz::create($data);
    }

    public function update(
        Quiz $quiz,
        array $data
    ) {
        $quiz->update($data);

        return $quiz;
    }

    public function delete(Quiz $quiz)
    {
        return $quiz->delete();
    }
}
