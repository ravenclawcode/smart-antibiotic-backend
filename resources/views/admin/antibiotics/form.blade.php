<div class="mb-3">

    <label>Kategori</label>

    <select
        name="antibiotic_category_id"
        class="form-select">

        <option value="">Pilih Kategori</option>

        @foreach($categories as $category)

        <option
            value="{{ $category->id }}"
            @selected(old('antibiotic_category_id',$antibiotic->antibiotic_category_id ?? '')==$category->id)>

            {{ $category->name }}

        </option>

        @endforeach

    </select>

</div>

<div class="mb-3">

    <label>Nama Antibiotik</label>

    <input
        type="text"
        name="name"
        class="form-control"
        value="{{ old('name',$antibiotic->name ?? '') }}">

</div>

<div class="mb-3">

    <label>Gambar</label>

    <input
        type="file"
        name="image"
        class="form-control">

    @isset($antibiotic)

    @if($antibiotic->image)

    <img
        src="{{ asset('storage/'.$antibiotic->image) }}"
        width="60"
        class="rounded mt-3">

    @endif

    @endisset

</div>

<div class="mb-3">

    <label>Ringkasan</label>

    <textarea
        name="summary"
        rows="3"
        class="form-control">{{ old('summary',$antibiotic->summary ?? '') }}</textarea>

</div>

<div class="mb-3">

    <label>Indikasi</label>

    <textarea
        name="indication"
        rows="4"
        class="form-control">{{ old('indication',$antibiotic->indication ?? '') }}</textarea>

</div>

<div class="mb-3">

    <label>Mekanisme</label>

    <textarea
        name="mechanism"
        rows="4"
        class="form-control">{{ old('mechanism',$antibiotic->mechanism ?? '') }}</textarea>

</div>

<div class="mb-3">

    <label>Dosis</label>

    <textarea
        name="dosage"
        rows="4"
        class="form-control">{{ old('dosage',$antibiotic->dosage ?? '') }}</textarea>

</div>

<div class="mb-4">

    <label>Video Youtube</label>

    <input
        type="url"
        name="video_url"
        class="form-control"
        value="{{ old('video_url',$antibiotic->video_url ?? '') }}">

</div>

<div class="d-flex justify-content-end">

    <a
        href="{{ route('admin.antibiotics.index') }}"
        class="btn btn-secondary me-2">

        Kembali

    </a>

    <button
        class="btn btn-primary-custom">

        Simpan

    </button>

</div>