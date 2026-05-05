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
                    <h1 class="m-0">Edit Video</h1>
                    <a href="{{ route('admin.video-items.index') }}" class="btn btn-secondary">Kembali</a>
                </div>

                <div class="card">
                    <form action="{{ route('admin.video-items.update', $item) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                {{-- Kolom kiri --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Section</label>
                                        <select name="video_gallery_section_id" class="form-control" required>
                                            @foreach($sections as $sec)
                                                <option value="{{ $sec->id }}" {{ old('video_gallery_section_id', $item->video_gallery_section_id) == $sec->id ? 'selected' : '' }}>
                                                    {{ $sec->title }} ({{ $sec->slug }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Judul Video</label>
                                        <input type="text" name="title" class="form-control"
                                            value="{{ old('title', $item->title) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label>URL Video</label>
                                        <input type="url" name="video_url" class="form-control"
                                            value="{{ old('video_url', $item->video_url) }}" required>
                                    </div>
                                </div>

                                {{-- Kolom kanan --}}
                                <div class="col-md-6">
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
                            <a href="{{ route('admin.video-items.index') }}" class="btn btn-secondary">Batal</a>
                            <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
