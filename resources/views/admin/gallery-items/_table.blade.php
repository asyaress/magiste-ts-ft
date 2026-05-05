<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead class="thead-light">
                    <tr>
                        <th style="width:60px;">#</th>
                        <th>Gambar</th>
                        <th>Judul & Slug</th>
                        <th>Kategori</th>
                        <th>Section</th>
                        <th>Urutan</th>
                        <th>Status</th>
                        <th style="width:150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $i => $it)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>
                                @if($it->image_path)
                                    <img src="{{ asset($it->image_path) }}" alt="" style="height:40px;">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <div class="font-weight-bold">{{ $it->title }}</div>
                                <small class="text-muted">/{{ $it->slug }}</small>
                            </td>
                            <td>{{ $it->category_label ?: '-' }}</td>
                            <td>
                                {{ optional($it->section)->title }}
                                <small class="text-muted d-block">({{ optional($it->section)->slug }})</small>
                            </td>
                            <td>{{ $it->sort_order }}</td>
                            <td>
                                @if($it->is_active)
                                    <span class="badge badge-success">Aktif</span>
                                @else
                                    <span class="badge badge-secondary">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.gallery-items.edit', $it) }}"
                                    class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.gallery-items.destroy', $it) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Hapus item ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">Belum ada data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
