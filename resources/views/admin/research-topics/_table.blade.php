<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead class="thead-light">
                    <tr>
                        <th style="width: 60px;">#</th>
                        <th>Judul</th>
                        <th>Section</th>
                        <th>Icon</th>
                        <th>Gambar</th>
                        <th>Delay</th>
                        <th>Sort</th>
                        <th>Status</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($topics as $i => $t)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>
                                <div class="font-weight-bold">{{ $t->title }}</div>
                                <small class="text-muted">/{{ $t->slug }}</small>
                                @if($t->description)
                                    <div><small class="text-muted">{{ Str::limit($t->description, 80) }}</small></div>
                                @endif
                            </td>
                            <td>{{ optional($t->section)->title }} <small
                                    class="text-muted">({{ optional($t->section)->slug }})</small></td>
                            <td>
                                @if($t->icon_class)
                                    <span class="{{ $t->icon_class }}"></span>
                                    <small class="d-block text-muted">{{ $t->icon_class }}</small>
                                @endif
                            </td>
                            <td>
                                @if($t->image_path)
                                    <img src="{{ asset($t->image_path) }}" alt="" style="height:40px;">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $t->animation_delay_ms }}ms</td>
                            <td>{{ $t->sort_order }}</td>
                            <td>
                                @if($t->is_active)
                                    <span class="badge badge-success">Aktif</span>
                                @else
                                    <span class="badge badge-secondary">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.research-topics.edit', $t) }}"
                                    class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.research-topics.destroy', $t) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Hapus topik ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted">Belum ada data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
