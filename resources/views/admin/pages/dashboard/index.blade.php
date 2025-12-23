@extends('admin.layouts.main')
@section('content')
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="col-sm-12">
                <div class="card text-center">
                    <div class="card-body">
                        <img src="{{ asset('assets/img/logo/logo-SMA.jpeg') }}" class="align-items-center" height="100" />
                        <h5 class="card-title text-info mt-2">SMA Negeri 1 Dukupuntang</h5>
                        <p>
                            Sistem pendukung keputusan line-up Futsal
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-6 order-1">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-6 mb-4">
                    <div class="card border-2 border-success shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <a href="{{ route('index.kriteria') }}" class="btn bg-label-success rounded me-3">
                                    <i class="bx bx-lg bx-cube-alt fs-4"></i>
                                </a>
                                <div>
                                    <span class="text-muted small">Kriteria</span>
                                    <h3 class="fw-bold mb-0">{{$jumlahKriteria ?? '0'}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-6 mb-4">
                    <div class="card border-2 border-danger shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <a href="{{ route('index.posisi') }}" class="btn bg-label-danger rounded me-3">
                                    <i class="bx bx-lg bxs-direction-right fs-4"></i>
                                </a>
                                <div>
                                    <span class="text-muted small">Posisi</span>
                                    <h3 class="fw-bold mb-0">{{$jumlahPosisi ?? '0'}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-6 mb-4">
                    <div class="card border-2 border-info shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <a href="{{ route('index.pemain') }}" class="btn bg-label-info rounded me-3">
                                    <i class="bx bx-lg bx-user fs-4"></i>
                                </a>
                                <div>
                                    <span class="text-muted small">Pemain</span>
                                    <h3 class="fw-bold mb-0">{{$jumlahPemain ?? '0'}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-6 mb-4">
                    <div class="card border-2 border-primary shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <a href="{{ route('index.latihan') }}" class="btn bg-label-primary rounded me-3">
                                    <i class="bx bx-lg bx-run fs-4"></i>
                                </a>
                                <div>
                                    <span class="text-muted small">Latihan</span>
                                    <h3 class="fw-bold mb-0">{{$jumlahLatihan ?? '0'}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
