<?php

namespace App\Http\Controllers\Admin;

use App\Models\Feedback;
use App\Http\Controllers\Controller;
use App\Services\Feedback\FeedbackService;
use App\Http\Requests\ReplyFeedbackRequest;

class FeedbackController extends Controller
{
    public function __construct(
        protected FeedbackService $service
    ) {}

    public function index()
    {
        $feedbacks = $this->service->getAll();

        return view(
            'admin.feedbacks.index',
            compact('feedbacks')
        );
    }

    public function show(
        Feedback $feedback
    ) {
        $feedback = $this->service->find(
            $feedback
        );

        return view(
            'admin.feedbacks.show',
            compact('feedback')
        );
    }

    public function update(
        ReplyFeedbackRequest $request,
        Feedback $feedback
    ) {
        $this->service->reply(
            $feedback,
            $request->validated()
        );

        return redirect()
            ->route('admin.feedbacks.index')
            ->with(
                'success',
                'Balasan berhasil dikirim.'
            );
    }
}
