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
                        <li class="breadcrumb-item">Management</li>
                        <li class="breadcrumb-item">Data Peran</li>
                        <li aria-current="page" class="breadcrumb-item active">{{ isset($role) ? "Edit" : "Tambah" }} Peran</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card custom-card">
            <div class="card-body">
                {{-- Form Action Dinamis --}}
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

                        <div class="col-12 mt-4 pt-3 border-top">
                            <h5 class="fw-semibold mb-3">Hak Akses (Permissions)</h5>
                            <div class="row">
                                @forelse ($permissions as $permission)
                                    <div class="col-md-4 mb-2">
                                        <div class="form-check">
                                            <input @if (isset($role) && $role->permissions->contains($permission)) checked @endif class="form-check-input" id="perm-{{ $permission->id }}" name="permissions[]" type="checkbox" value="{{ $permission->id }}">
                                            <label class="form-check-label" for="perm-{{ $permission->id }}">
                                                <span class="fw-semibold">{{ $permission->code_name }}</span> <br>
                                                <small class="text-muted">{{ $permission->description }}</small>
                                            </label>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <p class="text-muted">Tidak ada jenis izin yang tersedia.</p>
                                    </div>
                                @endforelse
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
