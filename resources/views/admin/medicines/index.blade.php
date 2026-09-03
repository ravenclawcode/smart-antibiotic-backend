@extends('layouts.app')

@section('title','Riwayat Obat')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-header bg-white">

        <h4 class="fw-bold mb-0">

            Riwayat Obat

        </h4>

        <small class="text-muted">
            Lihat informasi riwayat obat pengguna pada aplikasi.
        </small>

    </div>

    <div class="card-body">

        <table class="table table-hover align-middle">

            <thead>

                <tr>

                    <th width="70">No</th>

                    <th>Nama</th>

                    <th>Obat</th>

                    <th>Dosis</th>

                    <th>Mulai</th>

                    <th>Selesai</th>

                    <th>Status</th>

                    <th width="150">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($medicines as $medicine)

                <tr>

                    <td>{{ $loop->iteration + ($medicines->currentPage() - 1) * $medicines->perPage() }}</td>

                    <td>{{ $medicine->user->name }}</td>

                    <td>{{ $medicine->name }}</td>

                    <td>{{ $medicine->dosage }}</td>

                    <td>{{ $medicine->start_date?->format('d M Y') ?? '-' }}</td>

                    <td>{{ $medicine->end_date?->format('d M Y') ?? '-' }}</td>

                    <td>

                        @if($medicine->is_active)

                        <span class="badge bg-success">

                            Aktif

                        </span>

                        @else

                        <span class="badge bg-secondary">

                            Selesai

                        </span>

                        @endif

                    </td>

                    <td>

                        <a
                            href="{{ route('admin.medicines.show',$medicine) }}"
                            class="btn btn-sm btn-info">
                            <i class="bi bi-three-dots-vertical text-white"></i>

                        </a>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="8" class="text-center py-4">

                        Belum ada data.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

        <div class="d-flex justify-content-center mt-3">

            {{ $medicines->onEachSide(1)->links('pagination::bootstrap-4') }}

        </div>

    </div>

</div>

@endsection