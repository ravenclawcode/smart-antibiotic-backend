@extends('layouts.app')

@section('title','Edit Kategori Antibiotik')

@section('content')

<div class="card shadow-sm border-0 rounded-4">

    <div class="card-header bg-white">

        <h4 class="mb-0">

            Edit Kategori Antibiotik
            
        </h4>

    </div>

    <div class="card-body">

        <form
            action="{{ route('admin.categories.update',$category) }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf
            @method('PUT')

            @include('admin.categories.form')

        </form>

    </div>

</div>

@endsection