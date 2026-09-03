@extends('layouts.app')

@section('title','Komentar & Masukan')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-header bg-white">

        <h4 class="fw-bold mb-0">

            Komentar & Masukan

        </h4>

        <small class="text-muted">
            Lihat atau kelola semua komentar dan masukan yang dikirimkan oleh pengguna.
        </small>

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

                        <th>Nama</th>

                        <th>Pertanyaan</th>

                        <th>Status</th>

                        <th>Tanggal</th>

                        <th width="100">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($feedbacks as $feedback)

                    <tr>

                        <td>

                            {{ $loop->iteration + ($feedbacks->currentPage() - 1) * $feedbacks->perPage() }}

                        </td>

                        <td>

                            {{ $feedback->user->name }}

                        </td>

                        <td>

                            {{ \Illuminate\Support\Str::limit($feedback->message,70) }}

                        </td>

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

                        <td>

                            {{ $feedback->created_at?->format('d M Y') ?? '-' }}

                        </td>

                        <td>

                            <a
                                href="{{ route('admin.feedbacks.show',$feedback) }}"
                                class="btn btn-info btn-sm">
                                <i class="bi bi-three-dots-vertical text-white"></i>

                            </a>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6" class="text-center py-3">

                            Belum ada komentar.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="d-flex justify-content-center mt-3">

            {{ $feedbacks->onEachSide(1)->links('pagination::bootstrap-4') }}

        </div>

    </div>

</div>

@endsection