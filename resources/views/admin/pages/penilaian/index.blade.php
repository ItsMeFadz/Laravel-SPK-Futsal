@extends('admin.layouts.main')
@section('page-script')
    <script src="{{ asset('assets/js/pagenation.js') }}"></script>
@endsection

@section('content')
    @include('component.SweetAlert')
    <div class="col-xl-12">
        <div class="nav-align-top mb-4">
            <ul class="nav nav-tabs nav-fill" role="tablist">
                @foreach ($latihan as $index => $l)
                    <li class="nav-item">
                        <button type="button" class="nav-link {{ $index == 0 ? 'active' : '' }}" role="tab"
                            data-bs-toggle="tab" data-bs-target="#latihan-{{ $l->id }}"
                            aria-controls="latihan-{{ $l->id }}"
                            aria-selected="{{ $index == 0 ? 'true' : 'false' }}">
                            <i class="tf-icons bx bx-message-square"></i> {{ $l->name }}
                        </button>
                    </li>
                @endforeach
            </ul>
            <div class="tab-content">
                @foreach ($latihan as $index => $l)
                    <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}" id="latihan-{{ $l->id }}"
                        role="tabpanel">

                        <div class="table-responsive text-nowrap">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kode</th>
                                        <th>Pemain</th>
                                        <th>Posisi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataLatihan[$l->id] as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->pemain->kode_pemain }}</td>
                                            <td>{{ $item->pemain->name }}</td>
                                            <td>{{ $item->pemain->posisi->name }}</td>
                                            <td>
                                                <a href="/penilaian/edit/{{ $item->id }}"
                                                    class="btn btn-sm btn-outline-primary">Edit</a>
                                                <form action="/penilaian/delete/{{ $l->id }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm btn-outline-danger">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
