@extends('layouts.auth')

@section('title', 'Login')

@section('content')

<div class="row justify-content-center align-items-center min-vh-100">

    <div class="col-md-5 col-lg-4">

        <div class="card login-card shadow">

            <div class="card-body p-4">

                <div class="text-center mb-4">

                    <img
                        src="{{ asset('images/logo.png') }}"
                        alt="Logo"
                        width="70"
                        onerror="this.style.display='none'">

                    <h3 class="fw-bold mt-3 text-primary-custom">

                        Smart Antibiotik

                    </h3>

                    <p class="text-muted mb-0">

                        Admin Dashboard

                    </p>

                </div>

                @if ($errors->has('email'))

                <div class="alert alert-danger">

                    {{ $errors->first('email') }}

                </div>

                @endif

                <form method="POST" action="{{ route('login.process') }}">

                    @csrf

                    <div class="mb-3">

                        <label class="form-label">

                            Email

                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email') }}"
                            placeholder="Masukkan email"
                            required
                            autofocus>

                    </div>

                    <div class="mb-4">

                        <label class="form-label">

                            Password

                        </label>

                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            placeholder="Masukkan password"
                            required>

                    </div>

                    <button
                        type="submit"
                        class="btn btn-primary-custom w-100">

                        Login

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection