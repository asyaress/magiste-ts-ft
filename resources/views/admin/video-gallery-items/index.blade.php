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
                    <h1 class="m-0">Data Video Gallery</h1>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambahVideo">
                        + Tambah Video
                    </button>
                </div>

                @include('admin.video-gallery-items._table', ['items' => $items])
            </div>
        </div>
    </div>

    {{-- MODAL TAMBAH VIDEO --}}
    <div class="modal fade" id="modalTambahVideo" tabindex="-1" role="dialog" aria-labelledby="modalTambahVideoLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="{{ route('admin.video-items.store') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahVideoLabel">Tambah Video</h5>
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
                                <select name="video_gallery_section_id" class="form-control" required>
                                    <option value="" disabled selected>Pilih Section</option>
                                    @foreach($sections as $sec)
                                        <option value="{{ $sec->id }}" {{ old('video_gallery_section_id') == $sec->id ? 'selected' : '' }}>
                                            {{ $sec->title }} ({{ $sec->slug }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Judul Video</label>
                                <input type="text" name="title" class="form-control" placeholder="Mis. Company Video"
                                    value="{{ old('title') }}" required>
                            </div>

                            <div class="form-group">
                                <label>URL Video</label>
                                <input type="url" name="video_url" class="form-control"
                                    placeholder="https://www.youtube.com/watch?v=..." value="{{ old('video_url') }}"
                                    required>
                                <small class="text-muted">Dukungan: YouTube/Vimeo/MP4 (tergantung plugin popup yang kamu
                                    pakai)</small>
                            </div>
                        </div>

                        {{-- Kolom kanan --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Play Icon Class</label>
                                <input type="text" name="play_icon_class" class="form-control"
                                    placeholder="flaticon-play-button-1"
                                    value="{{ old('play_icon_class', 'flaticon-play-button-1') }}">
                            </div>

                            <div class="form-group">
                                <label>Delay Animasi (ms)</label>
                                <input type="number" name="animation_delay_ms" class="form-control"
                                    value="{{ old('animation_delay_ms', 300) }}" min="0">
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

        // Auto-buka modal saat ada error validasi
        @if ($errors->any())
            $('#modalTambahVideo').modal('show');
        @endif
    </script>
@endpush
