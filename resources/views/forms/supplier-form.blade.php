@extends("layouts.app")

@section("title")
    SmartSupport &mdash; {{ isset($brand) ? "Edit" : "Tambah" }} Merek
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
            <h1 class="page-title fw-semibold fs-18 mb-0">{{ isset($supplier) ? "Edit" : "Tambah" }} Supplier</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb breadcrumb-style2 mb-0">
                        <li class="breadcrumb-item">Master Data Aset</li>
                        <li class="breadcrumb-item">Supplier dan Vendor</li>
                        <li class="breadcrumb-item">Supplier</li>
                        <li aria-current="page" class="breadcrumb-item active">{{ isset($supplier) ? "Edit" : "Tambah" }} Supplier</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title">
                            Form {{ isset($supplier) ? "Edit" : "Tambah" }} Supplier
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ isset($supplier) ? route("suppliers.update", $supplier->id) : route("suppliers.store") }}" autocomplete="off" class="row gy-4" method="POST">
                            @csrf
                            @if (isset($supplier))
                                @method("PUT")
                            @endif
                            <div class="col-xl-12">
                                <h6 class="fw-semibold mb-3">Informasi Supplier</h6>
                                <hr>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label text-default fw-semibold" for="name">Nama Supplier</label>
                                            <input class="form-control" id="name" name="name" placeholder="Nama Supplier" type="text" value="{{ old("name", isset($supplier) ? $supplier->name : "") }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label text-default fw-semibold" for="supplier_code">Kode Supplier</label>
                                            <input class="form-control" id="supplier_code" name="supplier_code" placeholder="Kode Supplier" type="text" value="{{ old("supplier_code", isset($supplier) ? $supplier->supplier_code : "") }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <h6 class="fw-semibold mb-3">Kontak Supplier</h6>
                                <hr>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label text-default fw-semibold" for="contact_person">Kontak Person</label>
                                            <input class="form-control" id="contact_person" name="contact_person" placeholder="Kontak Person" type="text" value="{{ old("contact_person", isset($supplier) ? $supplier->contact_person : "") }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label text-default fw-semibold" for="phone">Telepon</label>
                                            <input class="form-control" id="phone" name="phone" placeholder="Telepon" type="text" value="{{ old("phone", isset($supplier) ? $supplier->phone : "") }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label text-default fw-semibold" for="email">Email</label>
                                            <input class="form-control" id="email" name="email" placeholder="Email" type="email" value="{{ old("email", isset($supplier) ? $supplier->email : "") }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label text-default fw-semibold" for="website">Website</label>
                                            <input class="form-control" id="website" name="website" placeholder="Website" type="text" value="{{ old("website", isset($supplier) ? $supplier->website : "") }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <h6 class="fw-semibold mb-3">Alamat Supplier</h6>
                                <hr>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label text-default fw-semibold" for="city">Kota</label>
                                            <input class="form-control" id="city" name="city" placeholder="Kota" type="text" value="{{ old("city", isset($supplier) ? $supplier->city : "") }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label text-default fw-semibold" for="postal_code">Kode Pos</label>
                                            <input class="form-control" id="postal_code" name="postal_code" placeholder="Kode Pos" type="text" value="{{ old("postal_code", isset($supplier) ? $supplier->postal_code : "") }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label text-default fw-semibold" for="province">Provinsi</label>
                                            <input class="form-control" id="province" name="province" placeholder="Provinsi" type="text" value="{{ old("province", isset($supplier) ? $supplier->province : "") }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label text-default fw-seminold" for="country">Negara</label>
                                            <input class="form-control" id="country" name="country" placeholder="Negara" type="text" value="{{ old("country", isset($supplier) ? $supplier->country : "") }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label text-default fw-semibold" for="address">Alamat</label>
                                            <textarea class="form-control" id="address" name="address" placeholder="Alamat" rows="3">{{ old("address", isset($supplier) ? $supplier->address : "") }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label text-default fw-semibold" for="notes">Catatan</label>
                                            <textarea class="form-control" id="notes" name="notes" placeholder="Catatan" rows="3">{{ old("notes", isset($supplier) ? $supplier->notes : "") }}</textarea>
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
            window.location.href = "{{ route("suppliers.index") }}";
        }
    </script>
@endsection
