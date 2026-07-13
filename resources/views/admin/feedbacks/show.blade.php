@extends('layouts.app')

@section('title','Detail Komentar')

@section('content')

<div class="row">

    <div class="col-lg-4">

        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-white">

                <h4 class="mb-0">

                    Informasi User

                </h4>

            </div>

            <div class="card-body">

                <table class="table">

                    <tr>

                        <th width="120">

                            Nama

                        </th>

                        <td>

                            {{ $feedback->user->name }}

                        </td>

                    </tr>

                    <tr>

                        <th>

                            Umur

                        </th>

                        <td>

                            {{ $feedback->user->age ?? '-' }}

                        </td>

                    </tr>

                    <tr>

                        <th>

                            Gender

                        </th>

                        <td>

                            {{ ucfirst($feedback->user->gender ?? '-') }}

                        </td>

                    </tr>

                    <tr>

                        <th>

                            Status

                        </th>

                        <td>

                            @if($feedback->status=='pending')

                            <span class="badge bg-warning">

                                Menunggu

                            </span>

                            @else

                            <span class="badge bg-success">

                                Sudah Dibalas

                            </span>

                            @endif

                        </td>

                    </tr>

                </table>

            </div>

        </div>

    </div>

    <div class="col-lg-8">

        <div class="card shadow-sm border-0">

            <div class="card-header bg-white">

                <h4 class="mb-0">

                    Balas Komentar

                </h4>

            </div>

            <div class="card-body">

                <div class="mb-4">

                    <label class="fw-bold">

                        Pertanyaan Pengguna

                    </label>

                    <div class="border rounded p-3 bg-light">

                        {{ $feedback->message }}

                    </div>

                </div>

                <form
                    action="{{ route('admin.feedbacks.update',$feedback) }}"
                    method="POST">

                    @csrf

                    @method('PUT')

                    <div class="mb-3">

                        <label>

                            Balasan Admin

                        </label>

                        <textarea
                            name="admin_reply"
                            rows="6"
                            class="form-control">{{ old('admin_reply',$feedback->admin_reply) }}</textarea>

                        @error('admin_reply')

                        <small class="text-danger">

                            {{ $message }}

                        </small>

                        @enderror

                    </div>

                    @if($feedback->replied_at)

                    <div class="alert alert-success">

                        Dibalas pada

                        <strong>

                            {{ $feedback->replied_at->format('d M Y H:i') }}

                        </strong>

                    </div>

                    @endif

                    <div class="d-flex justify-content-end">

                        <a
                            href="{{ route('admin.feedbacks.index') }}"
                            class="btn btn-secondary me-2">

                            Kembali

                        </a>

                        <button
                            class="btn btn-primary-custom">

                            {{ $feedback->status=='pending' ? 'Kirim Balasan' : 'Update Balasan' }}

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection