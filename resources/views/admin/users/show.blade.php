@extends('layouts.app')

@section('title','Detail User')

@section('content')

<div class="row">

    <div class="col-md-6">

        <div class="card shadow-sm border-0">

            <div class="card-header bg-white">

                <h4 class="mb-0">

                    Informasi Pengguna

                </h4>

            </div>

            <div class="card-body">

                <table class="table">

                    <tr>

                        <th>

                            Nama

                        </th>

                        <td>

                            {{ $user->name }}

                        </td>

                    </tr>

                    <tr>

                        <th>

                            Umur

                        </th>

                        <td>

                            {{ $user->age ?? '-' }}

                        </td>

                    </tr>

                    <tr>

                        <th>

                            Jenis Kelamin

                        </th>

                        <td>

                            {{ $user->gender ?? '-' }}

                        </td>

                    </tr>

                    <tr>

                        <th>

                            Bergabung

                        </th>

                        <td>

                            {{ $user->created_at->format('d F Y') }}

                        </td>

                    </tr>

                </table>

            </div>

        </div>

    </div>

    <div class="col-md-6">

        <div class="card shadow-sm border-0">

            <div class="card-header bg-white">

                <h4 class="mb-0">

                    Preferensi Pengguna

                </h4>

            </div>

            <div class="card-body">

                @if($user->preference)

                <table class="table">

                    <tr>

                        <th width="180">

                            Jenis Reminder

                        </th>

                        <td>

                            {{ $user->preference->reminder_type }}

                        </td>

                    </tr>

                    <tr>

                        <th>

                            Suara Reminder

                        </th>

                        <td>

                            {{ $user->preference->reminder_sound }}

                        </td>

                    </tr>

                </table>

                @else

                <div class="alert alert-warning mb-0">

                    Pengguna belum memiliki preferensi.

                </div>

                @endif

            </div>

        </div>

        <div class="mt-3 text-end">

            <a
                href="{{ route('admin.users.index') }}"
                class="btn btn-secondary">

                Kembali

            </a>

        </div>

    </div>

</div>

@endsection