@php
    $slide = $slide ?? null;
@endphp

<div class="form-row">
    <div class="form-group col-md-4">
        <label>Kicker (opsional)</label>
        <input type="text" name="kicker" class="form-control" value="{{ old('kicker', $slide->kicker ?? '') }}">
    </div>
    <div class="form-group col-md-8">
        <label>Judul</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $slide->title ?? '') }}" required>
    </div>
</div>

<div class="form-group">
    <label>Deskripsi</label>
    <textarea name="description" rows="3" class="form-control">{{ old('description', $slide->description ?? '') }}</textarea>
</div>

<div class="form-group">
    <label>Upload Background</label>
    <input type="file" name="background_image" class="form-control-file" accept="image/*,.svg">
    <small class="text-muted">jpg, jpeg, png, webp, svg • maks 5MB</small>
</div>

<div class="form-group">
    <label>Atau Background URL</label>
    <input type="url" name="background_image_url" class="form-control" value="">
</div>

@if($slide && $slide->background_image_path)
    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="remove_background_image" value="1" id="removeBg{{ $slide->id }}">
        <label class="form-check-label" for="removeBg{{ $slide->id }}">Hapus background saat simpan</label>
    </div>
@endif

<div class="form-row">
    <div class="form-group col-md-6">
        <label>Tombol Utama - Teks</label>
        <input type="text" name="primary_button_text" class="form-control"
            value="{{ old('primary_button_text', $slide->primary_button_text ?? '') }}">
    </div>
    <div class="form-group col-md-6">
        <label>Tombol Utama - URL</label>
        <input type="url" name="primary_button_url" class="form-control"
            value="{{ old('primary_button_url', $slide->primary_button_url ?? '') }}">
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label>Tombol Kedua - Teks</label>
        <input type="text" name="secondary_button_text" class="form-control"
            value="{{ old('secondary_button_text', $slide->secondary_button_text ?? '') }}">
    </div>
    <div class="form-group col-md-6">
        <label>Tombol Kedua - URL</label>
        <input type="url" name="secondary_button_url" class="form-control"
            value="{{ old('secondary_button_url', $slide->secondary_button_url ?? '') }}">
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label>Urutan Tampil</label>
        <input type="number" name="sort_order" class="form-control" min="0"
            value="{{ old('sort_order', $slide->sort_order ?? 0) }}" required>
    </div>
    <div class="form-group col-md-6">
        <label>Status</label>
        @php
            $active = old('is_active', isset($slide) && $slide ? ($slide->is_active ? '1' : '0') : '1');
        @endphp
        <select name="is_active" class="form-control" required>
            <option value="1" {{ $active == '1' ? 'selected' : '' }}>Aktif</option>
            <option value="0" {{ $active == '0' ? 'selected' : '' }}>Nonaktif</option>
        </select>
    </div>
</div>
