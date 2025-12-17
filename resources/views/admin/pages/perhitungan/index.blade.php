@extends('admin.layouts.main')

@section('content')
    @include('component.SweetAlert')
    <div class="alert alert-dark alert-dismissible mb-4" role="alert">
        <i class="tf-icons bx bx-bell me-1"></i>Data perhitungan yang digunakan adalah data latihan terbaru!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <div class="card">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="card-header">Matrix X</h6>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr class="table-dark fw-bold text-center">
                        <td>Alternatif</td>
                        @foreach ($kriteria as $k)
                            <td>{{ $k->kode }}</td>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pemain as $p)
                        <tr class="text-center">
                            <td class="table-dark fw-bold">{{ $p->kode_pemain }}</td>
                            @foreach ($kriteria as $k)
                                <td>{{ number_format($matrixX[$p->id][$k->id]) }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card mt-4">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="card-header">Ternormalisasi R</h6>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-bordered table-sm text-center">
                <tr class="table-dark fw-bold">
                    <td>Pembagi</td>
                    @foreach ($kriteria as $k)
                        <td>{{ number_format($pembagi[$k->id], 3) }}</td>
                    @endforeach
                </tr>

                @foreach ($pemain as $index => $p)
                    <tr>
                        @if ($index == 0)
                            <td rowspan="{{ count($pemain) }}" class="table-dark fw-bold align-middle">
                                R
                            </td>
                        @endif

                        @foreach ($kriteria as $k)
                            <td>{{ number_format($matrixR[$p->id][$k->id], 4) }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </table>

        </div>
    </div>

    <div class="card mt-4">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="card-header">Ternormalisasi Y</h6>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr class="table-dark fw-bold text-center">
                        <td>Pembagi</td>
                        @foreach ($kriteria as $k)
                            <td>{{ $k->kode }}</td>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pemain as $index => $p)
                        <tr>
                            @if ($index == 0)
                                <td rowspan="{{ count($pemain) }}" class="table-dark fw-bold text-center">Y</td>
                            @endif
                            @foreach ($kriteria as $k)
                                <td>{{ number_format($matrixY[$p->id][$k->id], 4) }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card mt-4">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="card-header">Solusi Ideal Positif (A+) dan Solusi Ideal Negatif (A-)</h6>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-bordered table-sm">
                <thead>
                </thead>
                <tbody>
                    <tr>
                        <td class="table-dark fw-bold text-center">A⁺</td>
                        @foreach ($kriteria as $k)
                            <td>{{ number_format($Aplus[$k->id], 4) }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td class="table-dark fw-bold text-center">A⁻</td>
                        @foreach ($kriteria as $k)
                            <td>{{ number_format($Amin[$k->id], 4) }}</td>
                        @endforeach
                    </tr>
                </tbody>

            </table>
        </div>
    </div>
    <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mt-4">
        <div class="card">
            <div class="row row-bordered g-0">
                <div class="col-md-6">
                    <h6 class="card-header m-0 me-2 pb-3">Jarak Solusi Ideal Positif (D+) dan Solusi Ideal Negatif (D-).
                    </h6>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered table-sm">
                            <thead>
                            </thead>
                            <tbody>
                                @foreach ($pemain as $p)
                                    <tr>
                                        <td class="table-dark fw-bold">D+</td>
                                        <td>{{ number_format($Dplus[$p->id], 4) }}</td>
                                        <td class="table-dark fw-bold">D-</td>
                                        <td>{{ number_format($Dmin[$p->id], 4) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <h6 class="card-header m-0 me-2 pb-3">Nilai Preferensi
                    </h6>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered table-sm">
                            <thead>
                            </thead>
                            <tbody>
                                @foreach ($pemain as $p)
                                    <tr>
                                        <td class="table-dark fw-bold">V{{ $loop->iteration }}</td>
                                        <td colspan="{{ count($kriteria) }}">{{ number_format($preferensi[$p->id], 3) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-4">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="card-header">Perangkingan</h6>
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
