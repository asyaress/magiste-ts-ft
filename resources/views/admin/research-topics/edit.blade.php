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
                    <h1 class="m-0">Edit Topik Riset</h1>
                    <a href="{{ route('admin.research-topics.index') }}" class="btn btn-secondary">Kembali</a>
                </div>

                <div class="card">
                    <form action="{{ route('admin.research-topics.update', $topic) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                {{-- Kolom kiri --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Section</label>
                                        <select name="research_section_id" class="form-control" required>
                                            @foreach($sections as $sec)
                                                <option value="{{ $sec->id }}" {{ old('research_section_id', $topic->research_section_id) == $sec->id ? 'selected' : '' }}>
                                                    {{ $sec->title }} ({{ $sec->slug }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Judul Topik</label>
                                        <input type="text" name="title" class="form-control"
                                            value="{{ old('title', $topic->title) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Slug (opsional)</label>
                                        <input type="text" name="slug" class="form-control"
                                            value="{{ old('slug', $topic->slug) }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Deskripsi</label>
                                        <textarea name="description" class="form-control"
                                            rows="4">{{ old('description', $topic->description) }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Icon Class</label>
                                        <input type="text" name="icon_class" class="form-control"
                                            value="{{ old('icon_class', $topic->icon_class) }}">
                                    </div>

                                    <div class="form-group">
                                        <label>BG Color Class</label>
                                        <input type="text" name="bg_color_class" class="form-control"
                                            value="{{ old('bg_color_class', $topic->bg_color_class) }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Delay Animasi (ms)</label>
                                        <input type="number" name="animation_delay_ms" class="form-control"
                                            value="{{ old('animation_delay_ms', $topic->animation_delay_ms) }}" min="0">
                                    </div>
                                </div>

                                {{-- Kolom kanan --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gambar Utama</label>
                                        @if($topic->image_path)
                                            <div class="mb-2">
                                                <img src="{{ asset($topic->image_path) }}" alt="" style="height:60px;">
                                            </div>
                                        @endif
                                        <input type="file" name="image" class="form-control-file" accept="image/*,.svg">
                                        <small class="text-muted d-block">jpg, jpeg, png, webp, svg • maks 5MB</small>
                                        @if($topic->image_path)
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="checkbox" name="remove_image" value="1"
                                                    id="removeImage">
                                                <label class="form-check-label" for="removeImage">Hapus gambar saat
                                                    simpan</label>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Alt Text Gambar</label>
                                        <input type="text" name="image_alt" class="form-control"
                                            value="{{ old('image_alt', $topic->image_alt) }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Gambar Gallery</label>
                                        @if($topic->gallery_image_path)
                                            <div class="mb-2">
                                                <img src="{{ asset($topic->gallery_image_path) }}" alt="" style="height:60px;">
                                            </div>
                                        @endif
                                        <input type="file" name="gallery_image" class="form-control-file"
                                            accept="image/*,.svg">
                                        <small class="text-muted d-block">jpg, jpeg, png, webp, svg • maks 5MB</small>
                                        @if($topic->gallery_image_path)
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="checkbox" name="remove_gallery_image"
                                                    value="1" id="removeGalleryImage">
                                                <label class="form-check-label" for="removeGalleryImage">Hapus image gallery
                                                    saat simpan</label>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Sort Order</label>
                                        <input type="number" name="sort_order" class="form-control"
                                            value="{{ old('sort_order', $topic->sort_order) }}" min="0" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="is_active" class="form-control" required>
                                            <option value="1" {{ old('is_active', $topic->is_active ? '1' : '0') == '1' ? 'selected' : '' }}>Aktif</option>
                                            <option value="0" {{ old('is_active', $topic->is_active ? '1' : '0') == '0' ? 'selected' : '' }}>Nonaktif</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer d-flex justify-content-between">
                            <a href="{{ route('admin.research-topics.index') }}" class="btn btn-secondary">Batal</a>
                            <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
