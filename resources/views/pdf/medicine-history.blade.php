<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <style>
        body {

            font-family: DejaVu Sans;
            font-size: 11px;

        }

        .header {

            width: 100%;
            margin-bottom: 20px;

        }

        .logo {

            float: right;

            width: 70px;

        }

        .title {

            text-align: center;

        }

        .info {

            margin-top: 15px;

            margin-bottom: 20px;

        }

        table {

            width: 100%;
            border-collapse: collapse;

        }

        table th,
        table td {

            border: 1px solid #444;
            padding: 6px;

        }

        th {

            background: #E0EFF7;

        }

        .footer {

            margin-top: 20px;
            text-align: right;

        }
    </style>

</head>

<body>

    <div class="header">

        <img
            src="{{ public_path('images/logo.png') }}"
            class="logo">

        <div class="title">

            <h2>SMART ANTIBIOTIK</h2>

            <h3>Laporan Riwayat Minum Obat</h3>

        </div>

    </div>

    <table class="info">

        <tr>

            <td width="25%"><b>Nama</b></td>

            <td>{{ $user->name }}</td>

            <td><b>Periode</b></td>

            <td>

                {{ $history['period']['start_date'] }}

                -

                {{ $history['period']['end_date'] }}

            </td>

        </tr>

        <tr>

            <td><b>Usia</b></td>

            <td>{{ $user->age ?? '-' }}</td>

            <td><b>Jenis Kelamin</b></td>

            <td>{{ $user->gender ?? '-' }}</td>

        </tr>

    </table>

    <br>

    <table>

        <tr>

            <th>Total Jadwal</th>

            <th>Diminum</th>

            <th>Dilewati</th>

            <th>Terlewat</th>

            <th>Kepatuhan</th>

        </tr>

        <tr>

            <td align="center">{{ $summary->total }}</td>

            <td align="center">{{ $summary->taken }}</td>

            <td align="center">{{ $summary->skipped }}</td>

            <td align="center">{{ $summary->missed }}</td>

            <td align="center">{{ $adherence }} %</td>

        </tr>

    </table>

    <br>

    <table>

        <thead>

            <tr>

                <th width="5%">No</th>

                <th width="12%">Tanggal</th>

                <th width="10%">Jam</th>

                <th width="20%">Nama Obat</th>

                <th width="15%">Dosis</th>

                <th width="10%">Status</th>

                <th width="13%">Waktu Minum</th>

                <th>Catatan</th>

            </tr>

        </thead>

        <tbody>

            @php($no = 1)

            @foreach($history['data'] as $day)

            @foreach($day['items'] as $item)

            <tr>

                <td align="center">

                    {{ $no++ }}

                </td>

                <td>

                    {{ $day['date'] }}

                </td>

                <td>

                    {{ $item['time'] }}

                </td>

                <td>

                    {{ $item['name'] }}

                </td>

                <td>

                    {{ $item['dosage'] }}

                </td>

                <td>

                    @switch($item['status'])

                    @case('taken')

                    Diminum

                    @break

                    @case('missed')

                    Terlewat

                    @break

                    @case('skipped')

                    Dilewati

                    @break

                    @default

                    {{ $item['status'] }}

                    @endswitch

                </td>

                <td>

                    {{ $item['taken_at'] ?? '-' }}

                </td>

                <td>

                    {{ $item['notes'] ?? '-' }}

                </td>

            </tr>

            @endforeach

            @endforeach

        </tbody>

    </table>

    <div class="footer">

        Dicetak pada

        {{ now()->format('d M Y H:i') }}

    </div>

</body>

</html>