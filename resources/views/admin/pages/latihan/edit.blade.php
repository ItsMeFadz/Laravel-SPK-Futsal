@extends('admin.layouts.main')
@section('content')
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit Data</h5>
            </div>
            <form action="/latihan/update/{{ $latihan->id }}" enctype="multipart/form-data" method="post">
                <div class="card-body">
                    @csrf
                    @method('POST')
                    <div class="row mb-2">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-company">Tanggal</label>
                            <input type="date" class="form-control" placeholder="dd/mm/yy" name="tanggal"
                                value="{{ $latihan->tanggal }}" required />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-company">Nama Latihan</label>
                            <input type="text" class="form-control" placeholder="Latihan 1" name="name"
                                value="{{ $latihan->name }}" required />
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Kirim</button>
                    <a href="/latihan" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection
