@extends('layouts.app')

@section('title','Kategori Antibiotik')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-header bg-white d-flex justify-content-between align-items-center">

        <div>

            <h4 class="fw-bold mb-0">
                Kategori Antibiotik
            </h4>

            <small class="text-muted">
                Kelola kategori antibiotik yang akan ditampilkan pada aplikasi.
            </small>

        </div>

        <a href="{{ route('admin.categories.create') }}"
            class="btn btn-primary-custom">

            Tambah Kategori

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

                    <th>Deskripsi</th>

                    <th width="150">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($categories as $category)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>

                        @if($category->image)

                        <img
                            src="{{ asset('storage/'.$category->image) }}"
                            width="30"
                            class="rounded">

                        @else

                        -

                        @endif

                    </td>

                    <td>

                        {{ $category->name }}

                    </td>

                    <td>

                        {{ Str::limit($category->description,60) }}

                    </td>

                    <td>

                        <a
                            href="{{ route('admin.categories.edit',$category) }}"
                            class="btn btn-warning btn-sm">

                            <i class="bi bi-pencil text-white"></i>

                        </a>

                        <form
                            action="{{ route('admin.categories.destroy',$category) }}"
                            method="POST"
                            class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button
                                onclick="return confirm('Hapus kategori?')"
                                class="btn btn-danger btn-sm">

                                <i class="bi bi-trash text-white"></i>

                            </button>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="6"
                        class="text-center py-4">

                        Belum ada kategori.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection