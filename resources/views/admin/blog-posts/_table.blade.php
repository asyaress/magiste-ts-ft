@php
    use Illuminate\Support\Str;
@endphp

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead class="thead-light">
                    <tr>
                        <th style="width:60px;">#</th>
                        <th>Gambar</th>
                        <th>Judul & Slug</th>
                        <th>Section</th>
                        <th>Publish</th>
                        <th>Komentar</th>
                        <th>Author</th>
                        <th>Anim</th>
                        <th>Sort</th>
                        <th style="width:160px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $i => $p)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>
                                @if($p->image_path)
                                    <img src="{{ asset($p->image_path) }}" alt="" style="height:40px;">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <div class="font-weight-bold">{{ Str::limit($p->title, 60) }}</div>
                                <small class="text-muted">/{{ $p->slug }}</small>
                                @if($p->excerpt)
                                    <div><small class="text-muted">{{ Str::limit($p->excerpt, 70) }}</small></div>
                                @endif
                            </td>
                            <td>
                                {{ optional($p->section)->title }}
                                <small class="text-muted d-block">({{ optional($p->section)->slug }})</small>
                            </td>
                            <td>
                                @if($p->is_published && $p->published_at)
                                    <span class="badge badge-success">Published</span>
                                    <small class="d-block text-muted">{{ $p->published_at->format('Y-m-d H:i') }}</small>
                                @else
                                    <span class="badge badge-secondary">Draft</span>
                                @endif
                            </td>
                            <td>{{ $p->comment_count }}</td>
                            <td>{{ $p->author_name ?: '-' }}</td>
                            <td><small>{{ $p->animation_duration_ms }}ms</small></td>
                            <td>{{ $p->sort_order }}</td>
                            <td>
                                <a href="{{ route('admin.blog-posts.edit', $p) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.blog-posts.destroy', $p) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Hapus post ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted">Belum ada post.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
