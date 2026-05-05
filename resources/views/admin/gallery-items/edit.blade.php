@extends('layout/main')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                @endif

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1 class="m-0">Edit Item Galeri</h1>
                    <a href="{{ route('admin.gallery-items.index') }}" class="btn btn-secondary">Kembali</a>
                </div>

                <div class="card">
                    <form action="{{ route('admin.gallery-items.update', $item) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                {{-- Kiri --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Section</label>
                                        <select name="gallery_section_id" class="form-control" required>
                                            @foreach($sections as $sec)
                                                <option value="{{ $sec->id }}" {{ old('gallery_section_id', $item->gallery_section_id) == $sec->id ? 'selected' : '' }}>
                                                    {{ $sec->title }} ({{ $sec->slug }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Judul</label>
                                        <input type="text" name="title" class="form-control"
                                            value="{{ old('title', $item->title) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Slug (opsional)</label>
                                        <input type="text" name="slug" class="form-control"
                                            value="{{ old('slug', $item->slug) }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Label Kategori</label>
                                        <input type="text" name="category_label" class="form-control"
                                            value="{{ old('category_label', $item->category_label) }}">
                                    </div>

                                </div>

                                {{-- Kanan --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gambar Utama</label>
                                        @if($item->image_path)
                                            <div class="mb-2">
                                                <img src="{{ asset($item->image_path) }}" alt="" style="height:60px;">
                                            </div>
                                        @endif
                                        <input type="file" name="image" class="form-control-file" accept="image/*,.svg">
                                        <small class="text-muted d-block">jpg, jpeg, png, webp, svg • maks 5MB</small>
                                        @if($item->image_path)
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="checkbox" name="remove_image" value="1"
                                                    id="removeImage">
                                                <label class="form-check-label" for="removeImage">Hapus gambar saat
                                                    simpan</label>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Alt Text</label>
                                        <input type="text" name="image_alt" class="form-control"
                                            value="{{ old('image_alt', $item->image_alt) }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Overlay</label>
                                        @if($item->overlay_link_path && Str::startsWith($item->overlay_link_path, 'storage/'))
                                            <div class="mb-2">
                                                <img src="{{ asset($item->overlay_link_path) }}" alt="" style="height:60px;">
                                            </div>
                                        @elseif($item->overlay_link_path)
                                            <div class="mb-2">
                                                <a href="{{ $item->overlay_link_path }}"
                                                    target="_blank">{{ \Illuminate\Support\Str::limit($item->overlay_link_path, 50) }}</a>
                                            </div>
                                        @endif
                                        <input type="file" name="overlay_image" class="form-control-file mb-1"
                                            accept="image/*,.svg">
                                        <input type="url" name="overlay_link_url" class="form-control"
                                            placeholder="https://..." value="{{ old('overlay_link_url') }}">
                                        @if($item->overlay_link_path)
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="checkbox" name="remove_overlay" value="1"
                                                    id="removeOverlay">
                                                <label class="form-check-label" for="removeOverlay">Hapus overlay saat
                                                    simpan</label>
                                            </div>
                                        @endif
                                        <small class="text-muted d-block">Kalau kosong, overlay akan pakai gambar
                                            utama.</small>
                                    </div>

                                    <div class="form-group">
                                        <label>Urutan Tampil</label>
                                        <input type="number" name="sort_order" class="form-control"
                                            value="{{ old('sort_order', $item->sort_order) }}" min="0" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="is_active" class="form-control" required>
                                            <option value="1" {{ old('is_active', $item->is_active ? '1' : '0') == '1' ? 'selected' : '' }}>Aktif</option>
                                            <option value="0" {{ old('is_active', $item->is_active ? '1' : '0') == '0' ? 'selected' : '' }}>Nonaktif</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer d-flex justify-content-between">
                            <a href="{{ route('admin.gallery-items.index') }}" class="btn btn-secondary">Batal</a>
                            <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
