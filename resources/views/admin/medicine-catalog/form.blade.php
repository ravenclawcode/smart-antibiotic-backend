<div class="mb-3">

    <label class="form-label">

        Nama Obat

    </label>

    <input
        type="text"
        name="name"
        class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $medicine_catalog->name ?? '') }}">

    @error('name')

    <div class="invalid-feedback">

        {{ $message }}

    </div>

    @enderror

</div>

<div class="mb-4">

    <label class="form-label">

        Gambar

    </label>

    <input
        type="file"
        name="image"
        class="form-control @error('image') is-invalid @enderror">

    @error('image')

    <div class="invalid-feedback">

        {{ $message }}

    </div>

    @enderror

    @isset($medicine_catalog)

    @if($medicine_catalog->image)

    <img
        src="{{ asset('storage/'.$medicine_catalog->image) }}"
        width="60"
        class="mt-3 rounded">

    @endif

    @endisset

</div>

<div class="d-flex justify-content-end">

    <a
        href="{{ route('admin.medicine-catalog.index') }}"
        class="btn btn-secondary me-2">
        Kembali
    </a>

    <button
        class="btn btn-primary-custom">
        Simpan
    </button>

</div>