<?php

namespace App\Repositories\Api;

use App\Models\Feedback;

class FeedbackRepository
{
    public function getByUser(
        int $userId
    ) {
        return Feedback::where(
            'user_id',
            $userId
        )
            ->latest()
            ->get();
    }

    public function create(
        array $data
    ) {
        return Feedback::create($data);
    }

    public function delete(
        Feedback $feedback,
        int $userId
    ) {
        return Feedback::where(
            'id',
            $feedback->id
        )
            ->where(
                'user_id',
                $userId
            )
            ->firstOrFail()
            ->delete();
    }
}
