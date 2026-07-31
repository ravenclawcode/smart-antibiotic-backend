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
        int $feedbackId,
        int $userId
    ) {
        $feedback = Feedback::where(
            'id',
            $feedbackId
        )
            ->where(
                'user_id',
                $userId
            )
            ->first();

        if (!$feedback) {
            return false;
        }

        return $feedback->delete();
    }
}
