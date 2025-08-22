<!DOCTYPE html>
<html data-header-styles="light" data-menu-styles="light" data-nav-layout="vertical" data-theme-mode="light" data-toggled="close" data-vertical-style="overlay" dir="ltr" lang="en">

<head>

    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1.0' name='viewport'>
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <title>Aktivasi &mdash; SmartSupport</title>

    <link href="{{ asset("images/brand-logos/favicon.ico") }}" rel="icon" type="image/x-icon">
    <link href="{{ asset("libs/bootstrap/css/bootstrap.min.css") }}" id="style" rel="stylesheet">
    <link href="{{ asset("css/styles.min.css") }}" rel="stylesheet">
    <link href="{{ asset("css/icons.min.css") }}" rel="stylesheet">

</head>

<body>

    <div class="container">
        <div class="row justify-content-center align-items-center authentication authentication-basic h-100">
            <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-6 col-sm-8 col-12">
                <div class="my-5 d-flex justify-content-center">
                    <a href="{{ route("home") }}">
                        <img alt="logo" class="desktop-logo" src="{{ asset("images/brand-logos/logo.png") }}">
                    </a>
                </div>
                <div class="card custom-card">
                    <div class="card-body p-5">
                        <p class="h5 fw-bold mb-2 text-center">Aktivasi Akun</p>
                        <p class="mb-4 text-muted op-7 fw-normal text-center">Silakan masukkan username dan token untuk mengaktifkan akun Anda.</p>
                        <div class="row gy-3">
                            <form action="{{ route("activation") }}" method="POST">
                                @csrf
                                <div class="col-xl-12">
                                    <label class="form-label text-default fw-semibold" for="username">Username</label>
                                    <input class="form-control form-control-lg" id="username" name="username" placeholder="username" type="text">
                                </div>
                                <div class="col-xl-12 mb-2">
                                    <label class="form-label text-default d-block fw-semibold" for="token">Token</label>
                                    <div class="input-group">
                                        <input class="form-control form-control-lg" id="token" name="token" placeholder="********" type="password">
                                        <button class="btn btn-light" id="button-addon2" onclick="createpassword('token',this)" type="button"><i class="ri-eye-off-line align-middle"></i></button>
                                    </div>
                                </div>
                                <div class="col-xl-12 d-grid mt-2">
                                    <button class="btn btn-lg btn-primary" type="submit">Aktivasi</button>
                                </div>
                            </form>
                        </div>
                        <div class="text-center">
                            <p class="fs-12 text-muted mt-3">Tidak punya akun? <a class="text-primary" href="{{ route("register.index") }}">Daftar</a></p>
                            <p class="fs-12 text-muted mt-3">Sudah punya akun ? <a class="text-primary" href="{{ route("login.index") }}">Masuk</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset("js/authentication-main.js") }}"></script>
    <script src="{{ asset("libs/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
    <script src="{{ asset("js/show-password.js") }}"></script>
    <script src="{{ asset("libs/sweetalert2/sweetalert2.all.min.js") }}"></script>

    @if (session("success"))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session("success") }}',
                timer: 2500,
                showConfirmButton: false
            });
        </script>
    @endif
    @if (session("error"))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan!',
                text: '{{ session("error") }}',
            });
        </script>
    @endif
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Aktivasi Gagal!',
                html: `<div class="text-center">
                           @foreach ($errors->all() as $error)
                               <div>{{ $error }}</div>
                           @endforeach
                       </div>`,
                confirmButtonText: 'OK'
            });
        </script>
    @endif

</body>

</html>
