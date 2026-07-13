@extends('layouts.app')

@section('title','Pengguna')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-header bg-white">

        <h4 class="fw-bold mb-0">
            Pengguna
        </h4>

        <small class="text-muted">
            Lihat informasi pengguna yang terdaftar pada aplikasi.
        </small>

    </div>

    <div class="card-body">

        @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

        @endif

        <table class="table table-hover align-middle">

            <thead>

                <tr>

                    <th width="70">No</th>

                    <th>Nama</th>

                    <th>Umur</th>

                    <th>Jenis Kelamin</th>

                    <th>Dibuat</th>

                    <th width="150">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($users as $user)

                <tr>

                    <td>

                        {{ $users->firstItem() + $loop->index }}

                    </td>

                    <td>

                        {{ $user->name }}

                    </td>

                    <td>

                        {{ $user->age ?? '-' }}

                    </td>

                    <td>

                        {{ $user->gender ?? '-' }}

                    </td>

                    <td>

                        {{ $user->created_at->format('d M Y') }}

                    </td>

                    <td>

                        <a
                            href="{{ route('admin.users.show',$user) }}"
                            class="btn btn-info btn-sm">
                            <i class="bi bi-three-dots text-white"></i>

                        </a>

                    </td>

                </tr>

                @empty

                <tr>

                    <td
                        colspan="6"
                        class="text-center py-4">

                        Belum ada user.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

        <div class="mt-3">

            {{ $users->links() }}

        </div>

    </div>

</div>

@endsection