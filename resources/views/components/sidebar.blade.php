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

                <li class="slide__category"><span class="category-name">Management</span></li>
                <li class="slide has-sub {{ request()->routeIs("users.index", "users.create", "users.edit", "users.activation", "users.activation.index") ? "open" : "" }}">
                    <a class="side-menu__item {{ request()->routeIs("users.index", "users.create", "users.edit", "users.activation", "users.activation.index") ? "active" : "" }}" href="javascript:void(0);">
                        <i class="bx bx-user side-menu__icon"></i>
                        <span class="side-menu__label">Pengguna</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Pengguna</a>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item {{ request()->routeIs("users.index", "users.create", "users.edit") ? "active" : "" }}" href="{{ route("users.index") }}">Data Pengguna</a>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item {{ request()->routeIs("users.activation.index") ? "active" : "" }}" href="{{ route("users.activation.index") }}">Aktivasi Pengguna</a>
                        </li>
                    </ul>
                </li>

                <li class="slide has-sub {{ request()->routeIs("users.token.index", "users.token.show") ? "open" : "" }}">
                    <a class="side-menu__item {{ request()->routeIs("users.token.index", "users.token.show") ? "active" : "" }}" href="javascript:void(0);">
                        <i class="bx bxs-key side-menu__icon"></i>
                        <span class="side-menu__label">Token</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Token</a>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item {{ request()->routeIs("users.token.index", "users.token.show") ? "active" : "" }}" href="{{ route("users.token.index") }}">Token Pengguna</a>
                        </li>
                    </ul>
                </li>

                <li class="slide has-sub {{ request()->routeIs("sections.index", "positions.index", "sections.create", "sections.edit", "positions.create", "positions.edit") ? "open" : "" }}">
                    <a class="side-menu__item {{ request()->routeIs("sections.index", "positions.index", "sections.create", "sections.edit", "positions.create", "positions.edit") ? "active" : "" }}" href="javascript:void(0);">
                        <i class="bx bxs-business side-menu__icon"></i>
                        <span class="side-menu__label">Organisasi</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Organisasi</a>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item {{ request()->routeIs("sections.index", "sections.create", "sections.edit") ? "active" : "" }}" href="{{ route("sections.index") }}">Bagian</a>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item {{ request()->routeIs("positions.index", "positions.create", "positions.edit") ? "active" : "" }}" href="{{ route("positions.index") }}">Jabatan</a>
                        </li>
                    </ul>
                </li>

                <li class="slide has-sub">
                    <a class="side-menu__item" href="javascript:void(0);">
                        <i class="bx bxs-component side-menu__icon"></i>
                        <span class="side-menu__label">Master Data Aset</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Master Data</a>
                        </li>
                        <li class="slide has-sub">
                            <a class="side-menu__item" href="javascript:void(0);">Hardware
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child2">
                                <li class="slide">
                                    <a class="side-menu__item" href="#">Perangkat Utama</a>
                                </li>
                                <li class="slide">
                                    <a class="side-menu__item" href="#">Komponen Internal</a>
                                </li>
                                <li class="slide">
                                    <a class="side-menu__item" href="#">Aksesori dan Perlengkapan</a>
                                </li>
                                <li class="slide">
                                    <a class="side-menu__item" href="#">Perlengkapan Jaringan</a>
                                </li>
                            </ul>
                        </li>
                        <li class="slide has-sub">
                            <a class="side-menu__item" href="javascript:void(0);">Software
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child2">
                                <li class="slide">
                                    <a class="side-menu__item" href="#">Lisensi</a>
                                </li>
                            </ul>
                        </li>
                        <li class="slide has-sub">
                            <a class="side-menu__item" href="javascript:void(0);">Server
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child2">
                                <li class="slide">
                                    <a class="side-menu__item" href="#">Domain</a>
                                </li>
                                <li class="slide">
                                    <a class="side-menu__item" href="#">SSL</a>
                                </li>
                                <li class="slide">
                                    <a class="side-menu__item" href="#">VPS</a>
                                </li>
                            </ul>
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
