<?php

namespace App\Http\Controllers\Api;

use App\Models\Feedback;
use App\Http\Controllers\Controller;
use App\Http\Requests\FeedbackRequest;
use App\Services\Api\FeedbackService;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function __construct(
        protected FeedbackService $service
    ) {}

    public function index(
        Request $request
    ) {
        return response()->json([
            'success' => true,
            'data' => $this->service->getByUser(
                $request->user_id
            )
        ]);
    }

    public function store(
        FeedbackRequest $request
    ) {
        $this->service->create(
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Komentar berhasil dikirim.'
        ]);
    }

    public function destroy(
        Feedback $feedback,
        Request $request
    ) {
        $this->service->delete(
            $feedback,
            $request->user_id
        );

        return response()->json([
            'success' => true,
            'message' => 'Komentar berhasil dihapus.'
        ]);
    }
}
