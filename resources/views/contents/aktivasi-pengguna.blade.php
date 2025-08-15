@extends("layouts.app")

@section("title", "SmartSupport — Aktivasi Pengguna")

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
            <h1 class="page-title fw-semibold fs-18 mb-0">Aktivasi Pengguna</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">Management</li>
                        <li aria-current="page" class="breadcrumb-item active"><span>Aktivasi Pengguna</span></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="card-title">
                            Daftar Status Aktivasi Pengguna
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
                                    <th></th>
                                </tr>
                                <tr>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Bagian</th>
                                    <th>Hak Akses</th>
                                    <th>Status Aktivasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->position ?? "-" }}</td>
                                        <td>{{ $user->section ?? "-" }}</td>
                                        <td>{{ $user->role ?? "-" }}</td>
                                        <td>
                                            @if ($user->is_active)
                                                <span class="badge bg-success">Aktif</span>
                                            @else
                                                <span class="badge bg-danger">Tidak Aktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{-- Form untuk toggle aktivasi --}}
                                            <form action="{{ route("users.activation.toggle", ["id" => $user->id]) }}" id="toggle-form-{{ $user->id }}" method="POST" style="display: inline">
                                                @csrf
                                                @method("PATCH")
                                                @if ($user->is_active)
                                                    <button class="btn btn-sm btn-danger toggle-activation-btn" data-action="Nonaktifkan" data-user-id="{{ $user->id }}" type="button">
                                                        Nonaktifkan
                                                    </button>
                                                @else
                                                    <button class="btn btn-sm btn-success toggle-activation-btn" data-action="Aktifkan" data-user-id="{{ $user->id }}" type="button">
                                                        Aktifkan
                                                    </button>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
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
                // ⚙️ SESUAIKAN KODE initComplete INI
                initComplete: function() {
                    this.api().columns().every(function() {
                        let column = this;
                        let title = $(column.header()).text();

                        // Menargetkan sel di baris filter berdasarkan urutan kolom
                        let cell = $('#filters th').eq(column.index());

                        // Lewati kolom "Aksi"
                        if (title === 'Aksi') {
                            cell.html('');
                            return;
                        }

                        // Buat input field dan letakkan di sel header yang baru
                        let input = $('<input type="text" class="form-control form-control-sm" placeholder="Filter ' + title + '" />')
                            .appendTo(cell) // Tidak perlu .empty() karena sel sudah kosong
                            .on('keyup change clear', function() {
                                if (column.search() !== this.value) {
                                    column.search(this.value).draw();
                                }
                            });
                    });
                }
            });

            // Event listener untuk tombol aktivasi/nonaktivasi
            $(document).on('click', '.toggle-activation-btn', function(e) {
                e.preventDefault();
                var userId = $(this).data('user-id');
                var action = $(this).data('action');
                var confirmButtonColor = (action === 'Aktifkan') ? '#28a745' : '#d33';

                Swal.fire({
                    title: "Apakah Anda yakin?",
                    text: "Anda akan " + action.toLowerCase() + " pengguna ini.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: confirmButtonColor,
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Ya, " + action + "!",
                    cancelButtonText: "Batal",
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit form yang sesuai jika dikonfirmasi
                        document.getElementById("toggle-form-" + userId).submit();
                    }
                });
            });
        });
    </script>
    {{-- Script untuk notifikasi dari session --}}
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
