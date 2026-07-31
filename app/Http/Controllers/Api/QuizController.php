<?php

namespace App\Http\Controllers\Api;

use App\Models\Quiz;
use App\Http\Controllers\Controller;
use App\Http\Requests\QuizSubmitRequest;
use App\Services\Api\QuizService;

class QuizController extends Controller
{
    public function __construct(
        protected QuizService $service
    ) {}

    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => $this->service->getAll()
        ]);
    }

    public function show(
        int $quiz
    ) {
        $quizData = Quiz::find($quiz);

        if (!$quizData) {
            return response()->json([
                'success' => false,
                'message' => 'Quiz tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $this->service->getDetail($quizData)
        ]);
    }

    public function submit(
        QuizSubmitRequest $request,
        Quiz $quiz
    ) {
        return response()->json([
            'success' => true,
            'message' => 'Kuis berhasil diselesaikan.',
            'data' => $this->service->submit(
                $quiz,
                $request->validated()
            )
        ]);
    }
}
