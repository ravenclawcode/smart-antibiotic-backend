@extends('layouts.app')

@section('title','Katalog Antibiotik')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-header bg-white d-flex justify-content-between align-items-center">

        <div>

            <h4 class="fw-bold mb-0">
                Katalog Antibiotik
            </h4>

            <small class="text-muted">
                Kelola katalog antibiotik yang akan ditampilkan pada aplikasi.
            </small>

        </div>

        <a
            href="{{ route('admin.medicine-catalog.create') }}"
            class="btn btn-primary-custom">

            Tambah Katalog
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

                    <th width="70">

                        No

                    </th>

                    <th width="120">

                        Gambar

                    </th>

                    <th>

                        Nama

                    </th>

                    <th width="150">

                        Aksi

                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($medicines as $medicine)

                <tr>

                    <td>

                        {{ $loop->iteration }}

                    </td>

                    <td>

                        @if($medicine->image)

                        <img
                            src="{{ asset('storage/'.$medicine->image) }}"
                            width="30"
                            class="rounded">

                        @else

                        -

                        @endif

                    </td>

                    <td>

                        {{ $medicine->name }}

                    </td>

                    <td>

                        <a
                            href="{{ route('admin.medicine-catalog.edit',$medicine) }}"
                            class="btn btn-warning btn-sm">

                            <i class="bi bi-pencil-fill text-white"></i>
                        </a>

                        <form
                            action="{{ route('admin.medicine-catalog.destroy',$medicine) }}"
                            method="POST"
                            class="d-inline">

                            @csrf

                            @method('DELETE')

                            <button
                                onclick="return confirm('Hapus Katalog?')"
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