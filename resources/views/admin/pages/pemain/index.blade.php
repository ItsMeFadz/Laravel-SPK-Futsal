@extends('admin.layouts.main')
@section('content')
@include('component.SweetAlert')
    <div class="card">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-header">Daftar Pemain</h5>
            <a href="{{ route('create.pemain') }}">
                <button type="button" class="btn btn-primary me-3">Tambah Data</button>
            </a>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pemain</th>
                        <th>Kelas</th>
                        <th>Umur</th>
                        <th>Posisi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($pemain as $item)
                        <tr style="display: {{ $loop->index < 10 ? '' : 'none' }};">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->kelas }}</td>
                            <td>{{ $item->umur }}</td>
                            <td class="text-sm">
                                @php
                                    $posisi = (int) ($item->posisi ?? 0);

                                    // Mapping integer posisi ke nama posisi
                                    $posisiNames = [
                                        1 => 'GK',
                                        2 => 'Anchor',
                                        3 => 'Flank Kanan',
                                        4 => 'Flank Kiri',
                                        5 => 'Pivot',
                                    ];

                                    $badgeClass = match ($posisi) {
                                        1 => 'bg-primary',
                                        2 => 'bg-secondary',
                                        3 => 'bg-info',
                                        4 => 'bg-warning',
                                        5 => 'bg-dark',
                                    };

                                    $posisiName = $posisiNames[$posisi] ?? 'Tidak Diketahui';
                                @endphp
                                <span class="badge {{ $badgeClass }} me-1">{{ $posisiName }}</span>
                            </td>
                            <td style="vertical-align: middle;">
                                <div class="d-flex gap-2 align-items-center">

                                    <a href="/pemain/edit/{{ $item->id }}" class="d-inline-flex align-items-center">
                                        <button type="button" class="btn btn-xs btn-outline-primary" title="Edit">
                                            <i class='bx bx-pencil'></i> 
                                        </button>
                                    </a>

                                    <form class="d-inline-flex align-items-center m-0" id="deleteForm{{ $item->id }}"
                                        action="/pemain/delete/{{ $item->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-xs btn-outline-danger"
                                            onclick="confirmDelete({{ $item->id }})" title="Delete">
                                            <i class='bx bx-trash'></i> 
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
