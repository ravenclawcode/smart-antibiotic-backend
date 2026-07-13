@extends('layouts.app')

@section('title','Tambah Obat')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-header bg-white">

        <h4 class="mb-0">

            Tambah Katalog Antibiotik

        </h4>

    </div>

    <div class="card-body">

        <form
            action="{{ route('admin.medicine-catalog.store') }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf

            @include('admin.medicine-catalog.form')

        </form>

    </div>

</div>

@endsection