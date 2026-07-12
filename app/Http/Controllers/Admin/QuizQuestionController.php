<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuizQuestionRequest;
use App\Http\Requests\UpdateQuizQuestionRequest;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Services\Quiz\QuizQuestionService;

class QuizQuestionController extends Controller
{
    public function __construct(
        protected QuizQuestionService $service
    ) {}

    public function index(Quiz $quiz)
    {
        $questions = $this->service->getByQuiz($quiz);

        return view(
            'admin.quiz-questions.index',
            compact(
                'quiz',
                'questions'
            )
        );
    }

    public function create(
        Quiz $quiz
    ) {
        return view(
            'admin.quiz-questions.create',
            compact('quiz')
        );
    }

    public function store(
        StoreQuizQuestionRequest $request,
        Quiz $quiz
    ) {
        $data = $request->validated();

        $data['quiz_id'] = $quiz->id;

        $this->service->create($data);

        return redirect()
            ->route(
                'admin.quizzes.questions.index',
                $quiz
            )
            ->with(
                'success',
                'Soal berhasil ditambahkan.'
            );
    }

    public function edit(
        Quiz $quiz,
        QuizQuestion $question
    ) {
        return view(
            'admin.quiz-questions.edit',
            compact(
                'quiz',
                'question'
            )
        );
    }

    public function update(
        UpdateQuizQuestionRequest $request,
        Quiz $quiz,
        QuizQuestion $question
    ) {
        $this->service->update(
            $question,
            $request->validated()
        );

        return redirect()
            ->route(
                'admin.quizzes.questions.index',
                $quiz
            )
            ->with(
                'success',
                'Soal berhasil diubah.'
            );
    }

    public function destroy(
        Quiz $quiz,
        QuizQuestion $question
    ) {
        $this->service->delete($question);

        return redirect()
            ->route(
                'admin.quizzes.questions.index',
                $quiz
            )
            ->with(
                'success',
                'Soal berhasil dihapus.'
            );
    }
}
