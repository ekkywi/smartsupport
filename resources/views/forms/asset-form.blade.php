@extends("layouts.app")

@section("title")
    SmartSupport &mdash; {{ isset($asset) ? "Edit Data Aset" : "Tambah Data Aset" }}
@endsection

@section("styles")
    {{-- main styles --}}
    <link href="{{ asset("images/brand-logos/favicon.ico") }}" rel="icon" type="image/x-icon">
    <link href="{{ asset("libs/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet">
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
            <h1 class="page-title fw-semibold fs-18 mb-0">{{ isset($asset) ? "Edit Data Aset" : "Tambah Data Aset" }}</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb breadcrumb-style2 mb-0">
                        <li class="breadcrumb-item">Management Aset</li>
                        <li class="breadcrumb-item">Aset</li>
                        <li class="breadcrumb-item">Data Aset</li>
                        <li aria-current="page" class="breadcrumb-item active">{{ isset($asset) ? "Edit" : "Tambah" }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-body">
                        <form action="{{ isset($asset) ? route("assets.update", $asset->id) : route("assets.store") }}" class="row gy-4" method="POST">
                            @csrf
                            @if (isset($asset))
                                @method("PUT")
                            @endif

                            {{-- ===================== --}}
                            {{-- BAGIAN INFORMASI UMUM --}}
                            {{-- ===================== --}}
                            <div class="card-header">
                                <div class="card-title">
                                    Informasi Umum Aset
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label" for="name">Nama Aset</label>
                                <input class="form-control @error("name") is-invalid @enderror" name="name" placeholder="e.g., Laptop Dell untuk Tim HRD" required type="text" value="{{ old("name", $asset->name ?? "") }}">
                                @error("name")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="status_id">Status</label>
                                <select class="form-select @error("status_id") is-invalid @enderror" name="status_id" required>
                                    <option disabled value="">Pilih Status...</option>
                                    @foreach ($statuses as $status)
                                        <option {{ old("status_id", $asset->status_id ?? "") == $status->id ? "selected" : "" }} value="{{ $status->id }}">
                                            {{ $status->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error("status_id")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="location_id">Lokasi</label>
                                <select class="form-select @error("location_id") is-invalid @enderror" name="location_id">
                                    <option disabled value="">Pilih Lokasi...</option>
                                    @foreach ($locations as $location)
                                        <option {{ old("location_id", $asset->location_id ?? "") == $location->id ? "selected" : "" }} value="{{ $location->id }}">
                                            {{ $location->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error("location_id")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="assigned_to_user_id">Pengguna</label>
                                <select class="form-select @error("assigned_to_user_id") is-invalid @enderror" name="assigned_to_user_id">
                                    <option disabled value="">Pilih Pengguna...</option>
                                    @foreach ($users as $user)
                                        <option {{ old("assigned_to_user_id", $asset->assigned_to_user_id ?? "") == $user->id ? "selected" : "" }} value="{{ $user->id }}">
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error("user_id")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label class="form-label" for="notes">Catatan</label>
                                <textarea class="form-control @error("notes") is-invalid @enderror" name="notes" rows="3">{{ old("notes", $asset->notes ?? "") }}</textarea>
                                @error("notes")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- ===================== --}}
                            {{-- BAGIAN DETAIL ASET (DINAMIS) --}}
                            {{-- ===================== --}}
                            <div class="card-header">
                                <div class="card-title">
                                    Detail Spesifik Aset
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label" for="asset_type">Jenis Aset</label>
                                <select class="form-select @error("asset_type") is-invalid @enderror" id="asset_type" name="asset_type" required>
                                    <option disabled value="">Pilih Jenis Aset...</option>
                                    <option {{ old("asset_type", $asset->asset_type ?? "") == "hardware" ? "selected" : "" }} value="hardware">Hardware</option>
                                    <option {{ old("asset_type", $asset->asset_type ?? "") == "software" ? "selected" : "" }} value="software">Software</option>
                                    <option {{ old("asset_type", $asset->asset_type ?? "") == "digital_service" ? "selected" : "" }} value="digital_service">Layanan Digital</option>
                                </select>
                                @error("asset_type")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Bagian Form untuk Hardware --}}
                            <div class="row gy-4 ms-1" id="hardware-fields" style="display:none;">
                                <div class="col-md-6">
                                    <label class="form-label" for="asset_tag">Nomor Aset (QR Code)</label>
                                    <input class="form-control" name="asset_tag" type="text" value="{{ old("asset_tag", $asset->asset_tag ?? "") }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="serial_number">Nomor Seri</label>
                                    <input class="form-control" name="serial_number" type="text" value="{{ old("serial_number", $asset->serial_number ?? "") }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="model_id">Model</label>
                                    <select class="form-select" name="model_id">
                                        <option disabled value="">Pilih Model...</option>
                                        @foreach ($models as $model)
                                            <option {{ old("model_id", $asset->model_id ?? "") == $model->id ? "selected" : "" }} value="{{ $model->id }}">
                                                {{ $model->name }} ({{ $model->brand->name }} - {{ $model->category->name }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="purchase_date">Tanggal Pembelian</label>
                                    <div class="input-group">
                                        <div class="input-group-text text-muted"> <i class="ri-calendar-line"></i> </div>
                                        <input class="form-control" id="date" name="purchase_date" placeholder="Pilih tanggal" type="date" value="{{ old("purchase_date", isset($asset->purchase_date) ? $asset->purchase_date->format("Y-m-d") : "") }}">
                                    </div>
                                </div>
                                {{-- ... input hardware lainnya --}}
                            </div>

                            {{-- Bagian Form untuk Software --}}
                            <div class="row gy-4 ms-1" id="software-fields" style="display:none;">
                                <div class="col-md-6">
                                    <label class="form-label" for="license_key">Kunci Lisensi</label>
                                    <input class="form-control" name="license_key" type="text" value="{{ old("license_key", $asset->license_key ?? "") }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="total_seats">Jumlah Lisensi (Seats)</label>
                                    <input class="form-control" name="total_seats" type="number" value="{{ old("total_seats", $asset->total_seats ?? 1) }}">
                                </div>
                            </div>

                            {{-- Bagian Form untuk Layanan Digital --}}
                            <div class="row gy-4 ms-1" id="digital-service-fields" style="display:none;">
                                <div class="col-md-6">
                                    <label class="form-label" for="provider">Provider</label>
                                    <input class="form-control" name="provider" placeholder="e.g., Niagahoster" type="text" value="{{ old("provider", $asset->provider ?? "") }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="service_name">Nama Layanan</label>
                                    <input class="form-control" name="service_name" placeholder="e.g., perusahaan.com" type="text" value="{{ old("service_name", $asset->service_name ?? "") }}">
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-end gap-2 mt-4">
                                <a class="btn btn-danger" href="{{ route("assets.index") }}">Batal</a>
                                <button class="btn btn-primary" type="submit">Simpan Aset</button>
                            </div>
                        </form>
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
    <script src="{{ asset("libs/jquery/jquery-3.6.1.min.js") }}"></script>
    <script src="{{ asset("libs/flatpickr/flatpickr.min.js") }}"></script>
    <script src="{{ asset("js/date&time_pickers.js") }}"></script>

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
    <script>
        $(document).ready(function() {
            function toggleAssetFields() {
                var assetType = $('#asset_type').val();
                // Sembunyikan semua field detail terlebih dahulu
                $('#hardware-fields').hide();
                $('#software-fields').hide();
                $('#digital-service-fields').hide();

                // Tampilkan field yang sesuai
                if (assetType === 'hardware') {
                    $('#hardware-fields').show();
                } else if (assetType === 'software') {
                    $('#software-fields').show();
                } else if (assetType === 'digital_service') {
                    $('#digital-service-fields').show();
                }
            }

            // Jalankan fungsi saat halaman pertama kali dimuat (untuk menangani old input dan edit)
            toggleAssetFields();

            // Jalankan fungsi setiap kali dropdown "Jenis Aset" berubah
            $('#asset_type').on('change', toggleAssetFields);
        });
    </script>
@endsection
