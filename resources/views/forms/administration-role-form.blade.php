@extends("layouts.app")

@section("title")
    SmartSupport &mdash; {{ isset($role) ? "Edit" : "Tambah" }} Peran
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
        {{-- Header & Breadcrumb Dinamis --}}
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-18 mb-0">{{ isset($role) ? "Edit" : "Tambah" }} Peran</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb breadcrumb-style2 mb-0">
                        <li class="breadcrumb-item">Manajemen Aplikasi</li>
                        <li class="breadcrumb-item">Administrasi dan Akses</li>
                        <li class="breadcrumb-item">Peran Pengguna</li>
                        <li aria-current="page" class="breadcrumb-item active">{{ isset($role) ? "Edit" : "Tambah" }} Peran</li>
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
                                    Form {{ isset($role) ? "Edit" : "Tambah" }} Peran
                                </div>
                            </div>
                            <form action="{{ isset($role) ? route("roles.update", $role->id) : route("roles.store") }}" method="POST">
                                @csrf
                                @if (isset($role))
                                    @method("PUT")
                                @endif

                                <div class="row gy-4">

                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <label class="form-label text-default fw-semibold" for="name">Nama Peran</label>
                                        <input class="form-control @error("name") is-invalid @enderror" id="name" name="name" placeholder="Nama Peran Baru" required type="text" value="{{ old("name", $role->name ?? "") }}">
                                        @error("name")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <label class="form-label text-default fw-semibold" for="role_code">Kode Peran</label>
                                        <input class="form-control @error("role_code") is-invalid @enderror" id="role_code" name="role_code" placeholder="Kode Peran Baru" required type="text" value="{{ old("role_code", $role->role_code ?? "") }}">
                                        @error("role_code")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="card-header justify-content-between mt-4">
                                        <div class="card-title">
                                            Form Hak Akses
                                        </div>
                                        <div class="col-12 mt-4 pt-3 border-top">
                                            @foreach ($permissionGroups as $groupName => $permissions)
                                                <div class="mb-4">
                                                    <h6 class="fw-bold mb-3 text-primary">
                                                        <i class="bi bi-shield-lock me-2"></i>{{ $groupName }}
                                                    </h6>
                                                    <div class="row g-3">
                                                        @foreach ($permissions as $permission)
                                                            <div class="col-md-4 col-sm-6">
                                                                <div class="form-check form-switch py-2">
                                                                    <input {{ (isset($role) && $role->permissions->contains($permission->id)) || (is_array(old("permissions")) && in_array($permission->id, old("permissions"))) ? "checked" : "" }} class="form-check-input" id="permission_{{ $permission->id }}" name="permissions[]" type="checkbox" value="{{ $permission->id }}">
                                                                    <label class="form-check-label fw-semibold ms-2" for="permission_{{ $permission->id }}">
                                                                        {{ $permission->code_name }}
                                                                    </label>
                                                                    <div class="text-muted small ms-2">
                                                                        {{ $permission->description }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-12 d-flex justify-content-end gap-2 mt-4">
                                        <a class="btn btn-danger" href="{{ route("roles.index") }}">Batal</a>
                                        <button class="btn btn-primary" type="submit">Simpan</button>
                                    </div>
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
