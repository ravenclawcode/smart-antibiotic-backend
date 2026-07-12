@extends('layouts.app')

@section('title','Soal Kuis')

@section('content')

<div class="card shadow-sm border-0 rounded-4">

    <div class="card-header bg-white d-flex justify-content-between align-items-center">

        <div>

            <h4 class="mb-1">

                {{ $quiz->title }}

            </h4>

            <small class="text-muted">

                Level {{ $quiz->level }}

            </small>

        </div>

        <div>

            <a
                href="{{ route('admin.quizzes.index') }}"
                class="btn btn-secondary me-1">

                Kembali

            </a>

            <a
                href="{{ route('admin.quizzes.questions.create',$quiz) }}"
                class="btn btn-primary-custom">

                Tambah Soal

            </a>

        </div>

    </div>

    <div class="card-body">

        @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

        @endif

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead>

                    <tr>

                        <th width="70">No</th>

                        <th>Pertanyaan</th>

                        <th>Jawaban</th>

                        <th width="150">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($questions as $question)

                    <tr>

                        <td>

                            {{ $loop->iteration }}

                        </td>

                        <td>

                            {{ $question->question }}

                        </td>

                        <td>

                            <span class="badge bg-success">

                                {{ $question->correct_answer }}

                            </span>

                        </td>

                        <td>

                            <a
                                href="{{ route('admin.quizzes.questions.edit',[$quiz,$question]) }}"
                                class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i>

                            </a>

                            <form
                                action="{{ route('admin.quizzes.questions.destroy',[$quiz,$question]) }}"
                                method="POST"
                                class="d-inline">

                                @csrf

                                @method('DELETE')

                                <button
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus soal?')">
                                    <i class="bi bi-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6" class="text-center py-4">

                            Belum ada soal.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection