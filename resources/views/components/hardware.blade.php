<dl class="row mb-0">
    <dt class="col-sm-5">Nomor Tag Aset</dt>
    <dd class="col-sm-7"><b>:</b> {{ $asset->assetable->asset_tag }}</dd>

    <dt class="col-sm-5">Nomor Seri</dt>
    <dd class="col-sm-7"><b>:</b> {{ $asset->assetable->serial_number ?? "-" }}</dd>

    <dt class="col-sm-5">Model</dt>
    <dd class="col-sm-7"><b>:</b> {{ $asset->assetable->model->name ?? "-" }}</dd>

    <dt class="col-sm-5">Merk</dt>
    <dd class="col-sm-7"><b>:</b> {{ $asset->assetable->model->brand->name ?? "-" }}</dd>

    <dt class="col-sm-5">Kategori</dt>
    <dd class="col-sm-7"><b>:</b> {{ $asset->assetable->model->category->name ?? "-" }}</dd>

    <dt class="col-sm-5">Garansi Berakhir</dt>
    <dd class="col-sm-7"><b>:</b> {{ $asset->purchase_date ? date("d-m-Y", strtotime($asset->purchase_date)) : "-" }}</dd>
</dl>
