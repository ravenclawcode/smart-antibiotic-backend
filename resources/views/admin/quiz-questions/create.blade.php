@extends('layouts.app')

@section('title','Tambah Soal')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-header bg-white">

        <h4 class="mb-0">

            Tambah Soal

        </h4>

    </div>

    <div class="card-body">

        <form
            action="{{ route('admin.quizzes.questions.store',$quiz) }}"
            method="POST">

            @csrf

            <div class="mb-3">

                <label>Pertanyaan</label>

                <textarea
                    name="question"
                    class="form-control"
                    rows="4">{{ old('question') }}</textarea>

            </div>

            <div class="mb-3">

                <label>Pilihan A</label>

                <input
                    name="option_a"
                    class="form-control">

            </div>

            <div class="mb-3">

                <label>Pilihan B</label>

                <input
                    name="option_b"
                    class="form-control">

            </div>

            <div class="mb-3">

                <label>Pilihan C</label>

                <input
                    name="option_c"
                    class="form-control">

            </div>

            <div class="mb-3">

                <label>Pilihan D</label>

                <input
                    name="option_d"
                    class="form-control">

            </div>

            <div class="mb-3">

                <label>Jawaban Benar</label>

                <select
                    name="correct_answer"
                    class="form-select">

                    <option value="A">A</option>

                    <option value="B">B</option>

                    <option value="C">C</option>

                    <option value="D">D</option>

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