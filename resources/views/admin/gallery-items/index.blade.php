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
                    <h1 class="m-0">Data Galeri</h1>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambahGallery">
                        + Tambah Item
                    </button>
                </div>

                @include('admin.gallery-items._table', ['items' => $items])
            </div>
        </div>
    </div>

    {{-- MODAL TAMBAH --}}
    <div class="modal fade" id="modalTambahGallery" tabindex="-1" role="dialog" aria-labelledby="modalTambahGalleryLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="{{ route('admin.gallery-items.store') }}" method="POST" enctype="multipart/form-data"
                class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahGalleryLabel">Tambah Item Galeri</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        {{-- Kiri --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Section</label>
                                <select name="gallery_section_id" class="form-control" required>
                                    <option value="" disabled selected>Pilih Section</option>
                                    @foreach($sections as $sec)
                                        <option value="{{ $sec->id }}" {{ old('gallery_section_id') == $sec->id ? 'selected' : '' }}>
                                            {{ $sec->title }} ({{ $sec->slug }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Judul</label>
                                <input type="text" name="title" class="form-control"
                                    placeholder="Mis. Laboratorium Struktur & Bahan" value="{{ old('title') }}" required>
                            </div>

                            <div class="form-group">
                                <label>Slug (opsional)</label>
                                <input type="text" name="slug" class="form-control"
                                    placeholder="otomatis dari judul jika dikosongkan" value="{{ old('slug') }}">
                            </div>

                            <div class="form-group">
                                <label>Label Kategori</label>
                                <input type="text" name="category_label" class="form-control"
                                    placeholder="Laboratorium / Studio / ..." value="{{ old('category_label') }}">
                            </div>

                        </div>

                        {{-- Kanan --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Gambar Utama</label>
                                <input type="file" name="image" class="form-control-file" accept="image/*,.svg" required>
                                <small class="text-muted d-block">jpg, jpeg, png, webp, svg • maks 5MB</small>
                            </div>

                            <div class="form-group">
                                <label>Alt Text</label>
                                <input type="text" name="image_alt" class="form-control"
                                    placeholder="Alt untuk aksesibilitas" value="{{ old('image_alt') }}">
                            </div>

                            <div class="form-group">
                                <label>Overlay (pilih salah satu)</label>
                                <input type="file" name="overlay_image" class="form-control-file mb-1"
                                    accept="image/*,.svg">
                                <input type="url" name="overlay_link_url" class="form-control"
                                    placeholder="https://... (opsional jika tidak upload overlay)">
                                <small class="text-muted">Kalau kosong, overlay akan pakai gambar utama.</small>
                            </div>

                            <div class="form-group">
                                <label>Urutan Tampil</label>
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
        setTimeout(function () { $(".alert").fadeOut("slow"); }, 3000);
        @if ($errors->any())
            $('#modalTambahGallery').modal('show');
        @endif
    </script>
@endpush
