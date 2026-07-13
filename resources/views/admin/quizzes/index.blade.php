@extends('layouts.app')

@section('title','Kuis')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-header bg-white d-flex justify-content-between align-items-center">

        <div>

            <h4 class="mb-0 fw-bold">
                Kuis
            </h4>

            <small class="text-muted">
                Kelola kuis yang akan ditampilkan pada aplikasi.
            </small>

        </div>

        <a href="{{ route('admin.quizzes.create') }}"
            class="btn btn-primary-custom">

            Tambah Kuis

        </a>

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

                        <th>Level</th>

                        <th>Judul</th>

                        <th>Deskripsi</th>

                        <th width="150">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($quizzes as $quiz)

                    <tr>

                        <td>

                            {{ $loop->iteration }}

                        </td>

                        <td>

                            Level {{ $quiz->level }}

                        </td>

                        <td>

                            {{ $quiz->title }}

                        </td>

                        <td>

                            {{ Str::limit($quiz->description,60) }}

                        </td>

                        <td>

                            <a
                                href="{{ route('admin.quizzes.questions.index',$quiz) }}"
                                class="btn btn-success btn-sm">

                                <i class="bi bi-list-check text-white"></i>

                            </a>

                            <a
                                href="{{ route('admin.quizzes.edit',$quiz) }}"
                                class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil text-white"></i>

                            </a>

                            <form
                                action="{{ route('admin.quizzes.destroy',$quiz) }}"
                                method="POST"
                                class="d-inline">

                                @csrf

                                @method('DELETE')

                                <button
                                    onclick="return confirm('Hapus kuis?')"
                                    class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash text-white"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6" class="text-center py-4">

                            Belum ada data.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection