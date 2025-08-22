{{-- @dd($user) --}}
@extends("layouts.app")

@section("title")
    SmartSupport &mdash; Edit Pengguna
@endsection

@section("styles")
    {{-- main styles --}}
    <link href="{{ asset("images/brand-logos/favicon.ico") }}" rel="icon" type="image/x-icon">
    <link href="{{ asset("libs/bootstrap/css/bootstrap.min.css") }}" id="style" rel="stylesheet">
    <link href="{{ asset("css/styles.min.css") }}" rel="stylesheet">
    <link href="{{ asset("css/icons.css") }}" rel="stylesheet">
    <link href="{{ asset("libs/node-waves/waves.min.css") }}" rel="stylesheet">
    <link href="{{ asset("libs/simplebar/simplebar.min.css") }}" rel="stylesheet">
    <link href="{{ asset("libs/flatpickr/flatpickr.min.css") }}" rel="stylesheet">
    <link href="{{ asset("libs/@simonwep/pickr/themes/nano.min.css") }}" rel="stylesheet">
    <link href="{{ asset("libs/choices.js/public/assets/styles/choices.min.css") }}" rel="stylesheet">
@endsection

@section("content")
    <div class="container-fluid">
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-18 mb-0">Edit Pengguna</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb breadcrumb-style2 mb-0">
                        <li class="breadcrumb-item"><i class="ti ti-home-2 me-1 fs-15 d-inline-block"></i>Management</li>
                        <li class="breadcrumb-item"><i class="ti ti-user me-1 fs-15 d-inline-block"></i>Pengguna</li>
                        <li class="breadcrumb-item"><a href="{{ route("users.index") }}"><i class="ti ti-users me-1 fs-15 d-inline-block"></i>Data Pengguna</a></li>
                        <li aria-current="page" class="breadcrumb-item active"><a href="{{ route("users.edit", $user->id) }}"><i class="ti ti-pencil me-1 fs-15 d-inline-block"></i>Edit Pengguna</a></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="row gy-4">
                            <div class="card-header justify-content-between">
                                <div class="card-title">
                                    Data Pengguna
                                </div>
                            </div>
                            <form action="{{ route("users.update", $user->id) }}" class="row gy-4" method="POST">
                                @csrf
                                @method("PUT")
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <label class="form-label text-default fw-semibold" for="name">Nama</label>
                                    <input class="form-control text-muted" id="name" name="name" placeholder="Nama lengkap" type="text" value="{{ old("name", $user->name) }}">
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <label class="form-label text-default fw-semibold" for="email">Email</label>
                                    <input class="form-control" id="email" name="email" placeholder="user@example.com" type="email" value="{{ old("email", $user->email) }}">
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <label class="form-label text-default fw-semibold" for="position_id">Jabatan</label>
                                    <select aria-label="position" class="form-select text-muted" id="position_id" name="position_id">
                                        <option class="text-muted" disabled value="">Pilih Jabatan</option>
                                        @foreach ($positions as $position)
                                            <option {{ old("position_id", $user->position_id) == $position->id ? "selected" : "" }} value="{{ $position->id }}">{{ $position->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <label class="form-label text-default fw-semibold" for="section_id">Bagian</label>
                                    <select aria-label="section" class="form-select text-muted" id="section_id" name="section_id">
                                        <option class="text-muted" disabled value="">Pilih Bagian</option>
                                        @foreach ($sections as $section)
                                            <option {{ old("section_id", $user->section_id) == $section->id ? "selected" : "" }} value="{{ $section->id }}">{{ $section->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="card-header justify-content-between">
                                    <div class="card-title">
                                        Data Akun
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <label class="form-label" for="username">Username</label>
                                    <input autocomplete="new-username" class="form-control text-muted" id="username" name="username" placeholder="Username" type="text" value="{{ old("username", $user->username) }}">
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <label class="form-label text-default fw-semibold" for="role_id">Hak Akses</label>
                                    <select aria-label="role" class="form-select text-muted" id="role_id" name="role_id">
                                        <option class="text-muted" disabled value="">Pilih Hak Akses</option>
                                        @foreach ($roles as $role)
                                            <option {{ old("role_id", $user->role_id) == $role->id ? "selected" : "" }} value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                    <label class="form-label" for="password">Password</label>
                                    <div class="input-group">
                                        <input autocomplete="password" class="form-control form-control-lg" id="password" name="password" placeholder="********" type="password">
                                        <button class="btn btn-light" id="button-addon-password" onclick="createpassword('password',this)" type="button"><i class="ri-eye-off-line align-middle"></i></button>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                    <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                                    <div class="input-group">
                                        <input autocomplete="password" class="form-control form-control-lg" id="password_confirmation" name="password_confirmation" placeholder="********" type="password">
                                        <button class="btn btn-light" id="button-addon-password-confirmation" onclick="createpassword('password_confirmation',this)" type="button"><i class="ri-eye-off-line align-middle"></i></button>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end gap-2 mt-4">
                                    <a class="btn btn-danger" href="{{ route("users.index") }}">Batal</a>
                                    <button class="btn btn-primary" type="submit">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    {{-- main scripts --}}
    <script src="{{ asset("libs/@popperjs/core/umd/popper.min.js") }}"></script>
    <script src="{{ asset("libs/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
    <script src="{{ asset("js/defaultmenu.min.js") }}"></script>
    <script src="{{ asset("libs/node-waves/waves.min.js") }}"></script>
    <script src="{{ asset("js/sticky.js") }}"></script>
    <script src="{{ asset("libs/simplebar/simplebar.min.js") }}"></script>
    <script src="{{ asset("js/simplebar.js") }}"></script>
    <script src="{{ asset("libs/@simonwep/pickr/pickr.es5.min.js") }}"></script>
    <script src="{{ asset("js/custom-switcher.min.js") }}"></script>
    <script src="{{ asset("libs/choices.js/public/assets/scripts/choices.min.js") }}"></script>
    <script src="{{ asset("js/main.js") }}"></script>
    {{-- content scripts --}}
    <script src="{{ asset("libs/sweetalert2/sweetalert2.all.min.js") }}"></script>
    <script src="{{ asset("js/show-password.js") }}"></script>
    {{-- custom scripts --}}
    @if (session("success"))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session("success") }}',
            });
        </script>
    @endif
    @if (session("error"))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session("error") }}',
            });
        </script>
    @endif
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                html: `{!! implode("<br>", $errors->all()) !!}`,
                confirmButtonText: 'OK'
            });
        </script>
    @endif
@endsection
