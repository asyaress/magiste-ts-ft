<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead class="thead-light">
                    <tr>
                        <th style="width:60px;">#</th>
                        <th>Foto</th>
                        <th>Nama & Slug</th>
                        <th>Tagline</th>
                        <th>Section</th>
                        <th>Links</th>
                        <th>Urutan</th>
                        <th>Status</th>
                        <th style="width:150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($teachers as $i => $t)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>
                                @if($t->photo_path)
                                    <img src="{{ asset($t->photo_path) }}" alt="" style="height:40px;">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <div class="font-weight-bold">{{ $t->name }}</div>
                                <small class="text-muted">/{{ $t->slug }}</small>
                            </td>
                            <td>{{ $t->tagline ?: '-' }}</td>
                            <td>
                                {{ optional($t->section)->title }}
                                <small class="text-muted d-block">({{ optional($t->section)->slug }})</small>
                            </td>
                            <td>
                                @if($t->linkedin_url)
                                    <a href="{{ $t->linkedin_url }}" target="_blank"><i class="fa fa-linkedin"></i></a>
                                @endif
                                @if($t->scholar_url)
                                    <a href="{{ $t->scholar_url }}" target="_blank" class="ml-2"><i
                                            class="fa fa-google"></i></a>
                                @endif
                                @if($t->website_url)
                                    <a href="{{ $t->website_url }}" target="_blank" class="ml-2"><i class="fa fa-globe"></i></a>
                                @endif
                            </td>
                            <td>{{ $t->sort_order }}</td>
                            <td>
                                @if($t->is_active)
                                    <span class="badge badge-success">Aktif</span>
                                @else
                                    <span class="badge badge-secondary">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.teachers.edit', $t) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.teachers.destroy', $t) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Hapus pengajar ini?')">
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
