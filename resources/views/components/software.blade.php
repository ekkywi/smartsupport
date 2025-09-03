<dl class="row mb-0">
    <dt class="col-sm-5">Kunci Lisensi</dt>
    <dd class="col-sm-7"><b>:</b> {{ $asset->assetable->license_key ?? "-" }}</dd>

    <dt class="col-sm-5">Jumlah Lisensi</dt>
    <dd class="col-sm-7"><b>:</b> {{ $asset->assetable->total_seats ?? "-" }}</dd>

    <dt class="col-sm-5">Tanggal Kadaluarsa</dt>
    <dd class="col-sm-7"><b>:</b> {{ $asset->assetable->expiry_date ? date("d/m/Y", strtotime($asset->assetable->expiry_date)) : "-" }}</dd>
</dl>
