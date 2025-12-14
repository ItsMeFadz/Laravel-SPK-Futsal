@extends('admin.layouts.main')
@section('content')
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit Data</h5>
            </div>
            <form action="/posisi/update/{{ $posisi->id }}" enctype="multipart/form-data" method="post">
                <div class="card-body">
                    @csrf
                    @method('POST')
                    <div class="row mb-2">
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="basic-default-company">Posisi</label>
                            <input type="text" class="form-control" placeholder="P01" name="name"
                                value="{{ $posisi->name }}" required />
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
                                        class="form-control" value="{{ $pivot[$k->id]->bobot ?? '' }}" required>
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
