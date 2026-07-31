<?php

namespace App\Http\Controllers\Api;

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
        $data = $request->validated();

        $data['user_id'] = $request->user_id;

        $this->service->create($data);

        return response()->json([
            'success' => true,
            'message' => 'Komentar berhasil dikirim.'
        ]);
    }

    public function destroy(
        int $feedback,
        Request $request
    ) {
        $deleted = $this->service->delete(
            $feedback,
            $request->user_id
        );

        if (!$deleted) {
            return response()->json([
                'success' => false,
                'message' => 'Feedback tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Komentar berhasil dihapus.'
        ], 200);
    }
}
