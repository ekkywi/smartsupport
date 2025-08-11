@extends("layouts.app")

@section("title", "SmartSupport - Tambah Pengguna")

@section("content")

    <div class="container-fluid">

        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-18 mb-0">Tambah Pengguna</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">Management</li>
                        <li aria-current="page" class="breadcrumb-item active"><a href="{{ route("tambah-pengguna") }}">Tambah Pengguna</a></li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title">
                            Input Types
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row gy-4">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <p class="mb-2 text-muted">Basic Input:</p>
                                <input class="form-control" id="input" type="text">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label class="form-label" for="input-label">Form Input With Label</label>
                                <input class="form-control" id="input-label" type="text">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label class="form-label" for="input-placeholder">Form Input With Placeholder</label>
                                <input class="form-control" id="input-placeholder" placeholder="Placeholder" type="text">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
