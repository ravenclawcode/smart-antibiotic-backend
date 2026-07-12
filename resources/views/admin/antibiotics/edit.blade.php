@extends('layouts.app')

@section('title','Edit Antibiotik')

@section('content')

<div class="card shadow-sm border-0 rounded-4">

    <div class="card-header bg-white">

        <h4>

            Edit

        </h4>

    </div>

    <div class="card-body">

        <form
            action="{{ route('admin.antibiotics.update',$antibiotic) }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf

            @method('PUT')

            @include('admin.antibiotics.form')

        </form>

    </div>

</div>

@endsection