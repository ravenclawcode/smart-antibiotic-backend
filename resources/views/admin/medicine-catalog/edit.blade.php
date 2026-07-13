@extends('layouts.app')

@section('title','Edit Obat')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-header bg-white">

        <h4 class="mb-0">

            Edit Katalog Antibiotik

        </h4>

    </div>

    <div class="card-body">

        <form
            action="{{ route('admin.medicine-catalog.update',$medicine_catalog) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf

            @method('PUT')

            @include('admin.medicine-catalog.form')

        </form>

    </div>

</div>

@endsection