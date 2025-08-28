@extends("layouts.app")

@section("title")
    SmartSupport &mdash; Kategori Aset
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
            <h1 class="page-title fw-semibold fs-18 mb-0">Kategori Aset</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb breadcrumb-style2 mb-0">
                        <li class="breadcrumb-item">Management Aset</li>
                        <li class="breadcrumb-item">Master Data Aset</li>
                        <li aria-current="page" class="breadcrumb-item active">Kategori Aset</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="mb-3">
            <button class="btn btn-success" id="addCategoryBtn">
                <i class="ti ti-plus"></i> Tambah Kategori
            </button>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="card-title">
                            Data Kategori Aset
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered text-nowrap" id="responsiveDataTable" style="width:100%">
                            <thead>
                                <tr id="filters">
                                    <th></th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th>Nama Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assetCategories as $category)
                                    <tr>
                                        <td>{{ $category->name ?? "-" }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary edit-btn" data-id="{{ $category->id }}" data-name="{{ $category->name }}">
                                                <i class="ti ti-pencil me-1"></i>Edit
                                            </button>

                                            <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $category->id }}">
                                                <i class="ti ti-trash me-1"></i>Hapus
                                            </button>
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

    {{-- Modal Form --}}
    <div aria-hidden="true" aria-labelledby="categoryModalLabel" class="modal fade" id="categoryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModalLabel">Form Kategori</h5>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"></button>
                </div>
                <div class="modal-body">
                    <form id="categoryForm">
                        @csrf
                        <input id="formMethod" name="_method" type="hidden">
                        <input id="categoryId" name="id" type="hidden">

                        <div class="mb-3">
                            <label class="form-label" for="name">Nama Kategori</label>
                            <input class="form-control" id="name" name="name" required type="text">
                            <div class="invalid-feedback" id="name-error"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Tutup</button>
                    <button class="btn btn-primary" id="saveBtn" type="button">Simpan</button>
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

    <script>
        $(function() {

            // Setup CSRF token untuk semua ajax
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            // DataTable
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

            function resetForm() {
                $('#categoryForm')[0].reset();
                $('#categoryId').val('');
                $('#formMethod').val('');
                $('#name').removeClass('is-invalid');
                $('#name-error').text('').hide();
            }

            // Tambah
            $('#addCategoryBtn').on('click', function() {
                resetForm();
                $('#categoryModalLabel').text('Tambah Kategori');
                $('#categoryModal').modal('show');
            });

            // Edit
            $('.edit-btn').on('click', function() {
                resetForm();
                $('#categoryModalLabel').text('Edit Kategori');
                $('#categoryId').val($(this).data('id'));
                $('#name').val($(this).data('name'));
                $('#formMethod').val('PUT');
                $('#categoryModal').modal('show');
            });

            // Simpan (Tambah/Edit)
            $('#saveBtn').on('click', function() {
                let id = $('#categoryId').val();
                let url = id ? '/kategori-aset/' + id : '/kategori-aset';
                let method = id ? 'PUT' : 'POST';

                let formData = $('#categoryForm').serialize();
                if (id) formData += '&_method=PUT';

                $('#saveBtn').prop('disabled', true).text('Menyimpan...');
                $.post(url, formData)
                    .done(function(res) {
                        $('#saveBtn').prop('disabled', false).text('Simpan');
                        $('#categoryModal').modal('hide');
                        Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: res.message || 'Data berhasil disimpan.',
                                timer: 2000,
                                showConfirmButton: false
                            })
                            .then(() => location.reload());
                    })
                    .fail(function(xhr) {
                        $('#saveBtn').prop('disabled', false).text('Simpan');
                        if (xhr.status === 422) {
                            let err = xhr.responseJSON.errors;
                            if (err.name) {
                                $('#name').addClass('is-invalid');
                                $('#name-error').text(err.name[0]).show();
                            }
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: xhr.responseJSON?.message || 'Terjadi kesalahan.'
                            });
                        }
                    });
            });

            // Hapus
            $('.delete-btn').on('click', function() {
                let id = $(this).data('id');
                Swal.fire({
                    title: 'Hapus data?',
                    text: "Data kategori akan dihapus permanen.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.post('/kategori-aset/' + id, {
                                _method: 'DELETE'
                            })
                            .done(function(res) {
                                Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil!',
                                        text: res.message || 'Data berhasil dihapus.',
                                        timer: 1500,
                                        showConfirmButton: false
                                    })
                                    .then(() => location.reload());
                            })
                            .fail(function(xhr) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: xhr.responseJSON?.message || 'Terjadi kesalahan.'
                                });
                            });
                    }
                });
            });

            // Reset validasi saat modal ditutup
            $('#categoryModal').on('hidden.bs.modal', resetForm);
        });
    </script>
@endsection
