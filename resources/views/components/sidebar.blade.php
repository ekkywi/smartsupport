<!-- Start::app-sidebar -->
<aside class="app-sidebar sticky" id="sidebar">

    <!-- Start::main-sidebar-header -->
    <div class="main-sidebar-header">
        <a class="header-logo" href="{{ route("dashboard") }}">
            <img alt="logo" class="desktop-logo" src="{{ asset("images/brand-logos/logo.png") }}">
            <img alt="logo" class="toggle-logo" src="{{ asset("images/brand-logos/icon.png") }}">
            <img alt="logo" class="desktop-dark" src="{{ asset("images/brand-logos/logo-darkmode.png") }}">
            <img alt="logo" class="toggle-dark" src="{{ asset("images/brand-logos/icon-darkmode.png") }}">
        </a>
    </div>
    <!-- End::main-sidebar-header -->

    <!-- Start::main-sidebar -->
    <div class="main-sidebar" id="sidebar-scroll">

        <!-- Start::nav -->
        <nav class="main-menu-container nav nav-pills flex-column sub-open">
            <div class="slide-left" id="slide-left">
                <svg fill="#7b8191" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                </svg>
            </div>
            <ul class="main-menu">

                <li class="slide__category"><span class="category-name">Menu Utama</span></li>
                <li class="slide">
                    <a class="side-menu__item {{ request()->routeIs("dashboard") ? "active" : "" }}" href="{{ route("dashboard") }}">
                        <i class="bx bx-home side-menu__icon"></i>
                        <span class="side-menu__label">Dashboards</span>
                    </a>
                </li>

                @canany(["manage_asset_statuses", "manage_asset_components", "manage_asset_hardwares", "manage_users", "manage_organizations", "manage_administrations_and_accesses", "manage_suppliers_and_vendors"])
                    <li class="slide__category">
                        <span class="category-name">Pengaturan Aplikasi</span>
                    </li>

                    @canany(["manage_asset_statuses", "manage_asset_components", "manage_asset_hardwares", "manage_suppliers_and_vendors"])
                        <li class="slide has-sub {{ request()->routeIs("asset.status.*", "component.types.*", "hardware.types.*", "brands.*") ? "open" : "" }}">
                            <a class="side-menu__item {{ request()->routeIs("asset.status.*", "component.types.*", "hardware.types.*", "brands.*") ? "active" : "" }}" href="javascript:void(0);">
                                <i class="bx bx-data side-menu__icon"></i>
                                <span class="side-menu__label">Master Data Aset</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">
                                <li class="slide side-menu__label1">
                                    <a href="javascript:void(0)">Master Data Aset</a>
                                </li>

                                @can("manage_asset_components")
                                    <li class="slide has-sub {{ request()->routeIs("component.types.*") ? "open" : "" }}">
                                        <a class="side-menu__item {{ request()->routeIs("component.types.*") ? "active" : "" }}" href="javascript:void(0);">
                                            Komponen
                                            <i class="fe fe-chevron-right side-menu__angle"></i>
                                        </a>
                                        <ul class="slide-menu child2">
                                            <li class="slide">
                                                <a class="side-menu__item" href="javascript:void(0);">Data Komponen</a>
                                            </li>
                                            <li class="slide">
                                                <a class="side-menu__item" href="javascript:void(0);">Model Komponen</a>
                                            </li>
                                            <li class="slide">
                                                <a class="side-menu__item {{ request()->routeIs("component.types.*") ? "active" : "" }}" href="{{ route("component.types.index") }}">Jenis Komponen</a>
                                            </li>
                                        </ul>
                                    </li>
                                @endcan
                                @can("manage_asset_hardwares")
                                    <li class="slide has-sub {{ request()->routeIs("hardware.types.*") ? "open" : "" }}">
                                        <a class="side-menu__item {{ request()->routeIs("hardware.types.*") ? "active" : "" }}" href="javascript:void(0);">Hardware
                                            <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                        <ul class="slide-menu child2">
                                            <li class="slide">
                                                <a class="side-menu__item" href="javascript:void(0);">Data Hardware</a>
                                            </li>
                                            <li class="slide">
                                                <a class="side-menu__item" href="javascript:void(0);">Model Hardware</a>
                                            </li>
                                            <li class="slide">
                                                <a class="side-menu__item {{ request()->routeIs("hardware.types.*") ? "active" : "" }}" href="{{ route("hardware.types.index") }}">Jenis Hardware</a>
                                            </li>
                                        </ul>
                                    </li>
                                @endcan
                                @can("manage_asset_statuses")
                                    <li class="slide has-sub {{ request()->routeIs("asset.status.*") ? "open" : "" }}">
                                        <a class="side-menu__item {{ request()->routeIs("asset.status.*") ? "active" : "" }}" href="javascript:void(0);">
                                            Status Aset
                                            <i class="fe fe-chevron-right side-menu__angle"></i>
                                        </a>
                                        <ul class="slide-menu child2">
                                            <li class="slide">
                                                <a class="side-menu__item {{ request()->routeIs("asset.status.*") ? "active" : "" }}" href="{{ route("asset.status.index") }}">Data Status Aset</a>
                                            </li>
                                        </ul>
                                    </li>
                                @endcan
                                @can("manage_suppliers_and_vendors")
                                    <li class="slide has-sub {{ request()->routeIs("brands.*") ? "open" : "" }}">
                                        <a class="side-menu__item {{ request()->routeIs("brands.*") ? "active" : "" }}" href="javascript:void(0);">
                                            Supplier dan Vendor
                                            <i class="fe fe-chevron-right side-menu__angle"></i>
                                        </a>
                                        <ul class="slide-menu child2">
                                            <li class="slide">
                                                <a class="side-menu__item {{ request()->routeIs("brands.*") ? "active" : "" }}" href="{{ route("brands.index") }}">Merek</a>
                                            </li>
                                            <li class="slide">
                                                <a class="side-menu__item" href="javascript:void(0);">Supplier</a>
                                            </li>
                                            <li class="slide">
                                                <a class="side-menu__item" href="javascript:void(0);">Vendor</a>
                                            </li>
                                            <li class="slide">
                                                <a class="side-menu__item" href="javascript:void(0);">Penyedia Jasa</a>
                                            </li>
                                        </ul>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany

                    @canany(["manage_users", "manage_organizations", "manage_administrations_and_accesses"])
                        <li class="slide has-sub {{ request()->routeIs("users.*", "sections.*", "positions.*", "roles.*", "permissions.*") ? "open" : "" }}">
                            <a class="side-menu__item {{ request()->routeIs("users.*", "sections.*", "positions.*", "roles.*", "permissions.*") ? "active" : "" }}" href="javascript:void(0);">
                                <i class="bx bx-cog side-menu__icon"></i>
                                <span class="side-menu__label">Manajemen Aplikasi</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">
                                <li class="slide side-menu__label1">
                                    <a href="javascript:void(0)">Manajemen Aplikasi</a>
                                </li>
                                @can("manage_users")
                                    <li class="slide has-sub {{ request()->routeIs("users.*") ? "open" : "" }}">
                                        <a class="side-menu__item {{ request()->routeIs("users.*") ? "active" : "" }}" href="javascript:void(0);">
                                            Pengguna
                                            <i class="fe fe-chevron-right side-menu__angle"></i>
                                        </a>
                                        <ul class="slide-menu child2">
                                            <li class="slide">
                                                <a class="side-menu__item {{ request()->routeIs("users.index", "users.create", "users.edit") ? "active" : "" }}" href="{{ route("users.index") }}">Data Pengguna</a>
                                            </li>
                                            <li class="slide">
                                                <a class="side-menu__item {{ request()->routeIs("users.activation.*") ? "active" : "" }}" href="{{ route("users.activation.index") }}">Aktivasi Pengguna</a>
                                            </li>
                                            <li class="slide">
                                                <a class="side-menu__item {{ request()->routeIs("users.token.*") ? "active" : "" }}" href="{{ route("users.token.index") }}">Token Pengguna</a>
                                            </li>
                                        </ul>
                                    </li>
                                @endcan
                                @can("manage_organizations")
                                    <li class="slide has-sub {{ request()->routeIs("sections.*", "positions.*") ? "open" : "" }}">
                                        <a class="side-menu__item {{ request()->routeIs("sections.*", "positions.*") ? "active" : "" }}" href="javascript:void(0);">
                                            Organisasi
                                            <i class="fe fe-chevron-right side-menu__angle"></i>
                                        </a>
                                        <ul class="slide-menu child2">
                                            <li class="slide">
                                                <a class="side-menu__item {{ request()->routeIs("sections.*") ? "active" : "" }}" href="{{ route("sections.index") }}">Data Bagian</a>
                                            </li>
                                            <li class="slide">
                                                <a class="side-menu__item {{ request()->routeIs("positions.*") ? "active" : "" }}" href="{{ route("positions.index") }}">Data Jabatan</a>
                                            </li>
                                        </ul>
                                    </li>
                                @endcan
                                @can("manage_administrations_and_accesses")
                                    <li class="slide has-sub {{ request()->routeIs("roles.*", "permissions.*") ? "open" : "" }}">
                                        <a class="side-menu__item {{ request()->routeIs("roles.*", "permissions.*") ? "active" : "" }}" href="javascript:void(0);">
                                            Administrasi dan Akses
                                            <i class="fe fe-chevron-right side-menu__angle"></i>
                                        </a>
                                        <ul class="slide-menu child2">
                                            <li class="slide">
                                                <a class="side-menu__item {{ request()->routeIs("roles.*") ? "active" : "" }}" href="{{ route("roles.index") }}">Peran Pengguna</a>
                                            </li>
                                            <li class="slide">
                                                <a class="side-menu__item {{ request()->routeIs("permissions.*") ? "active" : "" }}" href="{{ route("permissions.index") }}">Hak Akses Tersedia</a>
                                            </li>
                                        </ul>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany
                @endcanany

                <li class="slide__category">
                    <span class="category-name">Laporan</span>
                </li>
                <li class="slide has-sub {{ request()->routeIs("asset.status.log.*") ? "open" : "" }}">
                    <a class="side-menu__item {{ request()->routeIs("asset.status.log.*") ? "active" : "" }}" href="javascript:void(0);">
                        <i class="bx bx-book-content side-menu__icon"></i>
                        <span class="side-menu__label">Log Sistem</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide">
                            <a class="side-menu__item {{ request()->routeIs("asset.status.log.index") ? "active" : "" }}" href="{{ route("asset.status.log.index") }}">Status Aset</a>
                        </li>
                    </ul>
                </li>

            </ul>
            <div class="slide-right" id="slide-right"><svg fill="#7b8191" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                </svg></div>
        </nav>
        <!-- End::nav -->

    </div>
    <!-- End::main-sidebar -->

</aside>
<!-- End::app-sidebar -->
