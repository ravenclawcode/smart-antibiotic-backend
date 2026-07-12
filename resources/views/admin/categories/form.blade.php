<div class="mb-3">

    <label class="form-label">

        Nama Kategori

    </label>

    <input
        type="text"
        name="name"
        class="form-control"
        value="{{ old('name',$category->name ?? '') }}">

</div>

<div class="mb-3">

    <label class="form-label">

        Deskripsi

    </label>

    <textarea
        name="description"
        rows="4"
        class="form-control">{{ old('description',$category->description ?? '') }}</textarea>

</div>

<div class="mb-3">

    <label class="form-label">

        Image

    </label>

    <input
        type="file"
        name="image"
        class="form-control">

    @isset($category)

    @if($category->image)

    <img
        src="{{ asset('storage/'.$category->image) }}"
        width="60"
        class="mt-3 rounded">

    @endif

    @endisset

</div>

<div class="d-flex justify-content-end">

    <a
        href="{{ route('admin.categories.index') }}"
        class="btn btn-secondary me-2">

        Kembali

    </a>

    <button
        class="btn btn-primary-custom">

        Simpan

    </button>

</div>