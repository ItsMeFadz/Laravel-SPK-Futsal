@extends('admin.layouts.main')
@section('page-script')
    <script src="{{ asset('assets/js/pagenation.js') }}"></script>
@endsection

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
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode</th>
                        <th>Nama Pemain</th>
                        <th>Kelas</th>
                        <th>Umur</th>
                        <th>Posisi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0" id="userTableBody">
                    @foreach ($pemain as $item)
                        <tr style="display: {{ $loop->index < 10 ? '' : 'none' }};">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->kode_pemain }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->kelas }}</td>
                            <td>{{ $item->umur }}</td>
                            <td class="text-sm">
                                @php
                                    $posisiName = $item->posisi->name ?? 'Tidak Diketahui';

                                    $badgeClass = match ($posisiName) {
                                        'GK' => 'bg-primary',
                                        'Anchor' => 'bg-secondary',
                                        'Flank Kanan' => 'bg-info',
                                        'Flank Kiri' => 'bg-warning',
                                        'Pivot' => 'bg-dark',
                                        default => 'bg-dark',
                                    };
                                @endphp

                                <span class="badge {{ $badgeClass }} me-1">{{ $posisiName }}</span>
                            </td>
                            <td style="vertical-align: middle;">
                                <div class="d-flex gap-2 align-items-center">

                                    <a href="/pemain/edit/{{ $item->id }}" class="d-inline-flex align-items-center"  data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                        data-bs-html="true" title="Edit">
                                        <button type="button" class="btn btn-sm btn-outline-primary">
                                            <i class='bx bx-pencil'></i>
                                        </button>
                                    </a>

                                    <form class="d-inline-flex align-items-center m-0" id="deleteForm{{ $item->id }}"
                                        action="/pemain/delete/{{ $item->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-outline-danger"
                                            onclick="confirmDelete({{ $item->id }})" data-bs-toggle="tooltip"
                                            data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="Hapus">
                                            <i class='bx bx-trash'></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="demo-inline-spacing mx-2">
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-sm justify-content-end" id="pagination">
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection
