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
                        // tampilkan data pemain
                        const p = res.pemain;
                        const jkText = p.jk == 1 ? 'Laki-laki'
                            : p.jk == 2 ? 'Perempuan'
                                : '-';
                        document.getElementById("kodePemain").textContent = p.kode_pemain;
                        document.getElementById("namaPemain").textContent = p.name;
                        document.getElementById("kelasPemain").textContent = p.kelas;
                        document.getElementById("umurPemain").textContent = p.umur;
                        document.getElementById("jkPemain").textContent = jkText;
                        document.getElementById("posisiPemain").textContent = p.posisi?.name ?? '-';


                        // ambil labels dari dataset pertama (asumsi semua dataset punya kriteria sama)
                        // const labels = res.datasets[0]?.data.map(i => i.kode) ?? [];
                        const labels = res.kriteria.map(k => k.name);

                        const colors = [
                            "rgba(75,192,192,1)",
                            "rgba(246, 48, 73, 1)",
                            "rgba(43, 52, 103,1)",
                        ];

                        const chartDatasets = res.datasets
                            .slice() // buat salinan supaya tidak mengubah array asli
                            .reverse() // balik urutan, latihan terbaru jadi terakhir → digambar di atas
                            .map((d, i) => ({
                                label: d.name,
                                data: res.kriteria.map(k => {
                                    const found = d.data.find(x => x.name === k.name);
                                    return found ? found.nilai : 0;
                                }),
                                fill: i === 0, // fill untuk latihan terbaru sekarang di awal array
                                borderDash: i !== 0 ? [5, 5] : [], // garis putus-putus untuk latihan sebelumnya
                                borderColor: colors[i % colors.length],
                                backgroundColor: colors[i % colors.length].replace("1)", "0.3)")
                            }));



                        initChart(labels, chartDatasets);
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
                        <div class="row div1 align-items-center">
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
                            <div class="table-responsive text-nowrap">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr class="table-dark fw-bold text-center">
                                            <td>Informasi</td>
                                            <td>Data</td>
                                        </tr>
                                    </thead>
                                    <colgroup>
                                        <col style="width: 50%">
                                        <col style="width: 50%">
                                    </colgroup>
                                    <tbody>
                                        <tr>
                                            <td class="table-dark">Kode Pemain</td>
                                            <td>: <span id="kodePemain"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="table-dark">Nama Pemain</td>
                                            <td>: <span id="namaPemain"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="table-dark">Kelas</td>
                                            <td>: <span id="kelasPemain"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="table-dark">Umur</td>
                                            <td>: <span id="umurPemain"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="table-dark">Jenis Kelamin</td>
                                            <td>: <span id="jkPemain"></span></td>
                                        </tr>
                                        <tr>
                                            <td class="table-dark">Posisi</td>
                                            <td>: <span id="posisiPemain"></span></td>
                                        </tr>
                                    </tbody>
                                </table>
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