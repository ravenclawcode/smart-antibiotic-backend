@extends('layouts.app')

@section('title','Soal Kuis')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-header bg-white d-flex justify-content-between align-items-center">

        <div>

            <h4 class="mb-0">

                Level {{ $quiz->level }}

            </h4>

            <small class="text-muted">

                {{ $quiz->description }}

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

                            {{ $loop->iteration + ($questions->currentPage() - 1) * $questions->perPage() }}

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
                                <i class="bi bi-pencil-fill text-white"></i>

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
                                    <i class="bi bi-trash-fill text-white"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="4" class="text-center py-4">

                            Belum ada soal.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="d-flex justify-content-center mt-3">

            {{ $questions->onEachSide(1)->links('pagination::bootstrap-4') }}

        </div>

    </div>

</div>

@endsection