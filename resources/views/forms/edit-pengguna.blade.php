@extends("layouts.app")

@section("title", "SmartSupport - Edit Pengguna")

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
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">Management</li>
                        <li aria-current="page" class="breadcrumb-item"><a href="{{ route("users") }}">Pengguna</a></li>
                        <li aria-current="page" class="breadcrumb-item active"><a href="{{ route("users.edit", $user->id) }}">Edit Pengguna</a></li>
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
                                    <label class="form-label text-default fw-semibold" for="position">Jabatan</label>
                                    <select aria-label="position" class="form-select text-muted" id="position" name="position">
                                        <option {{ old("position", $user->position) ? "" : "selected" }} class="text-muted" disabled value="">Pilih Jabatan</option>
                                        <option {{ old("position", $user->position) == "manager" ? "selected" : "" }} class="text-muted" value="manager">Manager</option>
                                        <option {{ old("position", $user->position) == "kabag" ? "selected" : "" }} class="text-muted" value="kabag">Kepala Bagian</option>
                                        <option {{ old("position", $user->position) == "supervisor" ? "selected" : "" }} class="text-muted" value="supervisor">Supervisor</option>
                                        <option {{ old("position", $user->position) == "staff" ? "selected" : "" }} class="text-muted" value="staff">Staff</option>
                                        <option {{ old("position", $user->position) == "support" ? "selected" : "" }} class="text-muted" value="support">Support</option>
                                    </select>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <label class="form-label text-default fw-semibold" for="section">Bagian</label>
                                    <select aria-label="section" class="form-select text-muted" id="section" name="section">
                                        <option {{ old("section", $user->section) ? "" : "selected" }} class="text-muted" disabled value="">Pilih Bagian</option>
                                        <optgroup label="Marketing">
                                            <option {{ old("section", $user->section) == "MSL" ? "selected" : "" }} class="text-muted" value="MSL">Sales</option>
                                            <option {{ old("section", $user->section) == "MMS" ? "selected" : "" }} class="text-muted" value="MMS">Marketing Support</option>
                                            <option {{ old("section", $user->section) == "MBD" ? "selected" : "" }} class="text-muted" value="MBD">Business Development</option>
                                        </optgroup>
                                        <optgroup label="Information Technology">
                                            <option {{ old("section", $user->section) == "INC" ? "selected" : "" }} class="text-muted" value="INC">IT Non Cellular</option>
                                            <option {{ old("section", $user->section) == "ITC" ? "selected" : "" }} class="text-muted" value="ITC">IT Cellular</option>
                                            <option {{ old("section", $user->section) == "ITS" ? "selected" : "" }} class="text-muted" value="ITS">IT Support</option>
                                            <option {{ old("section", $user->section) == "IMS" ? "selected" : "" }} class="text-muted" value="IMS">Information Management System</option>
                                        </optgroup>
                                        <optgroup label="Finance and Accounting">
                                            <option {{ old("section", $user->section) == "FCL" ? "selected" : "" }} class="text-muted" value="FCL">Calculation</option>
                                            <option {{ old("section", $user->section) == "FCC" ? "selected" : "" }} class="text-muted" value="FCC">Cost Control</option>
                                            <option {{ old("section", $user->section) == "FAC" ? "selected" : "" }} class="text-muted" value="FAC">Accounting</option>
                                            <option {{ old("section", $user->section) == "FEF" ? "selected" : "" }} class="text-muted" value="FEF">Efficiency</option>
                                        </optgroup>
                                        <optgroup label="Procurement">
                                            <option {{ old("section", $user->section) == "FPR" ? "selected" : "" }} class="text-muted" value="FPR">Procurement</option>
                                        </optgroup>
                                        <optgroup label="PPIC">
                                            <option {{ old("section", $user->section) == "LPP" ? "selected" : "" }} class="text-muted" value="LPP">Production Planning</option>
                                            <option {{ old("section", $user->section) == "LIC" ? "selected" : "" }} class="text-muted" value="LIC">Inventory Control</option>
                                            <option {{ old("section", $user->section) == "LSH" ? "selected" : "" }} class="text-muted" value="LSH">Shipment</option>
                                        </optgroup>
                                        <optgroup label="Production">
                                            <option {{ old("section", $user->section) == "PPR" ? "selected" : "" }} class="text-muted" value="PPR">Printing</option>
                                            <option {{ old("section", $user->section) == "PLM" ? "selected" : "" }} class="text-muted" value="PLM">Lamination</option>
                                            <option {{ old("section", $user->section) == "PIS" ? "selected" : "" }} class="text-muted" value="PIS">Inspection</option>
                                            <option {{ old("section", $user->section) == "PME" ? "selected" : "" }} class="text-muted" value="PME">Module Embedding</option>
                                            <option {{ old("section", $user->section) == "PRS" ? "selected" : "" }} class="text-muted" value="PRS">Perso Celullar</option>
                                            <option {{ old("section", $user->section) == "PRN" ? "selected" : "" }} class="text-muted" value="PRN">Perso Non Celullar</option>
                                            <option {{ old("section", $user->section) == "PPP" ? "selected" : "" }} class="text-muted" value="PPP">Packing</option>
                                        </optgroup>
                                        <optgroup label="Quality Assurance">
                                            <option {{ old("section", $user->section) == "QPE" ? "selected" : "" }} class="text-muted" value="QPE">Product Engineering</option>
                                            <option {{ old("section", $user->section) == "QLC" ? "selected" : "" }} class="text-muted" value="QLC">Quality Control</option>
                                        </optgroup>
                                        <optgroup label="Technic">
                                            <option {{ old("section", $user->section) == "TEC" ? "selected" : "" }} class="text-muted" value="TEC">Technic</option>
                                        </optgroup>
                                        <optgroup label="Humman Resource and General Affair">
                                            <option {{ old("section", $user->section) == "HHR" ? "selected" : "" }} class="text-muted" value="HHR">Human Resource</option>
                                            <option {{ old("section", $user->section) == "HGA" ? "selected" : "" }} class="text-muted" value="HGA">General Affairs</option>
                                            <option {{ old("section", $user->section) == "HLG" ? "selected" : "" }} class="text-muted" value="HLG">Legal</option>
                                            <option {{ old("section", $user->section) == "SSI" ? "selected" : "" }} class="text-muted" value="SSI">Internal Security</option>
                                        </optgroup>
                                        <optgroup label="Quality Management System">
                                            <option {{ old("section", $user->section) == "QMS" ? "selected" : "" }} class="text-muted" value="QMS">Quality Management System</option>
                                        </optgroup>
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
                                    <label class="form-label text-default fw-semibold" for="role">Hak Akses</label>
                                    <select aria-label="role" class="form-select text-muted" id="role" name="role">
                                        <option {{ old("role", $user->role) ? "" : "selected" }} class="text-muted" disabled value="">Pilih Hak Akses</option>
                                        <option {{ old("role", $user->role) == "pengguna" ? "selected" : "" }} class="text-muted" value="pengguna">Pengguna</option>
                                        <option {{ old("role", $user->role) == "editor" ? "selected" : "" }} class="text-muted" value="editor">Editor</option>
                                        <option {{ old("role", $user->role) == "administrator" ? "selected" : "" }} class="text-muted" value="administrator">Administrator</option>
                                    </select>
                                </div>
                                <div class="col-12 d-flex justify-content-end gap-2 mt-4">
                                    <a class="btn btn-danger" href="{{ route("users") }}">Batal</a>
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
