@extends('layouts.app')

@section('title','Edit Soal')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-header bg-white">

        <h5>

            Edit Soal

        </h5>

    </div>

    <div class="card-body">

        <form
            action="{{ route('admin.quizzes.questions.update',[$quiz,$question]) }}"
            method="POST">

            @csrf

            @method('PUT')

            <div class="mb-3">

                <label>Pertanyaan</label>

                <textarea
                    name="question"
                    rows="4"
                    class="form-control">{{ old('question',$question->question) }}</textarea>

            </div>

            <div class="mb-3">

                <label>Pilihan A</label>

                <input
                    name="option_a"
                    value="{{ old('option_a',$question->option_a) }}"
                    class="form-control">

            </div>

            <div class="mb-3">

                <label>Pilihan B</label>

                <input
                    name="option_b"
                    value="{{ old('option_b',$question->option_b) }}"
                    class="form-control">

            </div>

            <div class="mb-3">

                <label>Pilihan C</label>

                <input
                    name="option_c"
                    value="{{ old('option_c',$question->option_c) }}"
                    class="form-control">

            </div>

            <div class="mb-3">

                <label>Pilihan D</label>

                <input
                    name="option_d"
                    value="{{ old('option_d',$question->option_d) }}"
                    class="form-control">

            </div>

            <div class="mb-3">

                <label>Jawaban Benar</label>

                <select
                    name="correct_answer"
                    class="form-select">

                    @foreach(['A','B','C','D'] as $answer)

                    <option
                        value="{{ $answer }}"
                        @selected($question->correct_answer==$answer)>

                        {{ $answer }}

                    </option>

                    @endforeach

                </select>

            </div>

            <div class="d-flex justify-content-end">

                <a
                    href="{{ route('admin.quizzes.questions.index',$quiz) }}"
                    class="btn btn-secondary me-2">

                    Kembali

                </a>

                <button class="btn btn-primary-custom">

                    Simpan

                </button>

            </div>

        </form>

    </div>

</div>

@endsection