@extends('admin.layouts.main')
@section('content')
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Tambah Data</h5>
            </div>
            <div class="card-body">
                <form action="/pemain/update/{{ $pemain->id }}" enctype="multipart/form-data" method="post">
                    @csrf
                    @method('POST')
                    <div class="row mb-2">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-company">Kode Pemain</label>
                            <input type="text" class="form-control" placeholder="P01" name="kode_pemain" value="{{$pemain->kode_pemain}}" required />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-fullname">Nama Lengkap</label>
                            <input type="text" class="form-control" placeholder="Alex Anwar" name="name" value="{{$pemain->name}}" required />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-company">Jenis Kelamin</label>
                            <div class="form-check mt-1">
                                <input name="jk" class="form-check-input" type="radio" value="1"
                                    id="defaultRadio1" {{ old('jk', $pemain->jk ?? '') == '1' ? 'checked' : '' }} checked required />
                                <label class="form-check-label" for="defaultRadio1">Laki - Laki</label>
                            </div>
                            <div class="form-check">
                                <input name="jk" class="form-check-input" type="radio" {{ old('jk', $pemain->jk ?? '') == '2' ? 'checked' : '' }} value="2" />
                                <label class="form-check-label" for="defaultRadio2"> Perempuan </label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-fullname">Kelas</label>
                            <input type="text" class="form-control" placeholder="XII TKJ 5" name="kelas" value="{{$pemain->kelas}}" required />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-company">Umur</label>
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" name="umur" placeholder="xx"
                                    aria-label="john.doe" aria-describedby="basic-default-email2" value="{{$pemain->umur}}" required />
                                <span class="input-group-text" id="basic-default-email2">Tahun</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="basic-default-fullname">Posisi</label>
                            <select class="form-select" name="posisi" aria-label="Default select example">
                                <option selected disabled>Open this select menu</option>
                                <option value="1" @selected($pemain->posisi === 1)>GK</option>
                                <option value="2" @selected($pemain->posisi === 2)>Anchor</option>
                                <option value="3" @selected($pemain->posisi === 3)>Flank Kanan</option>
                                <option value="4" @selected($pemain->posisi === 4)>Flank Kiri</option>
                                <option value="5" @selected($pemain->posisi === 5)>Pivot</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="basic-default-fullname">Foto</label>
                            <input type="file" class="form-control" name="image" />
                            <div class="form-text"></div>
                        </div>
                    </div>
                    <a href="/pemain" class="btn btn-secondary me-3">Kembali</a>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </form>
            </div>
        </div>
    </div>
@endsection