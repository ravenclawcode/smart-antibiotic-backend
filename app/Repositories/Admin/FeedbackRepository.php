<?php

namespace App\Repositories\Admin;

use App\Models\Feedback;

class FeedbackRepository
{
    public function getAll()
    {
        return Feedback::with('user')
            ->latest()
            ->paginate(10);
    }

    public function find(Feedback $feedback)
    {
        return $feedback->load([
            'user',
            'admin'
        ]);
    }

    public function update(
        Feedback $feedback,
        array $data
    ) {
        $feedback->update($data);

        return $feedback;
    }
}
