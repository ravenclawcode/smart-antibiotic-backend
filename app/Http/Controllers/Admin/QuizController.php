<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuizRequest;
use App\Http\Requests\UpdateQuizRequest;
use App\Models\Quiz;
use App\Services\Quiz\QuizService;

class QuizController extends Controller
{
    public function __construct(
        protected QuizService $service
    ) {}

    public function index()
    {
        $quizzes = $this->service->getAll();

        return view(
            'admin.quizzes.index',
            compact('quizzes')
        );
    }

    public function create()
    {
        return view(
            'admin.quizzes.create'
        );
    }

    public function store(
        StoreQuizRequest $request
    ) {
        $this->service->create(
            $request->validated()
        );

        return redirect()
            ->route('admin.quizzes.index')
            ->with(
                'success',
                'Kuis berhasil ditambahkan.'
            );
    }

    public function edit(
        Quiz $quiz
    ) {
        return view(
            'admin.quizzes.edit',
            compact('quiz')
        );
    }

    public function update(
        UpdateQuizRequest $request,
        Quiz $quiz
    ) {
        $this->service->update(
            $quiz,
            $request->validated()
        );

        return redirect()
            ->route('admin.quizzes.index')
            ->with(
                'success',
                'Kuis berhasil diubah.'
            );
    }

    public function destroy(
        Quiz $quiz
    ) {
        $this->service->delete(
            $quiz
        );

        return redirect()
            ->route('admin.quizzes.index')
            ->with(
                'success',
                'Kuis berhasil dihapus.'
            );
    }
}
