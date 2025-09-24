@extends("layouts.app")

@section("title")
    SmartSupport &mdash; Data Model Komponen
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
    {{-- content styles --}}
    <link href="{{ asset("libs/datatables/css/dataTables.bootstrap5.min.css") }}" rel="stylesheet">
    <link href="{{ asset("libs/datatables/css/responsive.bootstrap.min.css") }}" rel="stylesheet">
    <link href="{{ asset("libs/datatables/css/buttons.bootstrap5.min.css") }}" rel="stylesheet">
@endsection

@section("content")
    <div class="container-fluid">
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-18 mb-0">Model Komponen</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb breadcrumb-style2 mb-0">
                        <li class="breadcrumb-item">Master Data Aset</li>
                        <li class="breadcrumb-item">Komponen</li>
                        <li aria-current="page" class="breadcrumb-item active">Model Komponen</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="container">
                <div class="d-flex justify-content-end align-items-center mb-3">
                    <div class="me-auto">
                        <a class="btn btn-info" href="{{ route("component.models.index") }}">
                            <i class="ti ti-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h2 class="h5 mb-0 text-primary">{{ $componentModel->name }}</h2>
                        <span class="text-muted">{{ $componentModel->component_model_code }}</span>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <dl class="row">
                                    <dt class="col-sm-4">Brand</dt>
                                    <dd class="col-sm-8">{{ $componentModel->brand->name ?? "N/A" }}</dd>

                                    <dt class="col-sm-4">Tipe Komponen</dt>
                                    <dd class="col-sm-8">{{ $componentModel->componentType->name ?? "N/A" }}</dd>

                                    <dt class="col-sm-4">Deskripsi</dt>
                                    <dd class="col-sm-8">{{ $componentModel->description ?? "-" }}</dd>
                                </dl>
                            </div>
                            <div class="col-md-6">
                                <dl class="row">
                                    <dt class="col-sm-4">Dibuat Pada</dt>
                                    <dd class="col-sm-8">{{ $componentModel->created_at->format("d F Y, H:i") }}</dd>
                                    <dt class="col-sm-4">Diperbarui Pada</dt>
                                    <dd class="col-sm-8">{{ $componentModel->updated_at->format("d F Y, H:i") }}</dd>
                                </dl>
                            </div>
                        </div>

                        <h5 class="mt-4 text-primary">Spesifikasi Detail</h5>
                        <hr>
                        @if ($componentModel->specs && count((array) $componentModel->specs) > 0)
                            <div class="list-group">
                                @foreach ($componentModel->formatted_specs as $spec)
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong>{{ $spec["label"] }}</strong>
                                        <span>{{ $spec["value"] }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted">Tidak ada data spesifikasi detail.</p>
                        @endif
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
    <script src="{{ asset("libs/jquery/jquery-3.6.1.min.js") }}"></script>
    <script src="{{ asset("libs/datatables/js/jquery.dataTables.min.js") }}"></script>
    {{-- custom scripts --}}
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
