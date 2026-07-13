@extends('layouts.app')

@section('title','Dashboard')

@section('content')

<div class="row g-4">

    <div class="col-lg-3 col-md-6">

        <div class="card card-stat shadow-sm">

            <div class="card-body d-flex justify-content-between align-items-center">

                <div>

                    <small class="text-muted">

                        Total User

                    </small>

                    <h2 class="mt-2">

                        {{ $totalUsers }}

                    </h2>

                </div>

                <div class="icon-pill bg-user">

                    <i class="bi bi-people-fill"></i>

                </div>

            </div>

        </div>

    </div>

    {{-- Total Antibiotik --}}
    <div class="col-lg-3 col-md-6">

        <div class="card card-stat shadow-sm">

            <div class="card-body d-flex justify-content-between align-items-center">

                <div>

                    <small class="text-muted">

                        Total Antibiotik

                    </small>

                    <h2 class="mt-2">

                        {{ $totalAntibiotics }}

                    </h2>

                </div>

                <div class="icon-pill bg-antibiotic">

                    <i class="bi bi-capsule-pill"></i>

                </div>

            </div>

        </div>

    </div>

    {{-- Materi Edukasi --}}
    <div class="col-lg-3 col-md-6">

        <div class="card card-stat shadow-sm">

            <div class="card-body d-flex justify-content-between align-items-center">

                <div>

                    <small class="text-muted">

                        Materi Edukasi

                    </small>

                    <h2 class="mt-2">

                        {{ $totalCategories }}

                    </h2>

                </div>

                <div class="icon-pill bg-category">

                    <i class="bi bi-book-half"></i>

                </div>

            </div>

        </div>

    </div>

    {{-- Feedback --}}
    <div class="col-lg-3 col-md-6">

        <div class="card card-stat shadow-sm">

            <div class="card-body d-flex justify-content-between align-items-center">

                <div>

                    <small class="text-muted">

                        Komentar Baru

                    </small>

                    <h2 class="mt-2">

                        {{ $newFeedbacks }}

                    </h2>

                </div>

                <div class="icon-pill bg-feedback">

                    <i class="bi bi-chat-left-dots-fill"></i>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection