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

                <div class="card">
                    <div class="card-body">
                        <h3 class="mb-2">{{ $isInitialSetup ? 'Setup Google Authenticator' : 'Tambah Device Authenticator' }}</h3>
                        <p class="text-muted mb-4">
                            {{ $isInitialSetup ? 'Sebelum masuk dashboard admin, Anda wajib aktivasi 2FA.' : 'Tambahkan device baru agar akun bisa dipakai di lebih dari satu perangkat.' }}
                        </p>

                        <div class="row">
                            <div class="col-md-4 mb-3 text-center">
                                <div class="border rounded p-2 bg-white d-inline-block">
                                    {!! $qrCodeSvg !!}
                                </div>
                            </div>
                            <div class="col-md-8">
                                <ol class="pl-3">
                                    <li>Install aplikasi Google Authenticator / Microsoft Authenticator.</li>
                                    <li>Scan QR di samping.</li>
                                    <li>Masukkan kode 6 digit dari aplikasi untuk konfirmasi.</li>
                                </ol>

                                <div class="alert alert-light border mt-3">
                                    <div><strong>Issuer:</strong> {{ $issuer }}</div>
                                    <div><strong>Akun:</strong> {{ $accountName }}</div>
                                    <div><strong>Secret Key:</strong> <code>{{ $secret }}</code></div>
                                    <small class="text-muted">Jika kamera bermasalah, pakai secret key manual.</small>
                                </div>

                                <form action="{{ route('admin.2fa.setup.store') }}" method="POST" class="mt-4">
                                    @csrf
                                    <div class="form-group">
                                        <label>Nama Device</label>
                                        <input type="text" name="device_name" class="form-control" required
                                            placeholder="Contoh: Pixel 8 - Pribadi" value="{{ old('device_name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Kode Authenticator</label>
                                        <input type="text" name="code" class="form-control" required maxlength="6" pattern="\d{6}"
                                            placeholder="6 digit kode">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Aktifkan Device</button>
                                    <a href="{{ route('admin.2fa.setup', ['refresh' => 1]) }}" class="btn btn-outline-secondary ml-2">Refresh QR</a>
                                    @unless($isInitialSetup)
                                        <a href="{{ route('admin.security.index') }}" class="btn btn-link">Kembali</a>
                                    @endunless
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
