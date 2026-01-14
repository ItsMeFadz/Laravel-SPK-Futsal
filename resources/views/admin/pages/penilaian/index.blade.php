@extends('admin.layouts.main')
@section('page-script')
    <script src="{{ asset('assets/js/pagenation.js') }}"></script>
    <script>
        document.querySelectorAll('.btn-detail').forEach(btn => {
            btn.addEventListener('click', function () {

                fetch(`/penilaian/detail/${this.dataset.id}`)
                    .then(res => res.json())
                    .then(data => {

                        // Nama & posisi
                        document.getElementById('modalNama').value = data.pemain.name;
                        document.getElementById('modalPosisi').value = data.pemain.posisi;

                        // IMAGE PEMAIN
                        const img = document.getElementById('modalImage');

                        if (data.pemain.image) {
                            img.src = `/storage/${data.pemain.image}`;
                        } else {
                            img.src = `/assets/img/default-user.png`; // fallback
                        }

                        // Bobot
                        let html = '';
                        data.kriteria.forEach(k => {
                            const nilai = data.bobot[k.id]?.bobot ?? 0;
                            html += `
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">
                                        <span class="badge bg-info">${k.kode}</span>
                                    </label>
                                    <input type="text" class="form-control" style="background: white" value="${nilai}" disabled>
                                </div>
                            `;
                        });

                        document.getElementById('modalBobot').innerHTML = html;
                    });
            });
        });
    </script>
    <script>
        document.querySelectorAll('.btn-status').forEach(btn => {
            btn.addEventListener('click', function () {
                document.getElementById('detailLatihanId').value = this.dataset.id;
                document.getElementById('nameBasic').value = this.dataset.nama;
                document.getElementById('statusPemain').value = this.dataset.status;
            });
        });

        document.querySelector('#basicModal .btn-primary').addEventListener('click', function () {

            fetch('/penilaian/status-pemain/update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    detail_latihan_id: document.getElementById('detailLatihanId').value,
                    status_pemain: document.getElementById('statusPemain').value
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    location.reload(); // refresh biar badge update
                }
            });
        });
    </script>

@endsection

@section('content')
    @include('component.SweetAlert')
    <div class="col-xl-12">
        <div class="nav-align-top mb-4">
            <ul class="nav nav-tabs nav-fill" role="tablist">
                @foreach ($latihan as $index => $l)
                    <li class="nav-item">
                        <button type="button" class="nav-link {{ $index == 0 ? 'active' : '' }}" role="tab" data-bs-toggle="tab"
                            data-bs-target="#latihan-{{ $l->id }}" aria-controls="latihan-{{ $l->id }}"
                            aria-selected="{{ $index == 0 ? 'true' : 'false' }}">
                            <i class="tf-icons bx bx-message-square"></i> {{ $l->name }}
                        </button>
                    </li>
                @endforeach
            </ul>
            <div class="tab-content">
                @foreach ($latihan as $index => $l)
                    <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}" id="latihan-{{ $l->id }}" role="tabpanel">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="mb-0">Input Penilaian via Excel</h6>

                            <div class="d-flex gap-2">
                                <!-- Download -->
                                <a href="{{ url('/penilaian/excel/download/'.$l->id) }}"
                                class="btn btn-sm btn-success">
                                    <i class="bx bx-download"></i> Download Excel
                                </a>

                                <!-- Upload -->
                                <button class="btn btn-sm btn-primary"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#collapseExample"
                                    aria-expanded="false"
                                    aria-controls="collapseExample">
                                    <i class="bx bx-upload"></i> Upload Excel
                                </button>
                            </div>
                        </div>
                        <div class="collapse" id="collapseExample">
                            <form  action="{{ url('/penilaian/excel/upload') }}"
                                method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="latihan_id" value="{{ $l->id }}">

                                <div class="input-group">
                                    <input type="file"
                                        name="file"
                                        class="form-control"
                                        accept=".xlsx,.xls"
                                        required>

                                    <button class="btn btn-primary">
                                        <i class="bx bx-save"></i> Simpan
                                    </button>
                                </div>

                                <small class="text-muted">
                                    *Gunakan file Excel hasil download, jangan ubah struktur kolom.
                                </small>
                            </form>
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kode</th>
                                        <th>Pemain</th>
                                        <th>Posisi</th>
                                        <th class="text-center">Aksi</th>
                                        <th class="text-center">Status Pemain</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataLatihan[$l->id] as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->pemain->kode_pemain }}</td>
                                            <td>{{ $item->pemain->name }}</td>
                                            <td>{{ $item->pemain->posisi->name }}</td>
                                            <td class="text-center">
                                                <a href="/penilaian/edit/{{ $item->id }}" class="btn btn-sm btn-info me-2"
                                                    data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"
                                                    data-bs-html="true" title="Nilai"><i class="bx bx-xs bx-search"></i></a>
                                                <button class="btn btn-sm btn-warning btn-detail me-2" data-id="{{ $item->id }}"
                                                    data-bs-toggle="modal" data-bs-target="#largeModal">
                                                    <i class="bx bx-xs bxs-user-detail"></i>
                                                </button>
                                            </td>
                                            <td class="text-center">
                                                @if ($item->status_pemain == 1)
                                                    <button class="btn btn-sm btn-success btn-status"
                                                        data-id="{{ $item->id }}"
                                                        data-nama="{{ $item->pemain->name }}"
                                                        data-status="1"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#basicModal">
                                                        Sehat
                                                    </button>
                                                @elseif ($item->status_pemain == 2)
                                                    <button class="btn btn-sm btn-warning btn-status"
                                                        data-id="{{ $item->id }}"
                                                        data-nama="{{ $item->pemain->name }}"
                                                        data-status="2"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#basicModal">
                                                        Cidera
                                                    </button>
                                                @elseif ($item->status_pemain == 3)
                                                    <button class="btn btn-sm btn-danger btn-status"
                                                        data-id="{{ $item->id }}"
                                                        data-nama="{{ $item->pemain->name }}"
                                                        data-status="3"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#basicModal">
                                                        Tidak Hadir
                                                    </button>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($item->status == 1)
                                                    <span class="badge badge-center rounded-pill bg-label-danger">
                                                        <i class="bx bx-xs bx-error"></i>
                                                    </span>
                                                @elseif($item->status == 2)
                                                    <span class="badge badge-center rounded-pill bg-label-success">
                                                        <i class="bx bx-xs bx-check-circle"></i></span>
                                                @else
                                                    -
                                                @endif
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

    {{-- Detail Pemain per Latihan --}}
    <div class="modal fade" id="largeModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <div class="photo-wrapper mx-auto">
                                <img id="modalImage" class="img-fluid rounded" width="200">
                            </div>
                            <div class="input-group input-group-merge mt-2">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                        class="bx bx-user"></i></span>
                                <input type="text" class="form-control" id="modalNama" placeholder="John Doe"
                                    aria-label="John Doe" aria-describedby="basic-icon-default-fullname2"
                                    style="background: white" readonly />
                            </div>
                            <div class="input-group input-group-merge mt-2">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                        class="bx bx-run"></i></span>
                                <input type="text" class="form-control" id="modalPosisi" aria-label="John Doe"
                                    aria-describedby="basic-icon-default-fullname2" style="background: white" readonly />
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="photo-wrapper mx-auto">
                                <div class="row" id="modalBobot"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal Status Pemain -->
    <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Status Pemain</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label">Nama Pemain</label>
                            <input type="text" id="nameBasic" class="form-control" style="background:white" readonly>
                            <input type="hidden" id="detailLatihanId">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label">Status Pemain</label>
                            <select class="form-select" id="statusPemain" name="status_pemain">
                                <option value="1">01. Sehat</option>
                                <option value="2">02. Cidera</option>
                                <option value="3">03. Tidak Hadir</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection