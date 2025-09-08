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

                <li class="slide__category">
                    <span class="category-name">Master Data Aset</span>
                </li>
                <li class="slide has-sub {{ request()->routeIs("asset.status.index", "asset.status.create", "asset.status.edit", "asset.status.trashed") ? "open" : "" }}">
                    <a class="side-menu__item {{ request()->routeIs("asset.status.index", "asset.status.create", "asset.status.edit", "asset.status.trashed") ? "active" : "" }}" href="javascript:void(0);">
                        <i class="bx bx-info-circle side-menu__icon"></i>
                        <span class="side-menu__label">Status Aset</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide">
                            <a class="side-menu__item {{ request()->routeIs("asset.status.index", "asset.status.create", "asset.status.edit", "asset.status.trashed") ? "active" : "" }}" href="{{ route("asset.status.index") }}">Data Status Aset</a>
                        </li>
                    </ul>
                </li>

                <li class="slide has-sub">
                    <a class="side-menu__item" href="javascript:void(0);">
                        <i class="bx bxs-component side-menu__icon"></i>
                        <span class="side-menu__label">Komponen</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide">
                            <a class="side-menu__item" href="#">Data Komponen</a>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" href="#">Jenis Komponen</a>
                        </li>
                    </ul>
                </li>
                <li class="slide has-sub">
                    <a class="side-menu__item" href="javascript:void(0);">
                        <i class="bx bx-devices side-menu__icon"></i>
                        <span class="side-menu__label">Hardware</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide">
                            <a class="side-menu__item" href="#">Data Hardware</a>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" href="#">Jenis Hardware</a>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" href="#">Model Hardware</a>
                        </li>
                    </ul>
                </li>

                @canany(["manage_users", "manage_organizations", "manage_tokens", "manage_administrations"])
                    <li class="slide__category">
                        <span class="category-name">Manajemen Aplikasi</span>
                    </li>

                    @can("manage_users")
                        <li class="slide has-sub {{ request()->routeIs("users.index", "users.create", "users.edit", "users.activation.*") ? "open" : "" }}">
                            <a class="side-menu__item {{ request()->routeIs("users.index", "users.create", "users.edit", "users.activation.*") ? "active" : "" }}" href="javascript:void(0);">
                                <i class="bx bx-user side-menu__icon"></i>
                                <span class="side-menu__label">Pengguna</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">
                                <li class="slide">
                                    <a class="side-menu__item {{ request()->routeIs("users.index", "users.create", "users.edit") ? "active" : "" }}" href="{{ route("users.index") }}">Data Pengguna</a>
                                </li>
                                <li class="slide">
                                    <a class="side-menu__item {{ request()->routeIs("users.activation.*") ? "active" : "" }}" href="{{ route("users.activation.index") }}">Aktivasi Pengguna</a>
                                </li>
                            </ul>
                        </li>
                    @endcan

                    @can("manage_organizations")
                        <li class="slide has-sub {{ request()->routeIs("sections.*", "positions.*") ? "open" : "" }}">
                            <a class="side-menu__item {{ request()->routeIs("sections.*", "positions.*") ? "active" : "" }}" href="javascript:void(0);">
                                <i class="bx bx-building side-menu__icon"></i>
                                <span class="side-menu__label">Organisasi</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">
                                <li class="slide">
                                    <a class="side-menu__item {{ request()->routeIs("sections.*") ? "active" : "" }}" href="{{ route("sections.index") }}">Bagian</a>
                                </li>
                                <li class="slide">
                                    <a class="side-menu__item {{ request()->routeIs("positions.*") ? "active" : "" }}" href="{{ route("positions.index") }}">Jabatan</a>
                                </li>
                            </ul>
                        </li>
                    @endcan

                    @can("manage_tokens")
                        <li class="slide has-sub {{ request()->routeIs("users.token.*") ? "open" : "" }}">
                            <a class="side-menu__item {{ request()->routeIs("users.token.*") ? "active" : "" }}" href="javascript:void(0);">
                                <i class="bx bx-key side-menu__icon"></i>
                                <span class="side-menu__label">Token</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">
                                <li class="slide">
                                    <a class="side-menu__item {{ request()->routeIs("users.token.*") ? "active" : "" }}" href="{{ route("users.token.index") }}">Token Pengguna</a>
                                </li>
                            </ul>
                        </li>
                    @endcan

                    @can("manage_administrations")
                        <li class="slide has-sub {{ request()->routeIs("roles.*", "permissions.*") ? "open" : "" }}">
                            <a class="side-menu__item" href="javascript:void(0);">
                                <i class="bx bx-cog side-menu__icon"></i>
                                <span class="side-menu__label {{ request()->routeIs("roles.*", "permissions.*") ? "active" : "" }}">Administrasi</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">
                                <li class="slide">
                                    <a class="side-menu__item {{ request()->routeIs("roles.*") ? "active" : "" }}" href="{{ route("roles.index") }}">Peran</a>
                                </li>
                                <li class="slide">
                                    <a class="side-menu__item {{ request()->routeIs("permissions.*") ? "active" : "" }}" href="{{ route("permissions.index") }}">Hak Akses</a>
                                </li>
                            </ul>
                        </li>
                    @endcan
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
