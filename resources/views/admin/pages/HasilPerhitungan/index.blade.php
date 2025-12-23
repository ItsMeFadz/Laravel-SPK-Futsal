@extends('admin.layouts.main')

@section('content')
    @include('component.SweetAlert')
    <div class="card">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="card-header">Hasil Rekomendasi Line Up</h6>
            <div class="btn-group me-3">
                <button type="button" class="btn d-flex align-items-center btn-primary"><i class="bx bxs-file-import fs-5 me-1"></i>Unduh</button>
                <button
                type="button"
                class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                id="dropdownMenuReference"
                data-bs-toggle="dropdown"
                aria-expanded="false"
                data-bs-reference="parent">
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
