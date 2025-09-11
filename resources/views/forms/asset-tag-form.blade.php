@extends("layouts.app")

@section("title")
    SmartSupport &mdash; {{ isset($assetStatuses) ? "Edit" : "Tambah" }} Tag Aset
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
            <h1 class="page-title fw-semibold fs-18 mb-0">{{ isset($assetTag) ? "Edit" : "Tambah" }} Tag Aset</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb breadcrumb-style2 mb-0">
                        <li class="breadcrumb-item">Master Data Aset</li>
                        <li class="breadcrumb-item">Penomoran Aset</li>
                        <li class="breadcrumb-item">Tag Aset</li>
                        <li aria-current="page" class="breadcrumb-item active">{{ isset($assetTag) ? "Edit" : "Tambah" }} Tag Aset</li>
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
                                    Form {{ isset($assetTag) ? "Edit" : "Tambah" }} Tag Aset
                                </div>
                            </div>
                            <form action="{{ isset($assetTag) ? route("asset.tags.update", $assetTag->id) : route("asset.tags.store") }}" autocomplete="off" class="row gy-4" method="POST">
                                @csrf
                                @if (isset($assetTag))
                                    @method("PUT")
                                @endif
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <label class="form-label text-default fw-semibold" for="name">Nama Tag Aset</label>
                                    <input class="form-control" id="name" name="name" placeholder="Nama Tag Aset" type="text" value="{{ old("name", isset($assetTag) ? $assetTag->name : "") }}">
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <label class="form-label text-default fw-semibold" for="asset_tag">Tag Aset</label>
                                    <input class="form-control" id="asset_tag" name="asset_tag" placeholder="Tag Aset" type="text" value="{{ old("asset_tag", isset($assetTag) ? $assetTag->asset_tag : "") }}">
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                    <label class="form-label text-default fw-semibold" for="description">Deskripsi</label>
                                    <textarea class="form-control" id="description" name="description" placeholder="Deskripsi" rows="3">{{ old("description", isset($assetTag) ? $assetTag->description : "") }}</textarea>
                                </div>
                                <div class="col-12 d-flex justify-content-end gap-2 mt-4">
                                    <button class="btn btn-danger" onclick="goToIndex()" type="button"><i class="ti ti-x"></i> Batal</button>
                                    <button class="btn btn-secondary" onclick="clearFormInputs()" type="button"><i class="ti ti-trash"></i> Hapus</button>
                                    <button class="btn btn-primary" type="submit"><i class="ti ti-check"></i> {{ isset($assetTag) ? "Update" : "Simpan" }}</button>
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
            document.getElementById('asset_tag').value = '';
            document.getElementById('description').value = '';
        }

        function goToIndex() {
            window.location.href = "{{ route("asset.tags.index") }}";
        }
    </script>
@endsection
