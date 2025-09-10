@extends("layouts.app")

@section("title")
    SmartSupport &mdash; Merk Terhapus
@endsection

@section("styles")
    <link href="{{ asset("images/brand-logos/favicon.ico") }}" rel="icon" type="image/x-icon">
    <link href="{{ asset("libs/bootstrap/css/bootstrap.min.css") }}" id="style" rel="stylesheet">
    <link href="{{ asset("css/styles.min.css") }}" rel="stylesheet">
    <link href="{{ asset("css/icons.css") }}" rel="stylesheet">
    <link href="{{ asset("libs/node-waves/waves.min.css") }}" rel="stylesheet">
    <link href="{{ asset("libs/simplebar/simplebar.min.css") }}" rel="stylesheet">
@endsection

@section("content")
    <div class="container-fluid">
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-18 mb-0">Merk Terhapus (Trash)</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb breadcrumb-style2 mb-0">
                        <li class="breadcrumb-item">Master Data Aset</li>
                        <li class="breadcrumb-item">Supplier dan Vendor</li>
                        <li class="breadcrumb-item">Merk</li>
                        <li class="breadcrumb-item active">Merk Terhapus</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="mb-3 d-flex flex-wrap gap-2">
            <a class="btn btn-secondary mt-3" href="{{ route("brands.index") }}">
                <i class="ti ti-arrow-left"></i> Kembali ke Data Merk
            </a>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="card-title">
                            Daftar Merk Terhapus
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered text-nowrap" id="responsiveDataTable" style="width:100%">
                            <thead>
                                <tr id="filters">
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Tag Merek</th>
                                    <th>Dihapus Pada</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($trashedBrands as $brand)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $brand->name }}</td>
                                        <td>{{ $brand->brand_tag }}</td>
                                        <td>{{ $brand->deleted_at ? $brand->deleted_at->format("d-m-Y H:i") : "-" }}</td>
                                        <td>
                                            <form action="{{ route("brands.restore", $brand->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button class="btn btn-success btn-sm" type="submit">
                                                    <i class="ti ti-history"></i> Restore
                                                </button>
                                            </form>
                                            <form action="{{ route("brands.force.delete", $brand->id) }}" id="delete-form-{{ $brand->id }}" method="POST" style="display: none;">
                                                @csrf
                                                @method("DELETE")
                                            </form>
                                            <button class="btn btn-danger btn-sm delete-btn" data-brand-id="{{ $brand->id }}">
                                                <i class="ti ti-trash"></i> Hapus Permanen
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="6">Tidak ada data status asset yang terhapus.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
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
            $(document).on('click', '.delete-btn', function(e) {
                e.preventDefault();
                var brandId = $(this).data('brand-id');
                Swal.fire({
                    title: "Apakah Anda yakin?",
                    text: "Data yang dihapus tidak dapat dipulihkan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Hapus",
                    cancelButtonText: "Batal",
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById("delete-form-" + brandId).submit();
                    }
                });
            });
        });
    </script>
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
