<?php

namespace App\Services\Feedback;

use App\Models\Feedback;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Feedback\FeedbackRepository;

class FeedbackService
{
    public function __construct(
        protected FeedbackRepository $repository
    ) {}

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function find(
        Feedback $feedback
    ) {
        return $this->repository->find(
            $feedback
        );
    }

    public function reply(
        Feedback $feedback,
        array $data
    ) {
        $data['admin_id'] = Auth::id();

        $data['status'] = 'replied';

        $data['replied_at'] = Carbon::now();

        return $this->repository->update(
            $feedback,
            $data
        );
    }
}
