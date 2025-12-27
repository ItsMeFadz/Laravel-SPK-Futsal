@extends('admin.layouts.main')
@section('content')
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tambah Data</h5>
            </div>
            <div class="card-body">
                <form action="/kriteria/update/{{ $kriteria->id }}" enctype="multipart/form-data" method="post">
                    @csrf
                    @method('POST')
                    <div class="row mb-2">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-company">Kode Kriteria</label>
                            <input type="text" class="form-control" placeholder="K01" name="kode"
                                value="{{ $kriteria->kode }}" required />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-fullname">Nama Kriteria</label>
                            <input type="text" class="form-control" placeholder="Refleks" name="name"
                                value="{{ $kriteria->name }}" required />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-fullname">Atribut</label>
                            <select class="form-select" name="atribut" aria-label="Default select example">
                                <option selected disabled>Open this select menu</option>
                                <option value="1" @selected($kriteria->atribut === 1)>01. Benefit</option>
                                <option value="2" @selected($kriteria->atribut === 2)>02. Cost</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Kirim</button>
                    <a href="/kriteria" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
