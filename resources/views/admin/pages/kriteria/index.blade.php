@extends('admin.layouts.main')
@section('page-script')
    <script src="{{ asset('assets/js/pagenation.js') }}"></script>
@endsection

@section('content')
    @include('component.SweetAlert')
    <div class="card">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-header">Daftar Kriteria</h5>
            <a href="{{ route('create.kriteria') }}">
                <button type="button" class="btn btn-primary me-3">Tambah Data</button>
            </a>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode</th>
                        <th>Nama kriteria</th>
                        <th>Bobot</th>
                        <th>Atribut</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0" id="userTableBody">
                    @foreach ($kriteria as $item)
                        <tr style="display: {{ $loop->index < 10 ? '' : 'none' }};">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->kode }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->bobot }}</td>
                            <td class="text-sm">
                                @php
                                    $atribut = (int) ($item->atribut ?? 0);

                                    // Mapping integer atribut ke nama atribut
                                    $atributNames = [
                                        1 => 'BENEFIT',
                                        2 => 'COST',
                                    ];

                                    $badgeClass = match ($atribut) {
                                        1 => 'bg-success',
                                        2 => 'bg-danger',
                                    };

                                    $atributName = $atributNames[$atribut] ?? 'Tidak Diketahui';
                                @endphp
                                <span class="badge {{ $badgeClass }} me-1">{{ $atributName }}</span>
                            </td>
                            <td style="vertical-align: middle;">
                                <div class="d-flex gap-2 align-items-center">

                                    <a href="/kriteria/edit/{{ $item->id }}" class="d-inline-flex align-items-center">
                                        <button type="button" class="btn btn-xs btn-outline-primary" title="Edit">
                                            <i class='bx bx-pencil'></i>
                                        </button>
                                    </a>

                                    <form class="d-inline-flex align-items-center m-0" id="deleteForm{{ $item->id }}"
                                        action="/kriteria/delete/{{ $item->id }}" method="POST">
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
            <div class="demo-inline-spacing mx-2">
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-sm justify-content-end" id="pagination">
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection
