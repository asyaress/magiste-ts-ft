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
                    <h1 class="m-0">Edit Pengajar</h1>
                    <a href="{{ route('admin.teachers.index') }}" class="btn btn-secondary">Kembali</a>
                </div>

                <div class="card">
                    <form action="{{ route('admin.teachers.update', $teacher) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                {{-- Kiri --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Section</label>
                                        <select name="teacher_section_id" class="form-control" required>
                                            @foreach($sections as $sec)
                                                <option value="{{ $sec->id }}" {{ old('teacher_section_id', $teacher->teacher_section_id) == $sec->id ? 'selected' : '' }}>
                                                    {{ $sec->title }} ({{ $sec->slug }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ old('name', $teacher->name) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Slug (opsional)</label>
                                        <input type="text" name="slug" class="form-control"
                                            value="{{ old('slug', $teacher->slug) }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Tagline/Jabatan</label>
                                        <input type="text" name="tagline" class="form-control"
                                            value="{{ old('tagline', $teacher->tagline) }}">
                                    </div>
                                </div>

                                {{-- Kanan --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Foto</label>
                                        @if($teacher->photo_path)
                                            <div class="mb-2">
                                                <img src="{{ asset($teacher->photo_path) }}" alt="" style="height:60px;">
                                            </div>
                                        @endif
                                        <input type="file" name="photo" class="form-control-file" accept="image/*,.svg">
                                        <small class="text-muted d-block">jpg, jpeg, png, webp, svg • maks 5MB</small>
                                        @if($teacher->photo_path)
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="checkbox" name="remove_photo" value="1"
                                                    id="removePhoto">
                                                <label class="form-check-label" for="removePhoto">Hapus foto saat simpan</label>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Alt Text Foto</label>
                                        <input type="text" name="photo_alt" class="form-control"
                                            value="{{ old('photo_alt', $teacher->photo_alt) }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Profile URL</label>
                                        <input type="url" name="profile_url" class="form-control"
                                            value="{{ old('profile_url', $teacher->profile_url) }}">
                                    </div>

                                    <div class="form-group">
                                        <label>LinkedIn URL</label>
                                        <input type="url" name="linkedin_url" class="form-control"
                                            value="{{ old('linkedin_url', $teacher->linkedin_url) }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Google Scholar URL</label>
                                        <input type="url" name="scholar_url" class="form-control"
                                            value="{{ old('scholar_url', $teacher->scholar_url) }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Website/Profil Web</label>
                                        <input type="url" name="website_url" class="form-control"
                                            value="{{ old('website_url', $teacher->website_url) }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Grid Classes</label>
                                        <input type="text" name="col_classes" class="form-control"
                                            value="{{ old('col_classes', $teacher->col_classes) }}">
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>WOW Animation Class</label>
                                            <input type="text" name="wow_animation_class" class="form-control"
                                                value="{{ old('wow_animation_class', $teacher->wow_animation_class) }}">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Delay (ms)</label>
                                            <input type="number" name="animation_delay_ms" class="form-control"
                                                value="{{ old('animation_delay_ms', $teacher->animation_delay_ms) }}"
                                                min="0">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Duration (ms)</label>
                                            <input type="number" name="animation_duration_ms" class="form-control"
                                                value="{{ old('animation_duration_ms', $teacher->animation_duration_ms) }}"
                                                min="0">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Sort Order</label>
                                            <input type="number" name="sort_order" class="form-control"
                                                value="{{ old('sort_order', $teacher->sort_order) }}" min="0" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Status</label>
                                            <select name="is_active" class="form-control" required>
                                                <option value="1" {{ old('is_active', $teacher->is_active ? '1' : '0') == '1' ? 'selected' : '' }}>Aktif</option>
                                                <option value="0" {{ old('is_active', $teacher->is_active ? '1' : '0') == '0' ? 'selected' : '' }}>Nonaktif</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="card-footer d-flex justify-content-between">
                            <a href="{{ route('admin.teachers.index') }}" class="btn btn-secondary">Batal</a>
                            <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
