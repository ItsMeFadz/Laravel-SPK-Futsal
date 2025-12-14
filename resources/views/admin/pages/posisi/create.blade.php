@extends('admin.layouts.main')
@section('content')
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tambah Data</h5>
            </div>
            <form action="{{ route('store.posisi') }}" enctype="multipart/form-data" method="post">
                <div class="card-body">
                    @csrf
                    @method('POST')
                    <div class="row mb-2">
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="basic-default-company">Posisi</label>
                            <input type="text" class="form-control" placeholder="GK" name="name"
                                value="{{ old('name') }}" required />
                        </div>
                    </div>
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <div class="row mb-2">
                        @foreach ($kriteria as $k)
                            <div class="col-md-4 mb-3">
                                <div class="mb-2">
                                    <label class="form-label" for="basic-default-company">{{ $k->name }}</label>
                                    <input type="number" name="bobot[{{ $k->id }}]" step="0.01"
                                        class="form-control" placeholder="Masukkan bobot" required>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Kirim</button>
                    <a href="/posisi" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection

{{-- @extends('admin.layouts.main')

@section('content')
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Tambah Posisi</h5>
            </div>
            <div class="card-body">

                <form action="{{ route('store.posisi') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Posisi</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    @foreach ($kriteria as $k)
                        <div class="mb-2">
                            <label>{{ $k->name }}</label>
                            <input type="number" name="bobot[{{ $k->id }}]" step="0.01" class="form-control"
                                placeholder="Masukkan bobot" required>
                        </div>
                    @endforeach

                    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                    <a href="/posisi" class="btn btn-secondary mt-3">Kembali</a>
                </form>

            </div>
        </div>
    </div>
@endsection --}}
