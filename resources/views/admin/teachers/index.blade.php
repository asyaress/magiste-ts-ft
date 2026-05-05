@extends('layout/main')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">

                {{-- Flash messages --}}
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
                    <h1 class="m-0">Data Pengajar</h1>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambahTeacher">
                        + Tambah Pengajar
                    </button>
                </div>

                @include('admin.teachers._table', ['teachers' => $teachers])
            </div>
        </div>
    </div>

    {{-- MODAL TAMBAH --}}
    <div class="modal fade" id="modalTambahTeacher" tabindex="-1" role="dialog" aria-labelledby="modalTambahTeacherLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="{{ route('admin.teachers.store') }}" method="POST" enctype="multipart/form-data"
                class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahTeacherLabel">Tambah Pengajar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        {{-- Kolom kiri --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Section</label>
                                <select name="teacher_section_id" class="form-control" required>
                                    <option value="" disabled selected>Pilih Section</option>
                                    @foreach($sections as $sec)
                                        <option value="{{ $sec->id }}" {{ old('teacher_section_id') == $sec->id ? 'selected' : '' }}>
                                            {{ $sec->title }} ({{ $sec->slug }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="name" class="form-control" placeholder="Nama lengkap"
                                    value="{{ old('name') }}" required>
                            </div>

                            <div class="form-group">
                                <label>Slug (opsional)</label>
                                <input type="text" name="slug" class="form-control"
                                    placeholder="otomatis dari nama jika kosong" value="{{ old('slug') }}">
                            </div>

                            <div class="form-group">
                                <label>Tagline/Jabatan</label>
                                <input type="text" name="tagline" class="form-control"
                                    placeholder="Mis. Kaprodi — Struktur & Material" value="{{ old('tagline') }}">
                            </div>
                        </div>

                        {{-- Kolom kanan --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Foto</label>
                                <input type="file" name="photo" class="form-control-file" accept="image/*,.svg">
                                <small class="text-muted d-block">jpg, jpeg, png, webp, svg • maks 5MB</small>
                            </div>

                            <div class="form-group">
                                <label>Alt Text Foto</label>
                                <input type="text" name="photo_alt" class="form-control"
                                    placeholder="Alt untuk aksesibilitas" value="{{ old('photo_alt') }}">
                            </div>

                            <div class="form-group">
                                <label>Profile URL</label>
                                <input type="url" name="profile_url" class="form-control" placeholder="https://..."
                                    value="{{ old('profile_url') }}">
                            </div>

                            <div class="form-group">
                                <label>LinkedIn URL</label>
                                <input type="url" name="linkedin_url" class="form-control"
                                    placeholder="https://linkedin.com/in/..." value="{{ old('linkedin_url') }}">
                            </div>

                            <div class="form-group">
                                <label>Google Scholar URL</label>
                                <input type="url" name="scholar_url" class="form-control"
                                    placeholder="https://scholar.google.com/..." value="{{ old('scholar_url') }}">
                            </div>

                            <div class="form-group">
                                <label>Website/Profil Web</label>
                                <input type="url" name="website_url" class="form-control" placeholder="https://..."
                                    value="{{ old('website_url') }}">
                            </div>

                            <div class="form-group">
                                <label>Grid Classes</label>
                                <input type="text" name="col_classes" class="form-control"
                                    value="{{ old('col_classes', 'col-xl-3 col-lg-6 col-md-6') }}">
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>WOW Animation Class</label>
                                    <input type="text" name="wow_animation_class" class="form-control"
                                        value="{{ old('wow_animation_class', 'wow fadeInUp') }}">
                                    <small class="text-muted">Contoh: <code>wow fadeInUp</code>,
                                        <code>wow fadeInDown</code></small>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Delay (ms)</label>
                                    <input type="number" name="animation_delay_ms" class="form-control"
                                        value="{{ old('animation_delay_ms', 100) }}" min="0">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Duration (ms)</label>
                                    <input type="number" name="animation_duration_ms" class="form-control"
                                        value="{{ old('animation_duration_ms', 1500) }}" min="0">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Sort Order</label>
                                    <input type="number" name="sort_order" class="form-control"
                                        value="{{ old('sort_order', 0) }}" min="0" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Status</label>
                                    <select name="is_active" class="form-control" required>
                                        <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        setTimeout(function () { $(".alert").fadeOut("slow"); }, 3000);
        @if ($errors->any())
            $('#modalTambahTeacher').modal('show');
        @endif
    </script>
@endpush
