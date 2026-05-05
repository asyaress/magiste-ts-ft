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
                    <h1 class="m-0">Keamanan Akun</h1>
                    <a href="{{ route('admin.2fa.setup') }}" class="btn btn-primary">
                        + Tambah Device Authenticator
                    </a>
                </div>

                <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Nama Device</th>
                                        <th>Terakhir Dipakai</th>
                                        <th>Dibuat</th>
                                        <th style="width: 130px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($devices as $device)
                                        <tr>
                                            <td>{{ $device->device_name }}</td>
                                            <td>{{ optional($device->last_used_at)->format('d M Y H:i') ?? '-' }}</td>
                                            <td>{{ optional($device->created_at)->format('d M Y H:i') }}</td>
                                            <td>
                                                <form action="{{ route('admin.security.devices.destroy', $device) }}" method="POST"
                                                    onsubmit="return confirm('Hapus device ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">Belum ada device authenticator.</td>
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
@endsection

