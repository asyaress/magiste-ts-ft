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
                    <h1 class="m-0">Edit Post</h1>
                    <a href="{{ route('admin.blog-posts.index') }}" class="btn btn-secondary">Kembali</a>
                </div>

                <div class="card">
                    <form action="{{ route('admin.blog-posts.update', $post) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                {{-- Kiri --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Section</label>
                                        <select name="blog_section_id" class="form-control" required>
                                            @foreach($sections as $sec)
                                                <option value="{{ $sec->id }}" {{ old('blog_section_id', $post->blog_section_id) == $sec->id ? 'selected' : '' }}>
                                                    {{ $sec->title }} ({{ $sec->slug }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Judul</label>
                                        <input type="text" name="title" class="form-control"
                                            value="{{ old('title', $post->title) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Slug (opsional)</label>
                                        <input type="text" name="slug" class="form-control"
                                            value="{{ old('slug', $post->slug) }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Excerpt</label>
                                        <textarea name="excerpt" rows="3"
                                            class="form-control">{{ old('excerpt', $post->excerpt) }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Body (opsional)</label>
                                        <textarea name="body" rows="8"
                                            class="form-control js-summernote">{{ old('body', $post->body) }}</textarea>
                                    </div>
                                </div>

                                {{-- Kanan --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gambar</label>
                                        @if($post->image_path)
                                            <div class="mb-2">
                                                <img src="{{ asset($post->image_path) }}" alt="" style="height:60px;">
                                            </div>
                                        @endif
                                        <input type="file" name="image" class="form-control-file" accept="image/*,.svg">
                                        <small class="text-muted d-block">jpg, jpeg, png, webp, svg • maks 5MB</small>
                                        @if($post->image_path)
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
                                            value="{{ old('image_alt', $post->image_alt) }}">
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-7">
                                            <label>Overlay Icon Class</label>
                                            <input type="text" name="overlay_icon_class" class="form-control"
                                                value="{{ old('overlay_icon_class', $post->overlay_icon_class) }}">
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label>Author</label>
                                            <input type="text" name="author_name" class="form-control"
                                                value="{{ old('author_name', $post->author_name) }}">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        @php
                                            $val = old('published_at', optional($post->published_at)->format('Y-m-d\TH:i'));
                                        @endphp
                                        <div class="form-group col-md-7">
                                            <label>Publish At</label>
                                            <input type="datetime-local" name="published_at" class="form-control"
                                                value="{{ $val }}">
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label>Comment Count</label>
                                            <input type="number" name="comment_count" class="form-control" min="0"
                                                value="{{ old('comment_count', $post->comment_count) }}">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-7">
                                            <label>Anim Duration (ms)</label>
                                            <input type="number" name="animation_duration_ms" class="form-control" min="0"
                                                value="{{ old('animation_duration_ms', $post->animation_duration_ms) }}">
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label>Sort Order</label>
                                            <input type="number" name="sort_order" class="form-control" min="0"
                                                value="{{ old('sort_order', $post->sort_order) }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="is_published" class="form-control" required>
                                            <option value="1" {{ old('is_published', $post->is_published ? '1' : '0') == '1' ? 'selected' : '' }}>Published</option>
                                            <option value="0" {{ old('is_published', $post->is_published ? '1' : '0') == '0' ? 'selected' : '' }}>Draft</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="card-footer d-flex justify-content-between">
                            <a href="{{ route('admin.blog-posts.index') }}" class="btn btn-secondary">Batal</a>
                            <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>

            </div>
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
                height: 340,
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
        })();
    </script>
@endpush
