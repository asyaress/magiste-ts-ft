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
                    <h1 class="m-0">Gallery Sections</h1>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambahSection">+ Tambah Section</button>
                </div>

                <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Slug</th>
                                        <th>Title</th>
                                        <th>Tombol</th>
                                        <th>Sort</th>
                                        <th>Status</th>
                                        <th style="width:190px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($sections as $i => $sec)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td><code>{{ $sec->slug }}</code></td>
                                            <td>
                                                <div class="font-weight-bold">{{ $sec->title }}</div>
                                                <small class="text-muted">{{ $sec->subtitle }}</small>
                                            </td>
                                            <td>
                                                @if($sec->button_text)
                                                    <div>{{ $sec->button_text }}</div>
                                                    <small class="text-muted">{{ $sec->button_url }}</small>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>{{ $sec->sort_order }}</td>
                                            <td>
                                                @if($sec->is_active)
                                                    <span class="badge badge-success">Aktif</span>
                                                @else
                                                    <span class="badge badge-secondary">Nonaktif</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-warning" data-toggle="modal"
                                                    data-target="#modalEditSection{{ $sec->id }}">Edit</button>
                                                <form action="{{ route('admin.gallery-sections.destroy', $sec) }}" method="POST"
                                                    class="d-inline" onsubmit="return confirm('Hapus section ini?')">
                                                    @csrf @method('DELETE')
                                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="modalEditSection{{ $sec->id }}" tabindex="-1" role="dialog"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form action="{{ route('admin.gallery-sections.update', $sec) }}" method="POST"
                                                    class="modal-content">
                                                    @csrf @method('PUT')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Gallery Section</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Slug</label>
                                                            <input type="text" name="slug" class="form-control" value="{{ $sec->slug }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Title</label>
                                                            <input type="text" name="title" class="form-control" value="{{ $sec->title }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Subtitle</label>
                                                            <input type="text" name="subtitle" class="form-control" value="{{ $sec->subtitle }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Button Text</label>
                                                            <input type="text" name="button_text" class="form-control" value="{{ $sec->button_text }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Button URL</label>
                                                            <input type="url" name="button_url" class="form-control" value="{{ $sec->button_url }}">
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label>Sort Order</label>
                                                                <input type="number" name="sort_order" class="form-control" min="0"
                                                                    value="{{ $sec->sort_order }}">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label>Status</label>
                                                                <select name="is_active" class="form-control" required>
                                                                    <option value="1" {{ $sec->is_active ? 'selected' : '' }}>Aktif</option>
                                                                    <option value="0" {{ !$sec->is_active ? 'selected' : '' }}>Nonaktif</option>
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
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted">Belum ada section galeri.</td>
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

    <div class="modal fade" id="modalTambahSection" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.gallery-sections.store') }}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Gallery Section</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group"><label>Slug</label><input type="text" name="slug" class="form-control" required></div>
                    <div class="form-group"><label>Title</label><input type="text" name="title" class="form-control" required></div>
                    <div class="form-group"><label>Subtitle</label><input type="text" name="subtitle" class="form-control"></div>
                    <div class="form-group"><label>Button Text</label><input type="text" name="button_text" class="form-control"></div>
                    <div class="form-group"><label>Button URL</label><input type="url" name="button_url" class="form-control"></div>
                    <div class="form-row">
                        <div class="form-group col-md-6"><label>Sort Order</label><input type="number" name="sort_order" class="form-control" min="0" value="0"></div>
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
            $('#modalTambahSection').modal('show');
        @endif
    </script>
@endpush
