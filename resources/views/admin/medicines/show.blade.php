@extends('layouts.app')

@section('title','Detail Riwayat Obat')

@section('content')

<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white">
        <h4 class="mb-0">
            Informasi Obat
        </h4>
    </div>
    <div class="card-body">
        <table class="table">
            <tr>
                <th width="180">Nama</th>
                <td>{{ $medicine->name ?? '-' }}</td>
            </tr>
            <tr>
                <th>Dosis</th>
                <td>{{ $medicine->dosage ?? '-' }}</td>
            </tr>
            <tr>
                <th>Format</th>
                <td>{{ ($medicine->dosage_unit) ?? '-' }}</td>
            </tr>
            <tr>
                <th>Instruksi</th>
                <td>{{ $medicine->instruction ?? '-' }}</td>
            </tr>
            <tr>
                <th>Periode</th>
                <td>
                    {{ $medicine->start_date?->format('d M Y') ?? '' }}
                    -
                    {{ $medicine->end_date?->format('d M Y') ?? '' }}
                </td>
            </tr>
        </table>
    </div>
</div>

<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white">
        <h4 class="mb-0">
            Jadwal Minum Obat
        </h4>
    </div>
    <div class="card-body">
        <table class="table">
            <tr>
                <th width="180">Frekuensi</th>
                <td>
                    @php
                    $frequency = [
                    'daily' => 'Harian',
                    'certain_days' => 'Hari-hari Tertentu',
                    'interval_days' => 'Interval Harian',
                    'interval_weeks' => 'Interval Mingguan',
                    'interval_months' => 'Interval Bulanan',
                    ];
                    @endphp

                    {{ $frequency[$medicine->schedule?->frequency_type] ?? '-' }}
                </td>
            </tr>
            <tr>
                <th>Kali Sehari</th>
                <td>{{ $medicine->schedule?->times_per_day ?? '-' }}</td>
            </tr>
            <tr>
                <th>Interval</th>
                <td>{{ $medicine->schedule?->interval_value ?? '-' }}</td>
            </tr>
            <tr>
                <th>Hari</th>
                <td>
                    @forelse($medicine->schedule?->days ?? [] as $day)
                    <span class="badge bg-primary">
                        {{ ucfirst($day->value) }}
                    </span>
                    @empty
                    -
                    @endforelse
                </td>
            </tr>
            <tr>
                <th>Jam Reminder</th>
                <td>
                    @forelse($medicine->schedule?->times ?? [] as $time)
                    <span class="badge bg-success">
                        {{ substr($time->reminder_time,0,5) }}
                    </span>
                    @empty
                    -
                    @endforelse
                </td>
            </tr>
        </table>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h4 class="mb-0">
            Riwayat Konsumsi
        </h4>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Status</th>
                    <th>Waktu Diminum</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                @php
                $hasHistory = false;
                @endphp

                @foreach($medicine->schedule?->times ?? [] as $time)
                @foreach($time->histories ?? [] as $history)
                @php
                $hasHistory = true;
                @endphp
                <tr>
                    <td>
                        {{ \Carbon\Carbon::parse($history->scheduled_date)->format('d M Y') }}
                    </td>
                    <td>
                        {{ substr($time->reminder_time,0,5) }}
                    </td>
                    <td>
                        @if($history->status == 'taken')
                        <span class="badge bg-success">Diminum</span>
                        @elseif($history->status == 'missed')
                        <span class="badge bg-danger">Terlewat</span>
                        @elseif($history->status == 'skipped')
                        <span class="badge bg-warning">Dilewati</span>
                        @elseif($history->status == 'rescheduled')
                        <span class="badge bg-info">Dijadwalkan Ulang</span>
                        @else
                        <span class="badge bg-secondary">Pending</span>
                        @endif
                    </td>
                    <td>
                        {{ optional($history->taken_at)->format('d M Y H:i') ?? '-' }}
                    </td>
                    <td>
                        {{ $history->notes ?? '-' }}
                    </td>
                </tr>
                @endforeach
                @endforeach

                @unless($hasHistory)
                <tr>
                    <td colspan="5" class="text-center">
                        Belum ada riwayat konsumsi obat.
                    </td>
                </tr>
                @endunless
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3 text-end">
    <a href="{{ route('admin.medicines.index') }}" class="btn btn-secondary">
        Kembali
    </a>
</div>

@endsection