@extends("layouts.app")

@section("title")
    SmartSupport &mdash; {{ isset($componentType) ? "Edit" : "Tambah" }} Jenis Komponen
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
            <h1 class="page-title fw-semibold fs-18 mb-0">{{ isset($componentType) ? "Edit" : "Tambah" }} Jenis Komponen</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb breadcrumb-style2 mb-0">
                        <li class="breadcrumb-item">Master Data Aset</li>
                        <li class="breadcrumb-item">Komponen</li>
                        <li class="breadcrumb-item">Jenis Komponen</li>
                        <li aria-current="page" class="breadcrumb-item active">{{ isset($componentType) ? "Edit" : "Tambah" }} Jenis Komponen</li>
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
                                    Form {{ isset($componentType) ? "Edit" : "Tambah" }} Jenis Komponen
                                </div>
                            </div>
                            <form action="{{ isset($componentType) ? route("component.types.update", $componentType->id) : route("component.types.store") }}" autocomplete="off" class="row gy-4" method="POST">
                                @csrf
                                @if (isset($componentType))
                                    @method("PUT")
                                @endif
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <label class="form-label text-default fw-semibold" for="name">Nama Jenis Komponen</label>
                                    <input class="form-control" id="name" name="name" placeholder="Nama Jenis Komponen" type="text" value="{{ old("name", isset($componentType) ? $componentType->name : "") }}">
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <label class="form-label text-default fw-semibold" for="asset_tag_id">Tag Jenis Komponen</label>
                                    <select class="form-select" id="asset_tag_id" name="asset_tag_id">
                                        <option value="">Pilih Tag Jenis Komponen</option>
                                        @foreach ($assetTags as $tag)
                                            <option {{ old("asset_tag_id", isset($componentType) ? $componentType->asset_tag_id : "") == $tag->id ? "selected" : "" }} value="{{ $tag->id }}">
                                                {{ $tag->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 d-flex justify-content-end gap-2 mt-4">
                                    <button class="btn btn-danger" onclick="goToIndex()" type="button"><i class="ti ti-x"></i> Batal</button>
                                    <button class="btn btn-secondary" onclick="clearFormInputs()" type="button"><i class="ti ti-trash"></i> Hapus</button>
                                    <button class="btn btn-primary" type="submit"><i class="ti ti-check"></i> {{ isset($componentType) ? "Update" : "Simpan" }}</button>
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
    <script>
        function clearFormInputs() {
            document.getElementById('name').value = '';
            document.getElementById('asset_tag_id').value = '';
        }

        function goToIndex() {
            window.location.href = "{{ route("component.types.index") }}";
        }
    </script>
@endsection
