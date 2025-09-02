@extends("layouts.app")

@section("title")
    SmartSupport &mdash; Detail Aset
@endsection

@section("styles")
    <link href="{{ asset("libs/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet">
    <link href="{{ asset("css/styles.min.css") }}" rel="stylesheet">
    <link href="{{ asset("css/icons.css") }}" rel="stylesheet">
@endsection

@section("content")
    <div class="container-fluid">
        <div class="row my-4">
            <div class="col-12">
                <h1 class="fw-semibold fs-20 mb-3">
                    Detail Aset
                </h1>
                <a class="btn btn-secondary mb-3" href="{{ route("assets.index") }}"><i class="ri-arrow-left-line"></i> Kembali</a>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card custom-card h-100">
                            <div class="card-header">
                                <div class="card-title">
                                    Informasi Umum
                                </div>
                            </div>
                            <div class="card-body pb-0">
                                <div class="row gy-4">
                                    <div class="col-12">
                                        <dl class="row mb-0">
                                            <dt class="col-sm-5">Nama Aset</dt>
                                            <dd class="col-sm-7"><b>:</b> {{ $asset->name }}</dd>

                                            <dt class="col-sm-5">Tipe Aset</dt>
                                            <dd class="col-sm-7"><b>:</b> {{ $asset->assetType }}</dd>

                                            <dt class="col-sm-5">Status</dt>
                                            <dd class="col-sm-7"><b>:</b> {{ $asset->status->name ?? "-" }}</dd>

                                            <dt class="col-sm-5">Lokasi</dt>
                                            <dd class="col-sm-7"><b>:</b> {{ $asset->location->name ?? "-" }}</dd>

                                            <dt class="col-sm-5">Bagian / Section</dt>
                                            <dd class="col-sm-7"><b>:</b> {{ $asset->user->section->name ?? "-" }}</dd>

                                            <dt class="col-sm-5">Pengguna / Penanggung Jawab</dt>
                                            <dd class="col-sm-7"><b>:</b> {{ $asset->user->name ?? "-" }}</dd>

                                            <dt class="col-sm-5">Tanggal Pembelian</dt>
                                            <dd class="col-sm-7"><b>:</b> {{ $asset->purchase_date ? date("d-m-Y", strtotime($asset->purchase_date)) : "-" }}</dd>

                                            <dt class="col-sm-5">Catatan</dt>
                                            <dd class="col-sm-7"><b>:</b> {{ $asset->notes ?? "-" }}</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card custom-card h-100">
                            <div class="card-header">
                                <div class="card-title">
                                    Detail Spesifik Aset
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row gy-4">
                                    <div class="col-12">
                                        @if ($asset->assetable instanceof \App\Models\HardwareDetail)
                                            @include("components.hardware", ["details" => $asset->assetable])
                                        @elseif ($asset->assetable instanceof \App\Models\SoftwareLicense)
                                            @include("components.software", ["details" => $asset->assetable])
                                        @elseif ($asset->assetable instanceof \App\Models\DigitalService)
                                            @include("components.digital-service", ["details" => $asset->assetable])
                                        @else
                                            <span class="text-muted">Tidak ada detail aset spesifik.</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <script src="{{ asset("libs/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
@endsection
