@extends('admin.layouts.main')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css')}}" />
@endsection

@section('page-script')
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas2svg@1.0.16/canvas2svg.min.js"></script>
    <script src="{{ asset('assets/js/chart-pemain.js')}}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            document.getElementById("btnCari").addEventListener("click", function () {
                const pemainId = document.getElementById("selectPemain").value;
                if (!pemainId) return alert("Pilih pemain terlebih dahulu");

                fetch(`/chart/pemain/${pemainId}`)
                    .then(res => res.json())
                    .then(res => {

                        document.querySelector(".div3 ul").innerHTML = `
                        <ul>${res.pemain.kode_pemain}</ul>
                        <ul>${res.pemain.name}</ul>
                        <ul>${res.pemain.kelas}</ul>
                        <ul>${res.pemain.umur}</ul>
                        <ul>${res.pemain.jk}</ul>
                        <ul>${res.pemain.posisi.name}</ul>
                    `;

                        initChart(
                            res.latest.map(i => i.kode),
                            res.latest.map(i => i.nilai),
                            res.old.map(i => i.nilai),
                            res.latest_name, // ← dari tabel latihan (field name)
                            res.old_name
                        );
                    });
            });

            document.getElementById("selectPosisi").addEventListener("change", function () {
                fetch(`/get-pemain-by-posisi/${this.value}`)
                    .then(res => res.json())
                    .then(data => {
                        const select = document.getElementById("selectPemain");
                        select.innerHTML = `<option disabled selected>Pilih Pemain</option>`;
                        data.forEach(p => {
                            select.innerHTML += `<option value="${p.id}">${p.name}</option>`;
                        });
                        select.disabled = false;
                    });
            });

        });
    </script>
@endsection

@section('content')
    @include('component.SweetAlert')
    <div class="alert alert-dark alert-dismissible mb-4" role="alert">
        <i class="tf-icons bx bx-bell me-1"></i>Data perhitungan yang digunakan adalah data latihan terbaru!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <div class="col-md-6 col-lg-12 order-1 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <ul class="nav nav-pills d-flex align-items-center" role="tablist">
                    <li class="nav-item">
                        <h7 class="fw-semibold">Lihat Perkembangan Pemain</h7>
                    </li>
                    <li class="nav-item mx-3">
                        <div class="dropdown">
                            <button class="btn btn-sm-sm btn-info" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i
                                    class='bx bxs-chevrons-down fs-7'></i>
                            </button>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="collapse" id="collapseExample">
                    <div class="parent">
                        <div class="row div1">
                            <div class="col-md-4">
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class="bx bxs-direction-right"></i></span>
                                    <!-- ROLE / POSISI -->
                                    <select class="form-select form-select-sm" id="selectPosisi">
                                        <option disabled selected>Pilih Posisi</option>
                                        @foreach ($posisi as $p)
                                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class="bx bx-user"></i></span>
                                    <!-- PEMAIN -->
                                    <select class="form-select form-select-sm" id="selectPemain" disabled>
                                        <option disabled selected>Pilih Pemain</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="button" id="btnCari" class="btn btn-sm btn-rounded-pill btn-info">
                                    <i class="tf-icons bx bx-search-alt fs-7"></i> Cari
                                </button>
                            </div>
                        </div>
                        <div class="div2">
                            <div class="col-md-12">
                                <li>
                                    <ul>Kode Pemain :</ul>
                                    <ul>Nama Pemain :</ul>
                                    <ul>Kelas :</ul>
                                    <ul>Umur :</ul>
                                    <ul>Jenis Kelamin :</ul>
                                    <ul>Posisi :</ul>
                                </li>
                            </div>
                        </div>
                        <div class="div3">
                            <div class="col-md-12">
                                <li>
                                    <ul>disini datanya</ul>
                                </li>
                            </div>
                        </div>
                        <div class="div4">
                            <div class="tab-content p-0">
                                <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
                                    <div class="chartContainer" style="height:400px;">
                                        <canvas id="radarCanvas"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="d-flex justify-content-between align-items-center">
            <ul class="nav nav-pills d-flex align-items-center" role="tablist">
                <h6 class="card-header">Rangking Seluruh Pemain</h6>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr class="table-dark fw-bold text-center">
                        <td>Kode Pemain</td>
                        <td>Nama Pemain</td>
                        <td>Posisi</td>
                        <td>Preferensi (Vi)</td>
                        <td>Rangking</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ranking as $r)
                        <tr>
                            <td>{{ $r['pemain']->kode_pemain }}</td>
                            <td>{{ $r['pemain']->name }}</td>
                            <td>{{ $r['pemain']->posisi->name }}</td>
                            <td class="text-center">
                                {{ number_format($r['nilai'], 4) }}
                            </td>
                            <td class="text-center">{{ $r['rank'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card mt-4">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="card-header">Hasil Rekomendasi Line Up</h6>
            <div class="btn-group me-3">
                <button type="button" class="btn d-flex align-items-center btn-primary"><i
                        class="bx bxs-file-import fs-5 me-1"></i>Unduh</button>
                <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                    id="dropdownMenuReference" data-bs-toggle="dropdown" aria-expanded="false" data-bs-reference="parent">
                    <span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                    <li><a class="dropdown-item" href={{ route('hasil.export.pdf') }}>PDF</a></li>
                    <li><a class="dropdown-item" href={{ route('hasil.export.excel') }}>Excel</a></li>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr class="table-dark fw-bold text-center">
                        <td>Kode Pemain</td>
                        <td>Nama Pemain</td>
                        <td>Posisi</td>
                        <td>Preferensi (Vi)</td>
                        <td>Rangking</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lineUp as $item)
                        <tr>
                            <td class="text-center">{{ $item['pemain']->kode_pemain }}</td>
                            <td>{{ $item['pemain']->name }}</td>
                            <td>{{ $item['pemain']->posisi->name }}</td>
                            <td class="text-center">
                                {{ number_format($item['nilai'], 4) }}
                            </td>
                            <td class="text-center">{{ $item['rank'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection