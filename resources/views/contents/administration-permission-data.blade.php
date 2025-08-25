@extends("layouts.app")

@section("title")
    SmartSupport &mdash; Data Hak Akses
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
            <h1 class="page-title fw-semibold fs-18 mb-0">Hak Akses</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb breadcrumb-style2 mb-0">
                        <li class="breadcrumb-item">>Management</li>
                        <li class="breadcrumb-item">Administrasi</li>
                        <li aria-current="page" class="breadcrumb-item active">Hak Akses</li>
                    </ol>
                </nav>
            </div>
        </div>

        {{-- Kotak Informasi --}}
        <div class="alert alert-info" role="alert">
            <i class="ti ti-info-circle me-1"></i>
            Halaman ini menampilkan semua jenis izin yang tersedia di dalam sistem. Izin baru ditambahkan oleh developer melalui pembaruan aplikasi.
        </div>

        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Daftar Hak Akses
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered text-nowrap" id="responsiveDataTable" style="width:100%">
                    <thead>
                        <tr id="filters">
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th scope="col">Deskripsi Izin</th>
                            <th scope="col">Nama Izin (untuk Kode)</th>
                            <th scope="col">Diberikan Kepada Peran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($permissions as $permission)
                            <tr>
                                <td>
                                    <strong>{{ $permission->description }}</strong>
                                </td>
                                <td>
                                    <code class="fs-13">{{ $permission->name }}</code>
                                </td>
                                <td>
                                    @forelse ($permission->roles as $role)
                                        <span class="badge bg-primary me-1">{{ $role->name }}</span>
                                    @empty
                                        <span class="badge bg-secondary">Belum Diberikan</span>
                                    @endforelse
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="3">Tidak ada data izin ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
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
    <script src="{{ asset("libs/datatables/js/dataTables.bootstrap5.min.js") }}"></script>
    <script src="{{ asset("libs/datatables/js/dataTables.responsive.min.js") }}"></script>
    <script src="{{ asset("libs/datatables/js/dataTables.buttons.min.js") }}"></script>
    <script src="{{ asset("libs/datatables/js/buttons.print.min.js") }}"></script>
    <script src="{{ asset("libs/pdfmake/pdfmake.min.js") }}"></script>
    <script src="{{ asset("libs/pdfmake/vfs_fonts.js") }}"></script>
    <script src="{{ asset("libs/datatables/js/buttons.html5.min.js") }}"></script>
    <script src="{{ asset("libs/jszip/jszip.min.js") }}"></script>
    {{-- custom scripts --}}
    <script>
        $(document).ready(function() {
            $('#responsiveDataTable').DataTable({
                responsive: true,
                initComplete: function() {
                    this.api().columns().every(function() {
                        let column = this;
                        let title = $(column.header()).text();
                        let cell = $('#filters th').eq(column.index());

                        if (title === 'Aksi') {
                            cell.html('');
                            return;
                        }

                        let input = $('<input type="text" class="form-control form-control-sm" placeholder="Filter ' + title + '" />')
                            .appendTo(cell)
                            .on('keyup change clear', function() {
                                if (column.search() !== this.value) {
                                    column.search(this.value).draw();
                                }
                            });
                    });
                }
            });
        });
    </script>
@endsection
