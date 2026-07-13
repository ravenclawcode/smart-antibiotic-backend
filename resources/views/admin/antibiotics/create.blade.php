@extends('layouts.app')

@section('title','Tambah Antibiotik')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-header bg-white">

        <h4 class="mb-0">

            Tambah Detail Antibiotik

        </h4>

    </div>

    <div class="card-body">

        <form
            action="{{ route('admin.antibiotics.store') }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf

            @include('admin.antibiotics.form')

        </form>

    </div>

</div>

@endsection