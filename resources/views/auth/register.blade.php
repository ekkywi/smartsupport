<!DOCTYPE html>
<html data-header-styles="light" data-menu-styles="light" data-nav-layout="vertical" data-theme-mode="light" data-toggled="close" data-vertical-style="overlay" dir="ltr" lang="en">

<head>

    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1.0' name='viewport'>
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <title>Register — SmartSupport</title>

    <link href="{{ asset("images/brand-logos/favicon.ico") }}" rel="icon" type="image/x-icon">
    <script src="{{ asset("js/authentication-main.js") }}"></script>
    <link href="{{ asset("libs/bootstrap/css/bootstrap.min.css") }}" id="style" rel="stylesheet">
    <link href="{{ asset("css/styles.min.css") }}" rel="stylesheet">
    <link href="{{ asset("css/icons.min.css") }}" rel="stylesheet">

</head>

<body>

    <div class="container-lg">
        <div class="row justify-content-center align-items-center authentication authentication-basic h-100">
            <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-6 col-sm-8 col-12">
                <div class="my-5 d-flex justify-content-center">
                    <a href="index.html">
                        <img alt="logo" class="desktop-logo" src="{{ asset("images/brand-logos/logo.png") }}">
                    </a>
                </div>
                <div class="card custom-card">
                    <div class="card-body p-5">
                        <p class="h5 fw-bold mb-2 text-center">Register</p>
                        <p class="mb-4 text-muted op-7 fw-normal text-center">Daftarkan akun Anda</p>
                        <form action="{{ route("register") }}" method="POST">
                            @csrf
                            <div class="row gy-3">
                                <div class="col-xl-12">
                                    <label class="form-label text-default fw-semibold" for="name">Nama</label>
                                    <input class="form-control form-control-lg" id="name" name="name" placeholder="Masukan nama anda" required type="text">
                                </div>
                                <div class="col-xl-12">
                                    <label class="form-label text-default fw-semibold" for="username">Username</label>
                                    <input autocomplete="username" class="form-control form-control-lg" id="username" name="username" placeholder="Masukan username anda" required type="text">
                                </div>
                                <div class="col-xl-12">
                                    <label class="form-label text-default fw-semibold" for="section">Bagian</label>
                                    <select aria-label="bagian" class="form-select text-muted form-select-lg" id="section" name="section" required>
                                        <option class="text-muted" disabled selected value="">Pilih bagian anda</option>
                                        @foreach ($sections as $section)
                                            <option class="text-muted" value="{{ $section->id }}">{{ $section->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xl-12">
                                    <label class="form-label text-default fw-semibold" for="position">Jabatan</label>
                                    <select aria-label="jabatan" class="form-select text-muted form-select-lg" id="position" name="position" required>
                                        <option class="text-muted" disabled selected value="">Pilih jabatan anda</option>
                                        @foreach ($positions as $position)
                                            <option class="text-muted" value="{{ $position->id }}">{{ $position->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xl-12">
                                    <label class="form-label text-default fw-semibold" for="password">Password</label>
                                    <div class="input-group">
                                        <input autocomplete="new-password" class="form-control form-control-lg" id="password" name="password" placeholder="Masukan password anda" required type="password">
                                        <button class="btn btn-light" id="button-addon-password" onclick="createpassword('password',this)" type="button"><i class="ri-eye-off-line align-middle"></i></button>
                                    </div>
                                </div>
                                <div class="col-xl-12 mb-2">
                                    <label class="form-label text-default fw-semibold" for="confirm-password">Konfirmasi Password</label>
                                    <div class="input-group">
                                        <input autocomplete="new-password" class="form-control form-control-lg" id="confirm_password" name="password_confirmation" placeholder="Masukan konfirmasi password anda" required type="password">
                                        <button class="btn btn-light" id="button-addon-confirm-password" onclick="createpassword('confirm_password',this)" type="button"><i class="ri-eye-off-line align-middle"></i></button>
                                    </div>
                                </div>
                                <div class="col-xl-12 d-grid mt-2">
                                    <button class="btn btn-lg btn-primary" type="submit">Buat Akun</button>
                                </div>
                            </div>
                        </form>
                        <div class="text-center">
                            <p class="fs-12 text-muted mt-3">Sudah punya akun ? <a class="text-primary" href="{{ route("login") }}">Masuk</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset("libs/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
    <script src="{{ asset("js/show-password.js") }}"></script>
    <script src="{{ asset("libs/sweetalert2/sweetalert2.all.min.js") }}"></script>

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

</body>

</html>
