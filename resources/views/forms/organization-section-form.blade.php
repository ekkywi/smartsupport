@extends("layouts.app")

@section("title")
    SmartSupport &mdash; {{ isset($section) ? "Edit" : "Tambah" }} Bagian
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
            <h1 class="page-title fw-semibold fs-18 mb-0">Tambah Bagian</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb breadcrumb-style2 mb-0">
                        <li class="breadcrumb-item">Manajemen Aplikasi</li>
                        <li class="breadcrumb-item">Organisasi</li>
                        <li aria-current="page" class="breadcrumb-item">Data Bagian</li>
                        <li aria-current="page" class="breadcrumb-item active">{{ isset($section) ? "Edit" : "Tambah" }} Bagian</li>
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
                                    Tambah Data Bagian
                                </div>
                            </div>
                            <form action="{{ isset($section) ? route("sections.update", $section->id) : route("sections.store") }}" method="POST">
                                @csrf
                                @if (isset($section))
                                    @method("PUT")
                                @endif
                                <div class="row gy-4">
                                    <div class="col-xl-6">
                                        <label class="form-label" for="name">Nama Bagian</label>
                                        <input class="form-control @error("name") is-invalid @enderror" id="name" name="name" required type="text" value="{{ old("name", $section->name ?? "") }}">
                                        @error("name")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-xl-6">
                                        <label class="form-label" for="section_code">Kode Bagian</label>
                                        <input class="form-control @error("section_code") is-invalid @enderror" id="section_code" name="section_code" required type="text" value="{{ old("section_code", $section->section_code ?? "") }}">
                                        @error("section_code")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12 d-flex justify-content-end gap-2 mt-4">
                                        <a class="btn btn-danger" href="{{ route("sections.index") }}">Batal</a>
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
    <script>
        function clearFormInputs() {
            document.querySelectorAll('#section_name, #section_code').forEach(el => el.value = '');
        }
    </script>
    <script>
        function goToIndex() {
            window.location.href = "{{ route("sections.index") }}";
        }
    </script>
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
