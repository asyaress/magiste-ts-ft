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
                    <h1 class="m-0">Data Blog/News</h1>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambahPost">
                        + Tambah Post
                    </button>
                </div>

                @include('admin.blog-posts._table', ['posts' => $posts])
            </div>
        </div>
    </div>

    {{-- MODAL TAMBAH POST --}}
    <div class="modal fade" id="modalTambahPost" tabindex="-1" role="dialog" aria-labelledby="modalTambahPostLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <form action="{{ route('admin.blog-posts.store') }}" method="POST" enctype="multipart/form-data"
                class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahPostLabel">Tambah Post</h5>
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
                                <select name="blog_section_id" class="form-control" required>
                                    <option value="" disabled selected>Pilih Section</option>
                                    @foreach($sections as $sec)
                                        <option value="{{ $sec->id }}" {{ old('blog_section_id') == $sec->id ? 'selected' : '' }}>
                                            {{ $sec->title }} ({{ $sec->slug }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Judul</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                            </div>

                            <div class="form-group">
                                <label>Slug (opsional)</label>
                                <input type="text" name="slug" class="form-control" value="{{ old('slug') }}"
                                    placeholder="otomatis dari judul jika kosong">
                            </div>

                            <div class="form-group">
                                <label>Excerpt (ringkas)</label>
                                <textarea name="excerpt" rows="3" class="form-control"
                                    placeholder="Ringkasan singkat">{{ old('excerpt') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Body (opsional)</label>
                                <textarea name="body" rows="6" class="form-control js-summernote"
                                    placeholder="Konten lengkap (opsional)">{{ old('body') }}</textarea>
                            </div>
                        </div>

                        {{-- Kanan --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Gambar</label>
                                <input type="file" name="image" class="form-control-file" accept="image/*,.svg">
                                <small class="text-muted d-block">jpg, jpeg, png, webp, svg • maks 5MB</small>
                            </div>

                            <div class="form-group">
                                <label>Alt Text Gambar</label>
                                <input type="text" name="image_alt" class="form-control" value="{{ old('image_alt') }}">
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-7">
                                    <label>Overlay Icon Class</label>
                                    <input type="text" name="overlay_icon_class" class="form-control"
                                        value="{{ old('overlay_icon_class', 'flaticon-plus') }}">
                                </div>
                                <div class="form-group col-md-5">
                                    <label>Author</label>
                                    <input type="text" name="author_name" class="form-control"
                                        value="{{ old('author_name') }}">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-7">
                                    <label>Publish At</label>
                                    <input type="datetime-local" name="published_at" class="form-control"
                                        value="{{ old('published_at') }}">
                                    <small class="text-muted">Kosongkan untuk draft.</small>
                                </div>
                                <div class="form-group col-md-5">
                                    <label>Comment Count</label>
                                    <input type="number" name="comment_count" class="form-control" min="0"
                                        value="{{ old('comment_count', 0) }}">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-7">
                                    <label>Anim Duration (ms)</label>
                                    <input type="number" name="animation_duration_ms" class="form-control" min="0"
                                        value="{{ old('animation_duration_ms', 1500) }}">
                                </div>
                                <div class="form-group col-md-5">
                                    <label>Sort Order</label>
                                    <input type="number" name="sort_order" class="form-control" min="0"
                                        value="{{ old('sort_order', 0) }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <select name="is_published" class="form-control" required>
                                    <option value="1" {{ old('is_published', '1') == '1' ? 'selected' : '' }}>Published
                                    </option>
                                    <option value="0" {{ old('is_published') == '0' ? 'selected' : '' }}>Draft</option>
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
        (function() {
            const uploadUrl = "{{ route('admin.blog-posts.editor-image') }}";
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            function uploadImage(file, editor) {
                const data = new FormData();
                data.append('image', file);
                data.append('_token', csrfToken || '');

                $.ajax({
                    url: uploadUrl,
                    method: 'POST',
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response && response.url) {
                            $(editor).summernote('insertImage', response.url);
                        }
                    },
                    error: function() {
                        alert('Upload gambar gagal. Coba lagi.');
                    }
                });
            }

            $('.js-summernote').summernote({
                height: 280,
                placeholder: 'Tulis konten artikel...',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['codeview']]
                ],
                callbacks: {
                    onImageUpload: function(files) {
                        for (let i = 0; i < files.length; i++) {
                            uploadImage(files[i], this);
                        }
                    }
                }
            });

            setTimeout(function() { $(".alert").fadeOut("slow"); }, 3000);
            @if ($errors->any())
                $('#modalTambahPost').modal('show');
            @endif
        })();
    </script>
@endpush
