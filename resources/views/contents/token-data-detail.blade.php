@extends("layouts.app")

@section("title")
    SmartSupport &mdash; Detail Token {{ $user->name }}
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
            <h1 class="page-title fw-semibold fs-18 mb-0">Detail Token</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb breadcrumb-style2 mb-0">
                        <li class="breadcrumb-item"><i class="ti ti-home-2 me-1 fs-15 d-inline-block"></i>Management</li>
                        <li class="breadcrumb-item"><i class="bx bxs-key me-1 fs-15 d-inline-block"></i>Token</li>
                        <li class="breadcrumb-item"><a href="{{ route("users.token.index") }}"><i class="ti ti-key me-1 fs-15 d-inline-block"></i>Data Token</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route("users.token.show", $user->id) }}"><i class="ti ti-search me-1 fs-15 d-inline-block"></i>Detail Token</a></li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">Daftar Token : {{ $user->name }}</div>
            </div>
            <div class="card-body border-bottom">
                <div class="d-flex align-items-center gap-2">
                    <form action="{{ route("users.token.generate", $user->id) }}" id="generate-activation-form" method="POST">
                        @csrf
                        <input name="type" type="hidden" value="Aktivasi">
                        <button class="btn btn-sm btn-success generate-token-btn" data-type="Aktivasi" type="button">
                            <i class="ti ti-checkbox me-1"></i> Generate Token Aktivasi
                        </button>
                    </form>
                    <form action="{{ route("users.token.generate", $user->id) }}" id="generate-reset-form" method="POST">
                        @csrf
                        <input name="type" type="hidden" value="Reset">
                        <button class="btn btn-sm btn-warning generate-token-btn" data-type="Reset" type="button">
                            <i class="ti ti-refresh me-1"></i> Generate Token Reset
                        </button>
                    </form>
                    <a class="btn btn-sm btn-secondary ms-auto" href="{{ route("users.token.index") }}"><i class="ti ti-arrow-left me-1"></i>Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="responsiveDataTable" style="width:100%">
                    <thead>
                        <tr id="filters">
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>Tipe</th>
                            <th>Status</th>
                            <th>Tanggal Dibuat</th>
                            <th>Tanggal Kadaluarsa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($user->tokens as $token)
                            <tr>
                                <td>{{ $token->type }}</td>
                                <td>
                                    @if ($token->is_used)
                                        <span class="badge bg-secondary">Sudah Digunakan</span>
                                    @elseif ($token->expired_at && $token->expired_at->isPast())
                                        <span class="badge bg-danger">Kadaluarsa</span>
                                    @else
                                        <span class="badge bg-success">Berlaku</span>
                                    @endif
                                </td>
                                <td>{{ $token->created_at->format("d M Y H:i") }}</td>
                                <td>{{ $token->expired_at ? $token->expired_at->format("d M Y H:i") : "-" }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="5">Pengguna ini tidak memiliki token.</td>
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
    <script>
        $(document).ready(function() {
            $('.generate-token-btn').on('click', function(e) {
                e.preventDefault();
                let form = $(this).closest('form');
                let tokenType = $(this).data('type');

                Swal.fire({
                    title: `Generate Token ${tokenType}?`,
                    text: `Token ${tokenType} lama yang belum terpakai akan dinonaktifkan. Lanjutkan?`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, Generate!",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: form.attr('action'),
                            data: form.serialize(),
                            success: function(response) {
                                Swal.fire({
                                    title: response.message,
                                    html: `
                                <p>Berikan token di bawah ini kepada pengguna:</p>
                                <input type="text" value="${response.plain_token}" class="form-control text-center my-2" id="token-to-copy" readonly>
                                <p class="fs-11 text-muted">Token ini hanya ditampilkan sekali.</p>
                                `,
                                    showCancelButton: true,
                                    confirmButtonText: '<i class="ti ti-copy"></i> Salin & Tutup',
                                    cancelButtonText: 'Tutup',
                                    didOpen: () => {
                                        $('#token-to-copy').select();
                                    }
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // Salin ke clipboard
                                        navigator.clipboard.writeText(response.plain_token)
                                            .then(() => {
                                                // 👇 JIKA BERHASIL DISALIN, TAMPILKAN NOTIFIKASI KEDUA
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Disalin!',
                                                    text: 'Token telah berhasil disalin ke clipboard.',
                                                    timer: 2000,
                                                    showConfirmButton: false
                                                }).then(() => {
                                                    // Setelah notifikasi kedua selesai, baru muat ulang halaman
                                                    location.reload();
                                                });
                                            })
                                            .catch(() => {
                                                Swal.fire('Gagal Menyalin', 'Tidak dapat menyalin token.', 'error');
                                            });
                                    } else {
                                        // Jika pengguna menekan 'Tutup', muat ulang halaman
                                        location.reload();
                                    }
                                });
                            },
                            error: function() {
                                Swal.fire('Gagal!', 'Terjadi kesalahan saat membuat token.', 'error');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
