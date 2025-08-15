@extends("layouts.app")

@section("title", "SmartSupport — Tambah Pengguna")

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
            <h1 class="page-title fw-semibold fs-18 mb-0">Tambah Pengguna</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">Management</li>
                        <li aria-current="page" class="breadcrumb-item"><a href="{{ route("users") }}">Data Pengguna</a></li>
                        <li aria-current="page" class="breadcrumb-item active"><a href="{{ route("users.add") }}">Tambah Pengguna</a></li>
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
                            <form action="{{ route("users.store") }}" class="row gy-4" method="POST">
                                @csrf
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <label class="form-label text-default fw-semibold" for="name">Nama</label>
                                    <input class="form-control" id="name" name="name" placeholder="Nama lengkap" type="text">
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <label class="form-label text-default fw-semibold" for="email">Email</label>
                                    <input class="form-control" id="email" name="email" placeholder="user@example.com" type="email">
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <label class="form-label text-default fw-semibold" for="position">Jabatan</label>
                                    <select aria-label="position" class="form-select text-muted" id="position" name="position">
                                        <option class="text-muted" disabled selected value="">Pilih Jabatan</option>
                                        <option class="text-muted" value="manager">Manager</option>
                                        <option class="text-muted" value="kabag">Kepala Bagian</option>
                                        <option class="text-muted" value="supervisor">Supervisor</option>
                                        <option class="text-muted" value="staff">Staff</option>
                                        <option class="text-muted" value="support">Support</option>
                                    </select>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <label class="form-label text-default fw-semibold" for="section">Bagian</label>
                                    <select aria-label="section" class="form-select text-muted" id="section" name="section">
                                        <option class="text-muted" disabled selected value="">Pilih Bagian</option>
                                        <optgroup label="Marketing">
                                            <option class="text-muted" value="MSL">Sales</option>
                                            <option class="text-muted" value="MMS">Marketing Support</option>
                                            <option class="text-muted" value="MBD">Business Development</option>
                                        </optgroup>
                                        <optgroup label="Information Technology">
                                            <option class="text-muted" value="INC">IT Non Cellular</option>
                                            <option class="text-muted" value="ITC">IT Cellular</option>
                                            <option class="text-muted" value="ITS">IT Support</option>
                                            <option class="text-muted" value="IMS">Information Management System</option>
                                        </optgroup>
                                        <optgroup label="Finance and Accounting">
                                            <option class="text-muted" value="FCL">Calculation</option>
                                            <option class="text-muted" value="FCC">Cost Control</option>
                                            <option class="text-muted" value="FAC">Accounting</option>
                                            <option class="text-muted" value="FEF">Efficiency</option>
                                        </optgroup>
                                        <optgroup label="Procurement">
                                            <option class="text-muted" value="FPR">Procurement</option>
                                        </optgroup>
                                        <optgroup label="PPIC">
                                            <option class="text-muted" value="LPP">Production Planning</option>
                                            <option class="text-muted" value="LIC">Inventory Control</option>
                                            <option class="text-muted" value="LSH">Shipment</option>
                                        </optgroup>
                                        <optgroup label="Production">
                                            <option class="text-muted" value="PPR">Printing</option>
                                            <option class="text-muted" value="PLM">Lamination</option>
                                            <option class="text-muted" value="PIS">Inspection</option>
                                            <option class="text-muted" value="PME">Module Embedding</option>
                                            <option class="text-muted" value="PRS">Perso Celullar</option>
                                            <option class="text-muted" value="PRN">Perso Non Celullar</option>
                                            <option class="text-muted" value="PPP">Packing</option>
                                        </optgroup>
                                        <optgroup label="Quality Assurance">
                                            <option class="text-muted" value="QPE">Product Engineering</option>
                                            <option class="text-muted" value="QLC">Quality Control</option>
                                        </optgroup>
                                        <optgroup label="Technic">
                                            <option class="text-muted" value="TEC">Technic</option>
                                        </optgroup>
                                        <optgroup label="Humman Resource and General Affair">
                                            <option class="text-muted" value="HHR">Human Resource</option>
                                            <option class="text-muted" value="HGA">General Affairs</option>
                                            <option class="text-muted" value="HLG">Legal</option>
                                            <option class="text-muted" value="SSI">Internal Security</option>
                                        </optgroup>
                                        <optgroup label="Quality Management System">
                                            <option class="text-muted" value="QMS">Quality Management System</option>
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
                                    <input autocomplete="new-username" class="form-control" id="username" name="username" placeholder="Username" type="text">
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <label class="form-label text-default fw-semibold" for="role">Hak Akses</label>
                                    <select aria-label="role" class="form-select text-muted" id="role" name="role">
                                        <option class="text-muted" disabled selected value="">Pilih Hak Akses</option>
                                        <option class="text-muted" value="pengguna">Pengguna</option>
                                        <option class="text-muted" value="editor">Editor</option>
                                        <option class="text-muted" value="administrator">Administrator</option>
                                    </select>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                    <label class="form-label" for="password">Password</label>
                                    <div class="input-group">
                                        <input autocomplete="new-password" class="form-control form-control-lg" id="password" name="password" placeholder="********" required type="password">
                                        <button class="btn btn-light" id="button-addon-password" onclick="createpassword('password',this)" type="button"><i class="ri-eye-off-line align-middle"></i></button>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                    <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                                    <div class="input-group">
                                        <input autocomplete="new-password" class="form-control form-control-lg" id="password_confirmation" name="password_confirmation" placeholder="********" required type="password">
                                        <button class="btn btn-light" id="button-addon-password-confirmation" onclick="createpassword('password_confirmation',this)" type="button"><i class="ri-eye-off-line align-middle"></i></button>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 d-flex align-items-end">
                                    <button class="btn btn-success w-100" onclick="generateRandomPassword()" type="button">Generate Password</button>
                                </div>
                                <div class="col-12 d-flex justify-content-end gap-2 mt-4">
                                    <button class="btn btn-danger" onclick="goToIndex()" type="button">Batal</button>
                                    <button class="btn btn-secondary" onclick="clearFormInputs()" type="button">Hapus</button>
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
    <script>
        function generateRandomPassword(length = 12) {
            const chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*";
            let password = "";
            for (let i = 0; i < length; i++) {
                password += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            document.getElementById('password').value = password;
            document.getElementById('password_confirmation').value = password;
        }

        function goToIndex() {
            window.location.href = "{{ route("users") }}";
        }
    </script>
    <script>
        function clearFormInputs() {
            document.querySelectorAll('#name, #email, #username, #password, #password_confirmation').forEach(el => el.value = '');
            document.getElementById('position').selectedIndex = 0;
            document.getElementById('section').selectedIndex = 0;
            document.getElementById('role').selectedIndex = 0;
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
