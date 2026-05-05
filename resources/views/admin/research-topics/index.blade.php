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
                    <h1 class="m-0">Data Topik Riset</h1>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambahTopic">
                        + Tambah Topik
                    </button>
                </div>

                @include('admin.research-topics._table', ['topics' => $topics])
            </div>
        </div>
    </div>

    {{-- MODAL TAMBAH TOPIK --}}
    <div class="modal fade" id="modalTambahTopic" tabindex="-1" role="dialog" aria-labelledby="modalTambahTopicLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="{{ route('admin.research-topics.store') }}" method="POST" enctype="multipart/form-data"
                class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahTopicLabel">Tambah Topik Riset</h5>
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
                                <select name="research_section_id" class="form-control" required>
                                    <option value="" disabled selected>Pilih Section</option>
                                    @foreach($sections as $sec)
                                        <option value="{{ $sec->id }}" {{ old('research_section_id') == $sec->id ? 'selected' : '' }}>
                                            {{ $sec->title }} ({{ $sec->slug }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Judul Topik</label>
                                <input type="text" name="title" class="form-control"
                                    placeholder="Mis. Struktur & Material Cerdas" value="{{ old('title') }}" required>
                            </div>

                            <div class="form-group">
                                <label>Slug (opsional)</label>
                                <input type="text" name="slug" class="form-control"
                                    placeholder="otomatis dari judul jika dikosongkan" value="{{ old('slug') }}">
                            </div>

                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea name="description" class="form-control" rows="4"
                                    placeholder="Ringkasan topik">{{ old('description') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Icon Class</label>
                                <input type="text" name="icon_class" class="form-control" placeholder="flaticon-architect"
                                    value="{{ old('icon_class') }}">
                            </div>

                            <div class="form-group">
                                <label>BG Color Class</label>
                                <input type="text" name="bg_color_class" class="form-control" placeholder="bgclr1"
                                    value="{{ old('bg_color_class') }}">
                            </div>

                            <div class="form-group">
                                <label>Delay Animasi (ms)</label>
                                <input type="number" name="animation_delay_ms" class="form-control"
                                    value="{{ old('animation_delay_ms', 0) }}" min="0">
                            </div>
                        </div>

                        {{-- Kolom kanan --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Gambar Utama</label>
                                <input type="file" name="image" class="form-control-file" accept="image/*,.svg">
                                <small class="text-muted d-block">jpg, jpeg, png, webp, svg • maks 5MB</small>
                            </div>

                            <div class="form-group">
                                <label>Alt Text Gambar</label>
                                <input type="text" name="image_alt" class="form-control" placeholder="Alt text"
                                    value="{{ old('image_alt') }}">
                            </div>

                            <div class="form-group">
                                <label>Gambar Gallery (opsional)</label>
                                <input type="file" name="gallery_image" class="form-control-file" accept="image/*,.svg">
                                <small class="text-muted d-block">jpg, jpeg, png, webp, svg • maks 5MB</small>
                            </div>

                            <div class="form-group">
                                <label>Sort Order</label>
                                <input type="number" name="sort_order" class="form-control"
                                    value="{{ old('sort_order', 0) }}" min="0" required>
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <select name="is_active" class="form-control" required>
                                    <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
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
        // Auto close alert
        setTimeout(function () { $(".alert").fadeOut("slow"); }, 3000);

        // Auto-buka modal saat ada error validasi agar user lihat formnya
        @if ($errors->any())
            $('#modalTambahTopic').modal('show');
        @endif
    </script>
@endpush
