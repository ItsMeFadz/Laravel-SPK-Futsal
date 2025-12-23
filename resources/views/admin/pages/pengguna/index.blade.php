@extends('admin.layouts.main')
@section('page-script')
    <script src="{{ asset('assets/js/pagenation.js') }}"></script>
@endsection

@section('content')
    @include('component.SweetAlert')
    <div class="card">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-header">Daftar Pengguna</h5>
            <a href="{{ route('create.pengguna') }}">
                <button type="button" class="btn btn-primary me-3">Tambah Data</button>
            </a>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama pengguna</th>
                        <th>Username</th>
                        <th>role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0" id="userTableBody">
                    @foreach ($pengguna as $item)
                        <tr style="display: {{ $loop->index < 10 ? '' : 'none' }};">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->username }}</td>
                            <td class="text-sm">
                                @php
                                    $role = (int) ($item->role ?? 0);

                                    // Mapping integer role ke nama role
                                    $roleNames = [
                                        1 => 'Admin',
                                        2 => 'Pelatih',
                                    ];

                                    $badgeClass = match ($role) {
                                        1 => 'bg-primary',
                                        2 => 'bg-secondary',
                                    };

                                    $roleName = $roleNames[$role] ?? 'Tidak Diketahui';
                                @endphp
                                <span class="badge {{ $badgeClass }} me-1">{{ $roleName }}</span>
                            </td>
                            <td style="vertical-align: middle;">
                                <div class="d-flex gap-2 align-items-center">

                                    <a href="/pengguna/edit/{{ $item->id }}" class="d-inline-flex align-items-center">
                                        <button type="button" class="btn btn-xs btn-outline-primary" title="Edit">
                                            <i class='bx bx-pencil'></i>
                                        </button>
                                    </a>

                                    <form class="d-inline-flex align-items-center m-0" id="deleteForm{{ $item->id }}"
                                        action="/pengguna/delete/{{ $item->id }}" method="POST">
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
