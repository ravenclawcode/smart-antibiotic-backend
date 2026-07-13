@extends('layouts.app')

@section('title','Tambah Kategori Antibiotik')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-header bg-white">

        <h4 class="mb-0">
            Tambah Kategori Antibiotik
        </h4>

    </div>

    <div class="card-body">

        <form
            action="{{ route('admin.categories.store') }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf

            @include('admin.categories.form')

        </form>

    </div>

</div>

@endsection