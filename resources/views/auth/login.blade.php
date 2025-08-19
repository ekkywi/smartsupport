<!DOCTYPE html>
<html data-header-styles="light" data-menu-styles="light" data-nav-layout="vertical" data-theme-mode="light" data-toggled="close" data-vertical-style="overlay" dir="ltr" lang="en">

<head>

    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1.0' name='viewport'>
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <title>Login — SmartSupport </title>

    <link href="{{ asset("images/brand-logos/favicon.ico") }}" rel="icon" type="image/x-icon">
    <script src="{{ asset("js/authentication-main.js") }}"></script>
    <link href="{{ asset("libs/bootstrap/css/bootstrap.min.css") }}" id="style" rel="stylesheet">
    <link href="{{ asset("css/styles.min.css") }}" rel="stylesheet">
    <link href="{{ asset("css/icons.min.css") }}" rel="stylesheet">

</head>

<body>

    <div class="container">
        <div class="row justify-content-center align-items-center authentication authentication-basic h-100">
            <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-6 col-sm-8 col-12">
                <div class="my-5 d-flex justify-content-center">
                    <a href="index.html">
                        <img alt="logo" class="desktop-logo" src="{{ asset("images/brand-logos/logo.png") }}">
                    </a>
                </div>
                <div class="card custom-card">
                    <div class="card-body p-5">
                        <p class="h5 fw-bold mb-2 text-center">Log In</p>
                        <p class="mb-4 text-muted op-7 fw-normal text-center">Selamat datang kembali !</p>
                        <form action="{{ route("login") }}" method="POST">
                            @csrf
                            <div class="row gy-3">
                                <div class="col-xl-12">
                                    <label class="form-label text-default fw-semibold" for="username">Username</label>
                                    <input autocomplete="username" class="form-control form-control-lg" id="username" name="username" placeholder="username" type="text">
                                </div>
                                <div class="col-xl-12 mb-2">
                                    <label class="form-label text-default d-block fw-semibold" for="password">Password<a class="float-end text-danger" href="#">Lupa password ?</a></label>
                                    <div class="input-group">
                                        <input autocomplete="current-password" class="form-control form-control-lg" id="password" name="password" placeholder="********" type="password">
                                        <button class="btn btn-light" id="button-addon-password" onclick="createpassword('password',this)" type="button"><i class="ri-eye-off-line align-middle"></i></button>
                                    </div>
                                    <div class="mt-2">
                                        <div class="form-check">
                                            <input class="form-check-input" id="defaultCheck1" type="checkbox" value="">
                                            <label class="form-check-label text-muted fw-normal" for="defaultCheck1">
                                                Ingat saya
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12 d-grid mt-2">
                                    <button class="btn btn-lg btn-primary" type="submit">Masuk</button>
                                </div>
                            </div>
                            <div class="text-center">
                                <p class="fs-12 text-muted mt-3">Tidak punya akun? <a class="text-primary" href="{{ route("register.store") }}">Daftar</a></p>
                                <p class="fs-12 text-muted mt-3">Akun anda belum aktif? <a class="text-primary" href="#">Aktivasi Akun</a></p>
                            </div>
                        </form>
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

</body>

</html>
