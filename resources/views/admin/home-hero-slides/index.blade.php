@extends('layout/main')

@php
    $pathToUrl = function (?string $p): ?string {
        if (!$p) {
            return null;
        }
        return \Illuminate\Support\Str::startsWith($p, ['http://', 'https://', '/']) ? $p : asset($p);
    };
@endphp

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
                    <h1 class="m-0">Home Hero Slides</h1>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">+ Tambah Slide</button>
                </div>

                <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Preview</th>
                                        <th>Konten</th>
                                        <th>Sort</th>
                                        <th>Status</th>
                                        <th style="width:190px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($slides as $i => $slide)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>
                                                @if($slide->background_image_path)
                                                    <img src="{{ $pathToUrl($slide->background_image_path) }}" alt="" style="height:50px;">
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($slide->kicker)<div><small class="text-muted">{{ $slide->kicker }}</small></div>@endif
                                                <div class="font-weight-bold">{{ $slide->title }}</div>
                                                <small class="text-muted">{{ \Illuminate\Support\Str::limit($slide->description, 100) }}</small>
                                            </td>
                                            <td>{{ $slide->sort_order }}</td>
                                            <td>{!! $slide->is_active ? '<span class="badge badge-success">Aktif</span>' : '<span class="badge badge-secondary">Nonaktif</span>' !!}</td>
                                            <td>
                                                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEdit{{ $slide->id }}">Edit</button>
                                                <form action="{{ route('admin.home-hero-slides.destroy', $slide) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus slide ini?')">
                                                    @csrf @method('DELETE')
                                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>

                                        @push('modals')
                                        <div class="modal fade" id="modalEdit{{ $slide->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <form action="{{ route('admin.home-hero-slides.update', $slide) }}" method="POST" enctype="multipart/form-data" class="modal-content">
                                                    @csrf @method('PUT')
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Slide</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @include('admin.home-hero-slides.partials.form', ['slide' => $slide])
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-primary" type="submit">Simpan</button>
                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        @endpush
                                    @empty
                                        <tr><td colspan="6" class="text-center text-muted">Belum ada slide hero.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="{{ route('admin.home-hero-slides.store') }}" method="POST" enctype="multipart/form-data" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Slide Hero</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    @include('admin.home-hero-slides.partials.form', ['slide' => null])
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
        setTimeout(function () { $(".alert").fadeOut("slow"); }, 3000);
        @if ($errors->any())
            $('#modalTambah').modal('show');
        @endif
    </script>
@endpush
