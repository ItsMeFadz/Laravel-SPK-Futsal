@extends('admin.layouts.main')

@section('page-script')
    <script src="{{ asset('assets/js/restrict-date.js') }}"></script>
@endsection

@section('content')
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between">
                <h5 class="mb-0">Informasi Latihan</h5>
            </div>
            <form action="{{ route('store.latihan') }}" enctype="multipart/form-data" method="post">
                <div class="card-body">
                    @csrf
                    @method('POST')
                    <div class="row mb-2">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-company">Tanggal</label>
                            <input type="date" class="form-control restrict-date" placeholder="dd/mm/yy" name="tanggal"
                                value="{{ old(key: 'name') }}" required />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-company">Nama Latihan</label>
                            <input type="text" class="form-control" placeholder="Latihan 1" name="name"
                                value="{{ old(key: 'date') }}" required />
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Kirim</button>
                    <a href="/latihan" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection
