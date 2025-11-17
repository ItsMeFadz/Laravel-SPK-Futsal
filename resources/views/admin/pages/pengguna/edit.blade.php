@extends('admin.layouts.main')
@section('content')

    <div class="card mb-4">
        <h5 class="card-header">Profile Details</h5>
        <!-- Account -->
        <form action="/pengguna/update/{{ $pengguna->id }}" enctype="multipart/form-data" method="post">
            @csrf
            @method('POST')
            <div class="card-body">
                <div class="d-flex align-items-start align-items-sm-center gap-4">
                    <img src="{{ isset($users) && $users->image ? asset('storage/' . $users->image) : asset('assets/img/avatars/1.png') }}"
                        alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                    <div class="button-wrapper">
                        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                            <span class="d-none d-sm-block">Upload new photo</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input type="file" id="upload" class="account-file-input" hidden
                                accept="image/png, image/jpeg" name="image" />
                        </label>
                        <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                            <i class="bx bx-reset d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Reset</span>
                        </button>

                        <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                    </div>
                </div>
            </div>
            <hr class="my-0" />
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="basic-default-fullname">Username</label>
                        <input type="text" class="form-control" placeholder="Alex Anwar" name="username"
                            value="{{ $pengguna->username }}" required />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="basic-default-fullname">Nama Lengkap</label>
                        <input type="text" class="form-control" placeholder="Alex Anwar" name="name"
                            value="{{ $pengguna->name }}" required />
                    </div>
                    <div class="mb-3 col-md-6 form-password-toggle">
                        <div class="d-flex justify-content-between">
                            <label class="form-label" for="password">Password</label>
                        </div>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password" class="form-control" name="password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password"/>
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="basic-default-fullname">Role</label>
                        <select class="form-select" name="role" aria-label="Default select example">
                            <option selected disabled>Select this role</option>
                            <option value="1" @selected($pengguna->role === 1)>Admin</option>
                            <option value="2" @selected($pengguna->role === 2)>User</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-6 form-password-toggle">
                        <div class="d-flex justify-content-between">
                            <label class="form-label" for="password">Konfirmasi Password</label>
                        </div>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password" class="form-control" name="password_confirmation"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password"/>
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                    </div>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                    <a href="/pengguna" class="btn btn-outline-secondary me-3">Kembali</a>
                </div>
            </div>
        </form>
    </div>
@endsection
