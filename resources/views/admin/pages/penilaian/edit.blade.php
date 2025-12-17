@extends('admin.layouts.main')
@section('content')
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit Data</h5>
            </div>
            <form action="/penilaian/update/{{ $penilaian->id }}" enctype="multipart/form-data" method="post">
                <div class="card-body">
                    @csrf
                    @method('POST')
                    <div class="row mb-2">
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="basic-default-company">Kode Pemain</label>
                            <input type="text" class="form-control"
                                value="{{ $penilaian->pemain->kode_pemain }}" required disabled/>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="basic-default-company">Nama Pemain</label>
                            <input type="text" class="form-control"
                                value="{{ $penilaian->pemain->name }}" required disabled/>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="basic-default-company">Posisi</label>
                            <input type="text" class="form-control" 
                               value="{{ $penilaian->pemain->posisi->name }}" disabled>
                        </div>
                    </div>
                </div>
                <hr class="my-0" />
                <div class="card-header d-flex justify-content-between">
                    <h5 class="mb-0">Daftar Kriteria</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        @foreach ($kriteria as $k)
                            <div class="col-md-4 mb-3">
                                <div class="mb-2">
                                    <label class="form-label" for="basic-default-company"><span class="badge bg-info">{{ $k->kode }}</span>
                                         - {{ $k->name }}</label>
                                    <input type="number" name="bobot[{{ $k->id }}]" step="0.01"
                                        class="form-control" placeholder="Masukkan bobot" value="{{ $pivot[$k->id]->bobot ?? '' }}" required>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Kirim</button>
                    <a href="/penilaian" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection
