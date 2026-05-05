@php $item = $item ?? null; @endphp

<div class="form-row">
    <div class="form-group col-md-4">
        <label>Step Number</label>
        <input type="number" name="step_number" class="form-control" min="1"
            value="{{ old('step_number', $item->step_number ?? 1) }}" required>
    </div>
    <div class="form-group col-md-8">
        <label>Judul</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $item->title ?? '') }}" required>
    </div>
</div>

<div class="form-group">
    <label>Konten HTML</label>
    <textarea name="content_html" rows="8" class="form-control">{{ old('content_html', $item->content_html ?? '') }}</textarea>
    <small class="text-muted">Boleh isi tag HTML sederhana seperti &lt;p&gt;, &lt;ul&gt;, &lt;li&gt;.</small>
</div>

<div class="form-row">
    <div class="form-group col-md-4">
        <div class="form-check mt-4">
            @php $openDefault = old('is_open_by_default', $item ? ($item->is_open_by_default ? '1' : '0') : '0'); @endphp
            <input class="form-check-input" type="checkbox" name="is_open_by_default" value="1" id="openDefault{{ $item->id ?? 'new' }}"
                {{ $openDefault == '1' ? 'checked' : '' }}>
            <label class="form-check-label" for="openDefault{{ $item->id ?? 'new' }}">Open by default</label>
        </div>
    </div>
    <div class="form-group col-md-4">
        <label>Urutan Tampil</label>
        <input type="number" name="sort_order" class="form-control" min="0"
            value="{{ old('sort_order', $item->sort_order ?? 0) }}" required>
    </div>
    <div class="form-group col-md-4">
        <label>Status</label>
        @php $active = old('is_active', $item ? ($item->is_active ? '1' : '0') : '1'); @endphp
        <select name="is_active" class="form-control" required>
            <option value="1" {{ $active == '1' ? 'selected' : '' }}>Aktif</option>
            <option value="0" {{ $active == '0' ? 'selected' : '' }}>Nonaktif</option>
        </select>
    </div>
</div>
