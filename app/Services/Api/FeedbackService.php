<?php

namespace App\Services\Api;

use App\Repositories\Api\FeedbackRepository;

class FeedbackService
{
    public function __construct(
        protected FeedbackRepository $repository
    ) {}

    public function getByUser(
        int $userId
    ) {
        return $this->repository
            ->getByUser($userId)
            ->map(function ($feedback) {

                return [
                    'id' => $feedback->id,
                    'name' => $feedback->user->name,
                    'message' => $feedback->message,
                    'status' => $feedback->status,
                    'admin_reply' => $feedback->admin_reply,
                    'created_at' => optional(
                        $feedback->created_at
                    )->utc()->toIso8601String(),
                ];
            });
    }

    public function create(
        array $data
    ) {
        $data['status'] = 'pending';
        $data['admin_id'] = null;
        $data['admin_reply'] = null;
        $data['replied_at'] = null;
        return $this->repository->create(
            $data
        );
    }

    public function delete(
        int $feedbackId,
        int $userId
    ) {
        return $this->repository->delete(
            $feedbackId,
            $userId
        );
    }
}
