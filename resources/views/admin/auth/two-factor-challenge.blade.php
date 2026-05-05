@extends('layout/main')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
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

                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="mb-2">Verifikasi 2FA</h3>
                                <p class="text-muted">Masukkan kode 6 digit dari aplikasi authenticator Anda.</p>

                                <form action="{{ route('admin.2fa.challenge.verify') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label>Kode Authenticator</label>
                                        <input type="text" name="code" class="form-control" required maxlength="6" pattern="\d{6}" autofocus
                                            placeholder="6 digit kode">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Verifikasi</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

