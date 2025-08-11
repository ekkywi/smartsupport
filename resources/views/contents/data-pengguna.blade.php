@extends("layouts.app")

@section("title", "SmartSupport - Data Pengguna")
@section("content")

    <div class="container-fluid">

        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <h1 class="page-title fw-semibold fs-18 mb-0">Data Pengguna</h1>
            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">Menu Utama</li>
                        <li aria-current="page" class="breadcrumb-item active"><a href="{{ route("data-pengguna") }}">Data Pengguna</a></li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="card-title">
                            Responsive Datatable
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered text-nowrap" id="responsiveDataTable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Bagian</th>
                                    <th>Status Aktivasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Chloe</th>
                                    <td>System Developer</td>
                                    <td>IT</td>
                                    <td>Active</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary">Edit</button>
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </td>
                                </tr>
                                <tr>
                                    <th>John</th>
                                    <td>Project Manager</td>
                                    <td>Management</td>
                                    <td>Inactive</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary">Edit</button>
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
