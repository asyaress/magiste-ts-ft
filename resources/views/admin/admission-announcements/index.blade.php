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
                    <h1 class="m-0">Popup Pengumuman Pendaftaran</h1>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambahAnnouncement">
                        + Tambah Popup
                    </button>
                </div>

                <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width: 60px;">#</th>
                                        <th>Judul</th>
                                        <th>Gambar</th>
                                        <th>Tombol</th>
                                        <th>Sort</th>
                                        <th>Status</th>
                                        <th style="width: 180px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($announcements as $i => $item)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>
                                                <div class="font-weight-bold">{{ $item->title }}</div>
                                                <small class="text-muted">{{ $item->subtitle }}</small>
                                            </td>
                                            <td>
                                                @if($item->image_url)
                                                    <a href="{{ $item->image_url }}" target="_blank" rel="noopener">Preview</a>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->button_url)
                                                    <div>{{ $item->button_text ?: 'Lihat Pengumuman' }}</div>
                                                    <small class="text-muted">{{ $item->button_url }}</small>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->sort_order }}</td>
                                            <td>
                                                @if($item->is_active)
                                                    <span class="badge badge-success">Aktif</span>
                                                @else
                                                    <span class="badge badge-secondary">Nonaktif</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-warning" data-toggle="modal"
                                                    data-target="#modalEditAnnouncement{{ $item->id }}">Edit</button>
                                                <form action="{{ route('admin.admission-announcements.destroy', $item) }}" method="POST"
                                                    class="d-inline" onsubmit="return confirm('Hapus popup ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>

                                        @push('modals')
                                        <div class="modal fade" id="modalEditAnnouncement{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <form action="{{ route('admin.admission-announcements.update', $item) }}" method="POST"
                                                    enctype="multipart/form-data" class="modal-content">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Popup Pengumuman</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Judul</label>
                                                            <input type="text" name="title" class="form-control" required
                                                                value="{{ old('title', $item->title) }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Subtitle</label>
                                                            <input type="text" name="subtitle" class="form-control"
                                                                value="{{ old('subtitle', $item->subtitle) }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Upload Gambar</label>
                                                            <input type="file" name="image" class="form-control-file" accept=".jpg,.jpeg,.png,.webp,.svg">
                                                            <small class="text-muted">jpg, jpeg, png, webp, svg maksimal 5MB.</small>
                                                        </div>
                                                        @if($item->image_url)
                                                            <div class="form-group">
                                                                <small class="d-block mb-2 text-muted">Gambar Saat Ini:</small>
                                                                <img src="{{ $item->image_url }}" alt="{{ $item->image_alt ?: $item->title }}"
                                                                    style="max-width: 280px;" class="img-fluid rounded border">
                                                            </div>
                                                        @endif
                                                        <div class="form-group">
                                                            <label>Atau URL Gambar</label>
                                                            <input type="url" name="image_url" class="form-control"
                                                                placeholder="https://..."
                                                                value="{{ old('image_url') }}">
                                                        </div>
                                                        <div class="form-check mb-3">
                                                            <input class="form-check-input" type="checkbox" name="remove_image" value="1" id="removeImage{{ $item->id }}">
                                                            <label class="form-check-label" for="removeImage{{ $item->id }}">
                                                                Hapus gambar saat simpan
                                                            </label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Alt Text Gambar</label>
                                                            <input type="text" name="image_alt" class="form-control"
                                                                value="{{ old('image_alt', $item->image_alt) }}">
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label>Teks Tombol</label>
                                                                <input type="text" name="button_text" class="form-control"
                                                                    value="{{ old('button_text', $item->button_text) }}">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>URL Tombol</label>
                                                                <input type="url" name="button_url" class="form-control"
                                                                    value="{{ old('button_url', $item->button_url) }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label>Urutan Tampil</label>
                                                                <input type="number" name="sort_order" class="form-control" min="0"
                                                                    value="{{ old('sort_order', $item->sort_order) }}">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Status</label>
                                                                <select name="is_active" class="form-control" required>
                                                                    <option value="1" {{ old('is_active', $item->is_active ? '1' : '0') == '1' ? 'selected' : '' }}>Aktif</option>
                                                                    <option value="0" {{ old('is_active', $item->is_active ? '1' : '0') == '0' ? 'selected' : '' }}>Nonaktif</option>
                                                                </select>
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
                                        @endpush
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted">Belum ada popup pengumuman.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambahAnnouncement" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="{{ route('admin.admission-announcements.store') }}" method="POST"
                enctype="multipart/form-data" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Popup Pengumuman</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" name="title" class="form-control" required value="{{ old('title') }}"
                            placeholder="Contoh: Pendaftaran Gelombang 2 Dibuka">
                    </div>
                    <div class="form-group">
                        <label>Subtitle</label>
                        <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle') }}">
                    </div>
                    <div class="form-group">
                        <label>Upload Gambar</label>
                        <input type="file" name="image" class="form-control-file" accept=".jpg,.jpeg,.png,.webp,.svg">
                        <small class="text-muted">jpg, jpeg, png, webp, svg maksimal 5MB.</small>
                    </div>
                    <div class="form-group">
                        <label>Atau URL Gambar</label>
                        <input type="url" name="image_url" class="form-control" placeholder="https://..." value="{{ old('image_url') }}">
                    </div>
                    <div class="form-group">
                        <label>Alt Text Gambar</label>
                        <input type="text" name="image_alt" class="form-control" value="{{ old('image_alt') }}">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Teks Tombol</label>
                            <input type="text" name="button_text" class="form-control" value="{{ old('button_text', 'Lihat Pengumuman') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>URL Tombol</label>
                            <input type="url" name="button_url" class="form-control" value="{{ old('button_url') }}" placeholder="https://...">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Urutan Tampil</label>
                            <input type="number" name="sort_order" class="form-control" min="0" value="{{ old('sort_order', 0) }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Status</label>
                            <select name="is_active" class="form-control" required>
                                <option value="1" selected>Aktif</option>
                                <option value="0">Nonaktif</option>
                            </select>
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
            $('#modalTambahAnnouncement').modal('show');
        @endif
    </script>
@endpush

