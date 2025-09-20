@extends("layouts.app")

@section("title")
    SmartSupport &mdash; {{ isset($componentModel) ? "Edit" : "Tambah" }} Model Komponen
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
@endsection

@section("content")
    <div class="container-fluid">
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-18 mb-0">{{ isset($componentModel) ? "Edit" : "Tambah" }} Model Komponen</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb breadcrumb-style2 mb-0">
                        <li class="breadcrumb-item">Master Data Aset</li>
                        <li class="breadcrumb-item">Komponen</li>
                        <li class="breadcrumb-item">Model Komponen</li>
                        <li aria-current="page" class="breadcrumb-item active">{{ isset($componentModel) ? "Edit" : "Tambah" }} Model Komponen</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title">
                            Form {{ isset($componentModel) ? "Edit" : "Tambah" }} Model Komponen
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ isset($componentModel) ? route("component.models.update", $componentModel->id) : route("component.models.store") }}" autocomplete="off" class="row gy-4" method="POST">
                            @csrf
                            @if (isset($componentModel))
                                @method("PUT")
                            @endif
                            <div class="col-xl-12">
                                <h6 class="fw-bold mb-3 text-primary">Informasi Umum Model</h6>
                                <hr>
                                <div class="row justify-content-between gy-3">
                                    <div class="col-xl-6 col-lg-8 col-md-8 col-sm-12 mb-3">
                                        <label class="form-label text-default fw-semibold" for="name">Nama Model Komponen</label>
                                        <input class="form-control" id="name" name="name" placeholder="Nama Model Komponen" type="text" value="{{ old("name", isset($componentModel) ? $componentModel->name : "") }}">
                                    </div>
                                    <div class="col-xl-6 col-lg-8 col-md-8 col-sm-12 mb-3">
                                        <label class="form-label text-default fw-semibold" for="component_model_code">Kode Model Komponen</label>
                                        <input class="form-control" id="component_model_code" name="component_model_code" placeholder="Kode Model Komponen" type="text" value="{{ old("component_model_code", isset($componentModel) ? $componentModel->component_model_code : "") }}">
                                    </div>
                                    <div class="col-xl-6 col-lg-8 col-md-8 col-sm-12 mb-3">
                                        <label class="form-label text-default fw-semibold" for="component_type_id">Jenis Komponen</label>
                                        <select class="form-select" id="component_type_id" name="component_type_id">
                                            <option value="">Pilih Tipe Komponen</option>
                                            @foreach ($componentTypes as $componentType)
                                                <option {{ old("component_type_id", isset($componentModel) ? $componentModel->component_type_id : "") == $componentType->id ? "selected" : "" }} value="{{ $componentType->id }}">
                                                    {{ $componentType->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <!-- Input hidden untuk tipe komponen, terisi otomatis JS -->
                                        <input id="component_type_model" name="component_type_model" type="hidden" value="{{ old("component_type_model", isset($componentModel) ? $componentModel->component_type_model : "") }}">
                                    </div>
                                    <div class="col-xl-6 col-lg-8 col-md-8 col-sm-12 mb-3">
                                        <label class="form-label text-default fw-semibold" for="brand_id">Merek Komponen</label>
                                        <select class="form-select" id="brand_id" name="brand_id">
                                            <option value="">Pilih Merek Komponen</option>
                                            @foreach ($brands as $brand)
                                                <option {{ old("brand_id", isset($componentModel) ? $componentModel->brand_id : "") == $brand->id ? "selected" : "" }} value="{{ $brand->id }}">
                                                    {{ $brand->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <h6 class="fw-bold mb-3 mt-4 text-primary">Informasi Spesifikasi</h6>
                                <hr>
                                <div class="col-xl-6 col-lg-8 col-md-8 col-sm-12 mb-3" id="spec-fields">
                                    <!-- Dynamic specification fields will be inserted here based on component type -->
                                </div>
                                <h6 class="fw-bold mb-3 mt-4 text-primary">Informasi Lainnya</h6>
                                <hr>
                                <div class="row justify-content-between gy-3">
                                    <div class="col-xl-6 col-lg-8 col-md-8 col-sm-12 mb-3">
                                        <label class="form-label text-default fw-semibold" for="description">Deskripsi</label>
                                        <textarea class="form-control" id="description" name="description" rows="3">{{ old("description", isset($componentModel) ? $componentModel->description : "") }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end gap-2 mt-4">
                                    <button class="btn btn-danger" onclick="goToIndex()" type="button"><i class="ti ti-x"></i> Batal</button>
                                    <button class="btn btn-secondary" onclick="clearFormInputs()" type="button"><i class="ti ti-trash"></i> Hapus</button>
                                    <button class="btn btn-primary" type="submit"><i class="ti ti-check"></i> {{ isset($componentModel) ? "Update" : "Simpan" }}</button>
                                </div>
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
        function clearFormInputs() {
            document.getElementById('name').value = '';
            document.getElementById('asset_tag_id').value = '';
        }

        function goToIndex() {
            window.location.href = "{{ route("component.models.index") }}";
        }
    </script>
    <script>
        const oldSpecs = @json(old("specs", isset($componentModel) ? $componentModel->specs : []));
        // Mapping UUID ke nama tipe dari backend
        const componentTypeMap = @json($componentTypes->pluck("name", "id"));
        // SpecFields: Kode sama seperti sebelumnya
        const specFields = {
            RAM: `
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Kapasitas (GB)</label>
            <input class="form-control mb-2" type="text" name="specs[capacity]" placeholder="Kapasitas (GB)">
        </div>
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Jumlah Modul</label>
            <input class="form-control mb-2" type="text" name="specs[modules]" placeholder="1X4GB, 2X8GB,">
            </div>
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Tipe RAM</label>
            <select class="form-select mb-2" name="specs[type]">
                <option value="">Pilih Tipe RAM</option>
                <option value="DDR2">DDR2</option>
                <option value="DDR3">DDR3</option>
                <option value="DDR4">DDR4</option>
                <option value="DDR5">DDR5</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">ECC/Non-ECC</label>
            <select class="form-select mb-2" name="specs[ecc]">
                <option value="">Pilih ECC/Non-ECC</option>
                <option value="ECC">ECC</option>
                <option value="Non-ECC">Non-ECC</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Form Factor</label>
            <select class="form-select mb-2" name="specs[form_factor]">
                <option value="">Pilih Form Factor</option>
                <option value="DIMM">DIMM</option>
                <option value="SO-DIMM">SO-DIMM</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Frekuensi (MHz)</label>
            <input class="form-control mb-2" type="text" name="specs[speed]" placeholder="Frekuensi (MHz)">
        </div>
    `,
            HDD: `
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Kapasitas</label>
            <input class="form-control mb-2" type="number" name="specs[capacity]" placeholder="Contoh: 1000">
        </div>
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Satuan Kapasitas</label>
            <select class="form-select mb-2" name="specs[capacity_unit]">
                <option value="GB">GB</option>
                <option value="TB">TB</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Form Factor</label>
            <select class="form-select mb-2" name="specs[form_factor]">
                <option value="">Pilih Form Factor</option>
                <option value="3.5 inch">3.5 inch</option>
                <option value="2.5 inch">2.5 inch</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Interface/Konektor</label>
            <select class="form-select mb-2" name="specs[interface]">
                <option value="">Pilih Interface</option>
                <option value="SATA">SATA</option>
                <option value="IDE">IDE</option>
                <option value="USB">USB</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">RPM</label>
            <input class="form-control mb-2" type="number" name="specs[rpm]" placeholder="Contoh: 7200">
        </div>
    `,
            SSD: `
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Kapasitas</label>
            <input class="form-control mb-2" type="number" name="specs[capacity]" placeholder="Contoh: 512">
        </div>
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Satuan Kapasitas</label>
            <select class="form-select mb-2" name="specs[capacity_unit]">
                <option value="GB">GB</option>
                <option value="TB">TB</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Form Factor</label>
            <select class="form-select mb-2" name="specs[form_factor]">
                <option value="">Pilih Form Factor</option>
                <option value="2.5 inch">2.5 inch</option>
                <option value="M.2">M.2</option>
                <option value="PCIe">PCIe</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Interface/Konektor</label>
            <select class="form-select mb-2" name="specs[interface]">
                <option value="">Pilih Interface</option>
                <option value="SATA">SATA</option>
                <option value="NVMe">NVMe</option>
                <option value="PCIe">PCIe</option>
                <option value="USB">USB</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Kecepatan Baca (MB/s)</label>
            <input class="form-control mb-2" type="number" name="specs[read_speed]" placeholder="Contoh: 3500">
        </div>
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Kecepatan Tulis (MB/s)</label>
            <input class="form-control mb-2" type="number" name="specs[write_speed]" placeholder="Contoh: 3200">
        </div>
    `,
            FlashDrive: `
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Kapasitas</label>
            <input class="form-control mb-2" type="number" name="specs[capacity]" placeholder="Contoh: 32">
        </div>
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Satuan Kapasitas</label>
            <select class="form-select mb-2" name="specs[capacity_unit]">
                <option value="GB">GB</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Interface/Konektor</label>
            <select class="form-select mb-2" name="specs[interface]">
                <option value="">Pilih Interface</option>
                <option value="USB 2.0">USB 2.0</option>
                <option value="USB 3.0">USB 3.0</option>
                <option value="USB 3.1">USB 3.1</option>
                <option value="USB 3.2">USB 3.2</option>
                <option value="USB-C">USB-C</option>
                <option value="Lightning">Lightning</option>
                <option value="Thunderbolt">Thunderbolt</option>
                <option value="Dual USB-A & USB-C">Dual USB-A & USB-C</option>
            </select>
        </div>
    `,
            "SDCard": `
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Kapasitas</label>
            <input class="form-control mb-2" type="number" name="specs[capacity]" placeholder="Contoh: 64">
        </div>
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Satuan Kapasitas</label>
            <select class="form-select mb-2" name="specs[capacity_unit]">
                <option value="GB">GB</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Class/UHS</label>
            <select class="form-select mb-2" name="specs[class_uhs]">
                <option value="">Pilih Class/UHS</option>
                <option value="Class 10">Class 10</option>
                <option value="UHS-I">UHS-I</option>
                <option value="UHS-II">UHS-II</option>
                <option value="V30">V30</option>
                <option value="A1">A1</option>
            </select>
        </div>
    `,
            MicroSD: `
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Kapasitas</label>
            <input class="form-control mb-2" type="number" name="specs[capacity]" placeholder="Contoh: 128">
        </div>
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Satuan Kapasitas</label>
            <select class="form-select mb-2" name="specs[capacity_unit]">
                <option value="GB">GB</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Class/UHS</label>
            <select class="form-select mb-2" name="specs[class_uhs]">
                <option value="">Pilih Class/UHS</option>
                <option value="Class 10">Class 10</option>
                <option value="UHS-I">UHS-I</option>
                <option value="UHS-II">UHS-II</option>
                <option value="V30">V30</option>
                <option value="A1">A1</option>
            </select>
        </div>
    `,
            Motherboard: `
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Form Factor</label>
            <select class="form-select mb-2" name="specs[form_factor]">
                <option value="">Pilih Form Factor</option>
                <option value="ATX">ATX</option>
                <option value="Micro ATX">Micro ATX</option>
                <option value="Mini ITX">Mini ITX</option>
                <option value="E-ATX">E-ATX</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Socket CPU</label>
            <input class="form-control mb-2" type="text" name="specs[socket]" placeholder="Contoh: LGA1200, AM4">
        </div>
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Chipset</label>
            <input class="form-control mb-2" type="text" name="specs[chipset]" placeholder="Contoh: B560, X570, H610">
        </div>
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Slot RAM</label>
            <input class="form-control mb-2" type="number" name="specs[ram_slots]" placeholder="Jumlah Slot RAM">
        </div>
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Tipe RAM</label>
            <select class="form-select mb-2" name="specs[ram_type]">
                <option value="">Pilih Tipe RAM</option>
                <option value="DDR3">DDR3</option>
                <option value="DDR4">DDR4</option>
                <option value="DDR5">DDR5</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Jumlah Slot SATA</label>
            <input class="form-control mb-2" type="number" name="specs[sata_ports]" placeholder="Jumlah Port SATA">
        </div>
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Jumlah Slot M.2</label>
            <input class="form-control mb-2" type="number" name="specs[m2_slots]" placeholder="Jumlah Slot M.2">
        </div>
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Konektivitas Jaringan</label>
            <select class="form-select mb-2" name="specs[network]">
                <option value="">Pilih Konektivitas</option>
                <option value="LAN">LAN</option>
                <option value="WiFi">WiFi</option>
                <option value="LAN + WiFi">LAN + WiFi</option>
            </select>
        </div>
    `,
            PowerSupply: `
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Kapasitas Daya</label>
            <input class="form-control mb-2" type="number" name="specs[power]" placeholder="Contoh: 450">
        </div>
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Satuan Daya</label>
            <select class="form-select mb-2" name="specs[power_unit]">
                <option value="W">Watt (W)</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Tipe PSU</label>
            <select class="form-select mb-2" name="specs[type]">
                <option value="">Pilih Tipe PSU</option>
                <option value="ATX">ATX</option>
                <option value="SFX">SFX</option>
                <option value="TFX">TFX</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Modularitas Kabel</label>
            <select class="form-select mb-2" name="specs[modularity]">
                <option value="">Pilih Modularitas</option>
                <option value="Non Modular">Non Modular</option>
                <option value="Semi Modular">Semi Modular</option>
                <option value="Full Modular">Full Modular</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Sertifikasi Efisiensi</label>
            <select class="form-select mb-2" name="specs[efficiency]">
                <option value="">Pilih Sertifikasi</option>
                <option value="80 PLUS">80 PLUS</option>
                <option value="80 PLUS Bronze">80 PLUS Bronze</option>
                <option value="80 PLUS Silver">80 PLUS Silver</option>
                <option value="80 PLUS Gold">80 PLUS Gold</option>
                <option value="80 PLUS Platinum">80 PLUS Platinum</option>
                <option value="80 PLUS Titanium">80 PLUS Titanium</option>
            </select>
        </div>
    `,
            CPU: `
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Jumlah Core</label>
            <input class="form-control mb-2" type="number" name="specs[core]" placeholder="Contoh: 6">
        </div>
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Jumlah Thread</label>
            <input class="form-control mb-2" type="number" name="specs[thread]" placeholder="Contoh: 12">
        </div>
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Kecepatan Dasar (GHz)</label>
            <input class="form-control mb-2" type="number" step="0.01" name="specs[speed]" placeholder="Contoh: 3.6">
        </div>
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Kecepatan Boost (GHz)</label>
            <input class="form-control mb-2" type="number" step="0.01" name="specs[boost_speed]" placeholder="Contoh: 4.2">
        </div>
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Socket</label>
            <input class="form-control mb-2" type="text" name="specs[socket]" placeholder="Contoh: LGA1200, AM4">
        </div>
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">TDP (Watt)</label>
            <input class="form-control mb-2" type="number" name="specs[tdp]" placeholder="Contoh: 65">
        </div>
    `,
            GPU: `
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">VRAM (GB)</label>
            <input class="form-control mb-2" type="number" name="specs[vram]" placeholder="Contoh: 8">
        </div>
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Tipe Memory</label>
            <select class="form-select mb-2" name="specs[memory_type]">
                <option value="">Pilih Tipe Memory</option>
                <option value="GDDR5">GDDR5</option>
                <option value="GDDR6">GDDR6</option>
                <option value="GDDR6X">GDDR6X</option>
                <option value="HBM2">HBM2</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Base Clock (MHz)</label>
            <input class="form-control mb-2" type="number" name="specs[base_clock]" placeholder="Contoh: 1320">
        </div>
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Boost Clock (MHz)</label>
            <input class="form-control mb-2" type="number" name="specs[boost_clock]" placeholder="Contoh: 1777">
        </div>
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Interface</label>
            <select class="form-select mb-2" name="specs[interface]">
                <option value="">Pilih Interface</option>
                <option value="PCIe 3.0">PCIe 3.0</option>
                <option value="PCIe 4.0">PCIe 4.0</option>
                <option value="PCIe 5.0">PCIe 5.0</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Output Port</label>
            <input class="form-control mb-2" type="text" name="specs[output_port]" placeholder="Contoh: HDMI, DisplayPort, DVI, VGA">
        </div>
        <div class="mb-3">
            <label class="form-label text-default fw-semibold">Power Consumption (Watt)</label>
            <input class="form-control mb-2" type="number" name="specs[power]" placeholder="Contoh: 170">
        </div>
    `
        };

        document.addEventListener('DOMContentLoaded', function() {
            const select = document.getElementById('component_type_id');
            const modelInput = document.getElementById('component_type_model');

            function updateFields() {
                const id = select.value;
                const typeName = componentTypeMap[id] || '';
                document.getElementById('spec-fields').innerHTML = specFields[typeName] || '';
                modelInput.value = typeName;

                if (oldSpecs && typeof oldSpecs === 'object') {
                    Object.entries(oldSpecs).forEach(([key, value]) => {
                        const input = document.querySelector(`[name="specs[${key}]"]`);
                        if (input) {
                            if (input.tagName === 'SELECT') {
                                if (value !== null && value !== "") {
                                    input.value = value;
                                    input.dispatchEvent(new Event('change'));
                                } else {
                                    input.selectedIndex = 0;
                                    input.dispatchEvent(new Event('change'));
                                }
                            } else {
                                input.value = value !== null ? value : "";
                            }
                        }
                    });
                }
            }

            select.addEventListener('change', updateFields);
            updateFields();
            console.log('oldSpecs:', oldSpecs);
        });
    </script>
@endsection
