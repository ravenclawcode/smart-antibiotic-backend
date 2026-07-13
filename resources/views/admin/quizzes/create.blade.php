@extends('layouts.app')

@section('title','Tambah Kuis')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-header bg-white">

        <h4 class="mb-0">

            Tambah Kuis

        </h4>

    </div>

    <div class="card-body">

        <form
            action="{{ route('admin.quizzes.store') }}"
            method="POST">

            @csrf

            <div class="mb-3">

                <label>

                    Level

                </label>

                <input
                    type="number"
                    name="level"
                    class="form-control"
                    value="{{ old('level') }}">

            </div>

            <div class="mb-3">

                <label>

                    Judul

                </label>

                <input
                    type="text"
                    name="title"
                    class="form-control"
                    value="{{ old('title') }}">

            </div>

            <div class="mb-3">

                <label>

                    Deskripsi

                </label>

                <textarea
                    name="description"
                    rows="5"
                    class="form-control">{{ old('description') }}</textarea>

            </div>

            <div class="d-flex justify-content-end">

                <a
                    href="{{ route('admin.quizzes.index') }}"
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