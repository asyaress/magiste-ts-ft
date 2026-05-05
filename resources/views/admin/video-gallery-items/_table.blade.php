<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead class="thead-light">
                    <tr>
                        <th style="width:60px;">#</th>
                        <th>Judul</th>
                        <th>URL</th>
                        <th>Section</th>
                        <th>Icon</th>
                        <th>Delay</th>
                        <th>Sort</th>
                        <th>Status</th>
                        <th style="width:150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $i => $it)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td class="align-middle">
                                <div class="font-weight-bold">{{ $it->title }}</div>
                            </td>
                            <td class="align-middle">
                                <a href="{{ $it->video_url }}" target="_blank">{{ Str::limit($it->video_url, 40) }}</a>
                            </td>
                            <td class="align-middle">
                                {{ optional($it->section)->title }}
                                <small class="text-muted d-block">({{ optional($it->section)->slug }})</small>
                            </td>
                            <td class="align-middle">
                                <span class="{{ $it->play_icon_class }}"></span>
                                <small class="d-block text-muted">{{ $it->play_icon_class }}</small>
                            </td>
                            <td class="align-middle">{{ $it->animation_delay_ms }}ms</td>
                            <td class="align-middle">{{ $it->sort_order }}</td>
                            <td class="align-middle">
                                @if($it->is_active)
                                    <span class="badge badge-success">Aktif</span>
                                @else
                                    <span class="badge badge-secondary">Nonaktif</span>
                                @endif
                            </td>
                            <td class="align-middle">
                                <a href="{{ route('admin.video-items.edit', $it) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.video-items.destroy', $it) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Hapus video ini?')">
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
