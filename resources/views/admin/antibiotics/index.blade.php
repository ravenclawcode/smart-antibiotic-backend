@extends('layouts.app')

@section('title','Detail Antibiotik')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-header bg-white d-flex justify-content-between align-items-center">

        <div>

            <h4 class="mb-0 fw-bold">
                Detail Antibiotik
            </h4>

            <small class="text-muted">
                Kelola detail antibiotik yang akan ditampilkan pada aplikasi.
            </small>

        </div>

        <a href="{{ route('admin.antibiotics.create') }}"
            class="btn btn-primary-custom">

            Tambah Detail

        </a>

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

                    <th width="120">Gambar</th>

                    <th>Nama</th>

                    <th>Kategori</th>

                    <th width="150">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($antibiotics as $item)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>

                        @if($item->image)

                        <img src="{{ asset('storage/'.$item->image) }}"
                            width="30"
                            class="rounded">

                        @else

                        -

                        @endif

                    </td>

                    <td>

                        {{ $item->name }}

                    </td>

                    <td>

                        {{ $item->category?->name }}

                    </td>

                    <td>

                        <a href="{{ route('admin.antibiotics.edit',$item) }}"
                            class="btn btn-warning btn-sm">

                            <i class="bi bi-pencil-fill text-white"></i>

                        </a>

                        <form
                            action="{{ route('admin.antibiotics.destroy',$item) }}"
                            method="POST"
                            class="d-inline">

                            @csrf

                            @method('DELETE')

                            <button
                                onclick="return confirm('Hapus detail?')"
                                class="btn btn-danger btn-sm">

                                <i class="bi bi-trash-fill text-white"></i>

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

@endsection