@php $item = $item ?? null; @endphp

<div class="form-group">
    <label>Judul</label>
    <input type="text" name="title" class="form-control" value="{{ old('title', $item->title ?? '') }}" required>
</div>
<div class="form-group">
    <label>Deskripsi</label>
    <textarea name="description" rows="3" class="form-control">{{ old('description', $item->description ?? '') }}</textarea>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label>Urutan Tampil</label>
        <input type="number" name="sort_order" class="form-control" min="0" value="{{ old('sort_order', $item->sort_order ?? 0) }}" required>
    </div>
    <div class="form-group col-md-6">
        <label>Status</label>
        @php $active = old('is_active', $item ? ($item->is_active ? '1' : '0') : '1'); @endphp
        <select name="is_active" class="form-control" required>
            <option value="1" {{ $active == '1' ? 'selected' : '' }}>Aktif</option>
            <option value="0" {{ $active == '0' ? 'selected' : '' }}>Nonaktif</option>
        </select>
    </div>
</div>
