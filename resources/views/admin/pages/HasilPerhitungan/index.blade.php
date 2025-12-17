@extends('admin.layouts.main')

@section('content')
    @include('component.SweetAlert')
    <div class="card">
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
