@extends("layouts.app")

@section("title")
    SmartSupport &mdash; {{ isset($vendor) ? "Edit" : "Tambah" }} Vendor
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
            <h1 class="page-title fw-semibold fs-18 mb-0">{{ isset($vendor) ? "Edit" : "Tambah" }} Vendor</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb breadcrumb-style2 mb-0">
                        <li class="breadcrumb-item">Master Data Aset</li>
                        <li class="breadcrumb-item">Supplier dan Vendor</li>
                        <li class="breadcrumb-item">Vendor</li>
                        <li aria-current="page" class="breadcrumb-item active">{{ isset($vendor) ? "Edit" : "Tambah" }} Vendor</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title">
                            Form {{ isset($vendor) ? "Edit" : "Tambah" }} Vendor
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ isset($vendor) ? route("vendors.update", $vendor->id) : route("vendors.store") }}" autocomplete="off" class="row gy-4" method="POST">
                            @csrf
                            @if (isset($vendor))
                                @method("PUT")
                            @endif
                            <div class="col-xl-12">
                                <h6 class="fw-semibold mb-3">Informasi Vendor</h6>
                                <hr>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label text-default fw-semibold" for="name">Nama Vendor</label>
                                            <input class="form-control" id="name" name="name" placeholder="Nama Vendor" type="text" value="{{ old("name", isset($vendor) ? $vendor->name : "") }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label text-default fw-semibold" for="vendor_code">Kode Vendor</label>
                                            <input class="form-control" id="vendor_code" name="vendor_code" placeholder="Kode Vendor" type="text" value="{{ old("vendor_code", isset($vendor) ? $vendor->vendor_code : "") }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <h6 class="fw-semibold mb-3">Kontak Vendor</h6>
                                <hr>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label text-default fw-semibold" for="contact_person">Kontak Person</label>
                                            <input class="form-control" id="contact_person" name="contact_person" placeholder="Kontak Person" type="text" value="{{ old("contact_person", isset($vendor) ? $vendor->contact_person : "") }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label text-default fw-semibold" for="phone">Telepon</label>
                                            <input class="form-control" id="phone" name="phone" placeholder="Telepon" type="text" value="{{ old("phone", isset($vendor) ? $vendor->phone : "") }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label text-default fw-semibold" for="email">Email</label>
                                            <input class="form-control" id="email" name="email" placeholder="Email" type="email" value="{{ old("email", isset($vendor) ? $vendor->email : "") }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label text-default fw-semibold" for="website">Website</label>
                                            <input class="form-control" id="website" name="website" placeholder="Website" type="text" value="{{ old("website", isset($vendor) ? $vendor->website : "") }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <h6 class="fw-semibold mb-3">Alamat Vendor</h6>
                                <hr>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label text-default fw-semibold" for="city">Kota</label>
                                            <input class="form-control" id="city" name="city" placeholder="Kota" type="text" value="{{ old("city", isset($vendor) ? $vendor->city : "") }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label text-default fw-semibold" for="postal_code">Kode Pos</label>
                                            <input class="form-control" id="postal_code" name="postal_code" placeholder="Kode Pos" type="text" value="{{ old("postal_code", isset($vendor) ? $vendor->postal_code : "") }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label text-default fw-semibold" for="province">Provinsi</label>
                                            <input class="form-control" id="province" name="province" placeholder="Provinsi" type="text" value="{{ old("province", isset($vendor) ? $vendor->province : "") }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label text-default fw-semibold" for="country">Negara</label>
                                            <input class="form-control" id="country" name="country" placeholder="Negara" type="text" value="{{ old("country", isset($vendor) ? $vendor->country : "") }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label text-default fw-semibold" for="address">Alamat</label>
                                            <textarea class="form-control" id="address" name="address" placeholder="Alamat" rows="3">{{ old("address", isset($vendor) ? $vendor->address : "") }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label text-default fw-semibold" for="notes">Catatan</label>
                                            <textarea class="form-control" id="notes" name="notes" placeholder="Catatan" rows="3">{{ old("notes", isset($vendor) ? $vendor->notes : "") }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end gap-2 mt-4">
                                <button class="btn btn-danger" onclick="goToIndex()" type="button">
                                    <i class="ti ti-x"></i> Batal
                                </button>
                                <button class="btn btn-secondary" onclick="clearFormInputs()" type="button">
                                    <i class="ti ti-trash"></i> Hapus
                                </button>
                                <button class="btn btn-primary" type="submit">
                                    <i class="ti ti-check"></i> {{ isset($supplier) ? "Update" : "Simpan" }}
                                </button>
                            </div>
                        </form>
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
            document.getElementById('supplier_code').value = '';
            document.getElementById('contact_person').value = '';
            document.getElementById('phone').value = '';
            document.getElementById('email').value = '';
            document.getElementById('website').value = '';
            document.getElementById('address').value = '';
            document.getElementById('postal_code').value = '';
            document.getElementById('city').value = '';
            document.getElementById('province').value = '';
            document.getElementById('country').value = '';
            document.getElementById('notes').value = '';
        }

        function goToIndex() {
            window.location.href = "{{ route("vendors.index") }}";
        }
    </script>
@endsection
