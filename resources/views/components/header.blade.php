 <!-- app-header -->
 <header class="app-header">

     <!-- Start::main-header-container -->
     <div class="main-header-container container-fluid">

         <!-- Start::header-content-left -->
         <div class="header-content-left">

             <!-- Start::header-element -->
             <div class="header-element">
                 <div class="horizontal-logo">
                     <a class="header-logo" href="{{ route("dashboard") }}">
                         <img alt="logo" class="desktop-logo" src="{{ asset("images/brand-logos/logo.png") }}">
                         <img alt="logo" class="toggle-logo" src="{{ asset("images/brand-logos/icon.png") }}">
                         <img alt="logo" class="desktop-dark" src="{{ asset("images/brand-logos/logo-darkmode.png") }}">
                         <img alt="logo" class="toggle-dark" src="{{ asset("images/brand-logos/icon-darkmode.png") }}">
                     </a>
                 </div>
             </div>
             <!-- End::header-element -->

             <!-- Start::header-element -->
             <div class="header-element">
                 <!-- Start::header-link -->
                 <a aria-label="Hide Sidebar" class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle" data-bs-toggle="sidebar" href="javascript:void(0);"><span></span></a>
                 <!-- End::header-link -->
             </div>
             <!-- End::header-element -->

         </div>
         <!-- End::header-content-left -->

         <!-- Start::header-content-right -->
         <div class="header-content-right">

             <!-- Start::header-element -->
             <div class="header-element header-search">
                 <!-- Start::header-link -->
                 <a class="header-link" data-bs-target="#searchModal" data-bs-toggle="modal" href="javascript:void(0);">
                     <i class="bx bx-search-alt-2 header-link-icon"></i>
                 </a>
                 <!-- End::header-link -->
             </div>
             <!-- End::header-element -->

             <!-- Start::header-element -->
             <div class="header-element header-theme-mode">
                 <!-- Start::header-link|layout-setting -->
                 <a class="header-link layout-setting" href="javascript:void(0);">
                     <span class="light-layout">
                         <!-- Start::header-link-icon -->
                         <i class="bx bx-moon header-link-icon"></i>
                         <!-- End::header-link-icon -->
                     </span>
                     <span class="dark-layout">
                         <!-- Start::header-link-icon -->
                         <i class="bx bx-sun header-link-icon"></i>
                         <!-- End::header-link-icon -->
                     </span>
                 </a>
                 <!-- End::header-link|layout-setting -->
             </div>
             <!-- End::header-element -->

             <!-- Start::header-element -->
             <div class="header-element cart-dropdown">
                 <!-- Start::header-link|dropdown-toggle -->
                 <a class="header-link dropdown-toggle" data-bs-auto-close="outside" data-bs-toggle="dropdown" href="javascript:void(0);">
                     <i class="bx bx-cart header-link-icon"></i>
                     <span class="badge bg-primary rounded-pill header-icon-badge" id="cart-icon-badge">5</span>
                 </a>
                 <!-- End::header-link|dropdown-toggle -->
                 <!-- Start::main-header-dropdown -->
                 <div class="main-header-dropdown dropdown-menu dropdown-menu-end" data-popper-placement="none">
                     <div class="p-3">
                         <div class="d-flex align-items-center justify-content-between">
                             <p class="mb-0 fs-17 fw-semibold">Cart Items</p>
                             <span class="badge bg-success-transparent" id="cart-data">5 Items</span>
                         </div>
                     </div>
                     <div>
                         <hr class="dropdown-divider">
                     </div>
                     <ul class="list-unstyled mb-0" id="header-cart-items-scroll">
                         <li class="dropdown-item">
                             <div class="d-flex align-items-start cart-dropdown-item">
                                 <img alt="img" class="avatar avatar-sm avatar-rounded br-5 me-3" src="{{ asset("images/ecommerce/jpg/1.jpg") }}">
                                 <div class="flex-grow-1">
                                     <div class="d-flex align-items-start justify-content-between mb-0">
                                         <div class="mb-0 fs-13 text-dark fw-semibold">
                                             <a href="cart.html">SomeThing Phone</a>
                                         </div>
                                         <div>
                                             <span class="text-black mb-1">$1,299.00</span>
                                             <a class="header-cart-remove float-end dropdown-item-close" href="javascript:void(0);"><i class="ti ti-trash"></i></a>
                                         </div>
                                     </div>
                                     <div class="min-w-fit-content d-flex align-items-start justify-content-between">
                                         <ul class="header-product-item d-flex">
                                             <li>Metallic Blue</li>
                                             <li>6gb Ram</li>
                                         </ul>
                                     </div>
                                 </div>
                             </div>
                         </li>
                         <li class="dropdown-item">
                             <div class="d-flex align-items-start cart-dropdown-item">
                                 <img alt="img" class="avatar avatar-sm avatar-rounded br-5 me-3" src="{{ asset("images/ecommerce/jpg/3.jpg") }}">
                                 <div class="flex-grow-1">
                                     <div class="d-flex align-items-start justify-content-between mb-0">
                                         <div class="mb-0 fs-13 text-dark fw-semibold">
                                             <a href="cart.html">Stop Watch</a>
                                         </div>
                                         <div>
                                             <span class="text-black mb-1">$179.29</span>
                                             <a class="header-cart-remove float-end dropdown-item-close" href="javascript:void(0);"><i class="ti ti-trash"></i></a>
                                         </div>
                                     </div>
                                     <div class="min-w-fit-content d-flex align-items-start justify-content-between">
                                         <ul class="header-product-item">
                                             <li>Analog</li>
                                             <li><span class="badge bg-pink-transparent fs-10">Free shipping</span></li>
                                         </ul>
                                     </div>
                                 </div>
                             </div>
                         </li>
                         <li class="dropdown-item">
                             <div class="d-flex align-items-start cart-dropdown-item">
                                 <img alt="img" class="avatar avatar-sm avatar-rounded br-5 me-3" src="{{ asset("images/ecommerce/jpg/5.jpg") }}">
                                 <div class="flex-grow-1">
                                     <div class="d-flex align-items-start justify-content-between mb-0">
                                         <div class="mb-0 fs-13 text-dark fw-semibold">
                                             <a href="cart.html">Photo Frame</a>
                                         </div>
                                         <div>
                                             <span class="text-black mb-1">$29.00</span>
                                             <a class="header-cart-remove float-end dropdown-item-close" href="javascript:void(0);"><i class="ti ti-trash"></i></a>
                                         </div>
                                     </div>
                                     <div class="min-w-fit-content d-flex align-items-start justify-content-between">
                                         <ul class="header-product-item d-flex">
                                             <li>Decorative</li>
                                         </ul>
                                     </div>
                                 </div>
                             </div>
                         </li>
                         <li class="dropdown-item">
                             <div class="d-flex align-items-start cart-dropdown-item">
                                 <img alt="img" class="avatar avatar-sm avatar-rounded br-5 me-3" src="{{ asset("images/ecommerce/jpg/4.jpg") }}">
                                 <div class="flex-grow-1">
                                     <div class="d-flex align-items-start justify-content-between mb-0">
                                         <div class="mb-0 fs-13 text-dark fw-semibold">
                                             <a href="cart.html">Kikon Camera</a>
                                         </div>
                                         <div>
                                             <span class="text-black mb-1">$4,999.00</span>
                                             <a class="header-cart-remove float-end dropdown-item-close" href="javascript:void(0);"><i class="ti ti-trash"></i></a>
                                         </div>
                                     </div>
                                     <div class="min-w-fit-content d-flex align-items-start justify-content-between">
                                         <ul class="header-product-item d-flex">
                                             <li>Black</li>
                                             <li>50MM</li>
                                         </ul>
                                     </div>
                                 </div>
                             </div>
                         </li>
                         <li class="dropdown-item">
                             <div class="d-flex align-items-start cart-dropdown-item">
                                 <img alt="img" class="avatar avatar-sm avatar-rounded br-5 me-3" src="{{ asset("images/ecommerce/jpg/6.jpg") }}">
                                 <div class="flex-grow-1">
                                     <div class="d-flex align-items-start justify-content-between mb-0">
                                         <div class="mb-0 fs-13 text-dark fw-semibold">
                                             <a href="cart.html">Canvas Shoes</a>
                                         </div>
                                         <div>
                                             <span class="text-black mb-1">$129.00</span>
                                             <a class="header-cart-remove float-end dropdown-item-close" href="javascript:void(0);"><i class="ti ti-trash"></i></a>
                                         </div>
                                     </div>
                                     <div class="d-flex align-items-start justify-content-between">
                                         <ul class="header-product-item d-flex">
                                             <li>Gray</li>
                                             <li>Sports</li>
                                         </ul>
                                     </div>
                                 </div>
                             </div>
                         </li>
                     </ul>
                     <div class="p-3 empty-header-item border-top">
                         <div class="d-grid">
                             <a class="btn btn-primary" href="checkout.html">Proceed to checkout</a>
                         </div>
                     </div>
                     <div class="p-5 empty-item d-none">
                         <div class="text-center">
                             <span class="avatar avatar-xl avatar-rounded bg-warning-transparent">
                                 <i class="ri-shopping-cart-2-line fs-2"></i>
                             </span>
                             <h6 class="fw-bold mb-1 mt-3">Your Cart is Empty</h6>
                             <span class="mb-3 fw-normal fs-13 d-block">Add some items to make me happy :)</span>
                             <a class="btn btn-primary btn-wave btn-sm m-1" data-abc="true" href="products.html">continue shopping <i class="bi bi-arrow-right ms-1"></i></a>
                         </div>
                     </div>
                 </div>
                 <!-- End::main-header-dropdown -->
             </div>
             <!-- End::header-element -->

             <!-- Start::header-element -->
             <div class="header-element notifications-dropdown">
                 <!-- Start::header-link|dropdown-toggle -->
                 <a aria-expanded="false" class="header-link dropdown-toggle" data-bs-auto-close="outside" data-bs-toggle="dropdown" href="javascript:void(0);" id="messageDropdown">
                     <i class="bx bx-bell header-link-icon"></i>
                     <span class="badge bg-secondary rounded-pill header-icon-badge pulse pulse-secondary" id="notification-icon-badge">5</span>
                 </a>
                 <!-- End::header-link|dropdown-toggle -->
                 <!-- Start::main-header-dropdown -->
                 <div class="main-header-dropdown dropdown-menu dropdown-menu-end" data-popper-placement="none">
                     <div class="p-3">
                         <div class="d-flex align-items-center justify-content-between">
                             <p class="mb-0 fs-17 fw-semibold">Notifications</p>
                             <span class="badge bg-secondary-transparent" id="notifiation-data">5 Unread</span>
                         </div>
                     </div>
                     <div class="dropdown-divider"></div>
                     <ul class="list-unstyled mb-0" id="header-notification-scroll">
                         <li class="dropdown-item">
                             <div class="d-flex align-items-start">
                                 <div class="pe-2">
                                     <span class="avatar avatar-md bg-primary-transparent avatar-rounded"><i class="ti ti-gift fs-18"></i></span>
                                 </div>
                                 <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                     <div>
                                         <p class="mb-0 fw-semibold"><a href="notifications.html">Your Order Has Been Shipped</a></p>
                                         <span class="text-muted fw-normal fs-12 header-notification-text">Order No: 123456 Has Shipped To Your Delivery Address</span>
                                     </div>
                                     <div>
                                         <a class="min-w-fit-content text-muted me-1 dropdown-item-close1" href="javascript:void(0);"><i class="ti ti-x fs-16"></i></a>
                                     </div>
                                 </div>
                             </div>
                         </li>
                         <li class="dropdown-item">
                             <div class="d-flex align-items-start">
                                 <div class="pe-2">
                                     <span class="avatar avatar-md bg-secondary-transparent avatar-rounded"><i class="ti ti-discount-2 fs-18"></i></span>
                                 </div>
                                 <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                     <div>
                                         <p class="mb-0 fw-semibold"><a href="notifications.html">Discount Available</a></p>
                                         <span class="text-muted fw-normal fs-12 header-notification-text">Discount Available On Selected Products</span>
                                     </div>
                                     <div>
                                         <a class="min-w-fit-content text-muted me-1 dropdown-item-close1" href="javascript:void(0);"><i class="ti ti-x fs-16"></i></a>
                                     </div>
                                 </div>
                             </div>
                         </li>
                         <li class="dropdown-item">
                             <div class="d-flex align-items-start">
                                 <div class="pe-2">
                                     <span class="avatar avatar-md bg-pink-transparent avatar-rounded"><i class="ti ti-user-check fs-18"></i></span>
                                 </div>
                                 <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                     <div>
                                         <p class="mb-0 fw-semibold"><a href="notifications.html">Account Has Been Verified</a></p>
                                         <span class="text-muted fw-normal fs-12 header-notification-text">Your Account Has Been Verified Sucessfully</span>
                                     </div>
                                     <div>
                                         <a class="min-w-fit-content text-muted me-1 dropdown-item-close1" href="javascript:void(0);"><i class="ti ti-x fs-16"></i></a>
                                     </div>
                                 </div>
                             </div>
                         </li>
                         <li class="dropdown-item">
                             <div class="d-flex align-items-start">
                                 <div class="pe-2">
                                     <span class="avatar avatar-md bg-warning-transparent avatar-rounded"><i class="ti ti-circle-check fs-18"></i></span>
                                 </div>
                                 <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                     <div>
                                         <p class="mb-0 fw-semibold"><a href="notifications.html">Order Placed <span class="text-warning">ID: #1116773</span></a></p>
                                         <span class="text-muted fw-normal fs-12 header-notification-text">Order Placed Successfully</span>
                                     </div>
                                     <div>
                                         <a class="min-w-fit-content text-muted me-1 dropdown-item-close1" href="javascript:void(0);"><i class="ti ti-x fs-16"></i></a>
                                     </div>
                                 </div>
                             </div>
                         </li>
                         <li class="dropdown-item">
                             <div class="d-flex align-items-start">
                                 <div class="pe-2">
                                     <span class="avatar avatar-md bg-success-transparent avatar-rounded"><i class="ti ti-clock fs-18"></i></span>
                                 </div>
                                 <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                     <div>
                                         <p class="mb-0 fw-semibold"><a href="notifications.html">Order Delayed <span class="text-success">ID: 7731116</span></a></p>
                                         <span class="text-muted fw-normal fs-12 header-notification-text">Order Delayed Unfortunately</span>
                                     </div>
                                     <div>
                                         <a class="min-w-fit-content text-muted me-1 dropdown-item-close1" href="javascript:void(0);"><i class="ti ti-x fs-16"></i></a>
                                     </div>
                                 </div>
                             </div>
                         </li>
                     </ul>
                     <div class="p-3 empty-header-item1 border-top">
                         <div class="d-grid">
                             <a class="btn btn-primary" href="notifications.html">View All</a>
                         </div>
                     </div>
                     <div class="p-5 empty-item1 d-none">
                         <div class="text-center">
                             <span class="avatar avatar-xl avatar-rounded bg-secondary-transparent">
                                 <i class="ri-notification-off-line fs-2"></i>
                             </span>
                             <h6 class="fw-semibold mt-3">No New Notifications</h6>
                         </div>
                     </div>
                 </div>
                 <!-- End::main-header-dropdown -->
             </div>
             <!-- End::header-element -->

             <!-- Start::header-element -->
             <div class="header-element header-shortcuts-dropdown">
                 <!-- Start::header-link|dropdown-toggle -->
                 <a aria-expanded="false" class="header-link dropdown-toggle" data-bs-auto-close="outside" data-bs-toggle="dropdown" href="javascript:void(0);" id="notificationDropdown">
                     <i class="bx bx-grid-alt header-link-icon"></i>
                 </a>
                 <!-- End::header-link|dropdown-toggle -->
                 <!-- Start::main-header-dropdown -->
                 <div aria-labelledby="notificationDropdown" class="main-header-dropdown header-shortcuts-dropdown dropdown-menu pb-0 dropdown-menu-end">
                     <div class="p-3">
                         <div class="d-flex align-items-center justify-content-between">
                             <p class="mb-0 fs-17 fw-semibold">Related Apps</p>
                         </div>
                     </div>
                     <div class="dropdown-divider mb-0"></div>
                     <div class="main-header-shortcuts p-2" id="header-shortcut-scroll">
                         <div class="row g-2">
                             <div class="col-4">
                                 <a href="javascript:void(0);">
                                     <div class="text-center p-3 related-app">
                                         <span class="avatar avatar-sm avatar-rounded">
                                             <img alt="" src="{{ asset("images/apps/figma.png") }}">
                                         </span>
                                         <span class="d-block fs-12">Figma</span>
                                     </div>
                                 </a>
                             </div>
                             <div class="col-4">
                                 <a href="javascript:void(0);">
                                     <div class="text-center p-3 related-app">
                                         <span class="avatar avatar-sm avatar-rounded">
                                             <img alt="" src="{{ asset("images/apps/microsoft-powerpoint.png") }}">
                                         </span>
                                         <span class="d-block fs-12">Power Point</span>
                                     </div>
                                 </a>
                             </div>
                             <div class="col-4">
                                 <a href="javascript:void(0);">
                                     <div class="text-center p-3 related-app">
                                         <span class="avatar avatar-sm avatar-rounded">
                                             <img alt="" src="{{ asset("images/apps/microsoft-word.png") }}">
                                         </span>
                                         <span class="d-block fs-12">MS Word</span>
                                     </div>
                                 </a>
                             </div>
                             <div class="col-4">
                                 <a href="javascript:void(0);">
                                     <div class="text-center p-3 related-app">
                                         <span class="avatar avatar-sm avatar-rounded">
                                             <img alt="" src="{{ asset("images/apps/calender.png") }}">
                                         </span>
                                         <span class="d-block fs-12">Calendar</span>
                                     </div>
                                 </a>
                             </div>
                             <div class="col-4">
                                 <a href="javascript:void(0);">
                                     <div class="text-center p-3 related-app">
                                         <span class="avatar avatar-sm avatar-rounded">
                                             <img alt="" src="{{ asset("images/apps/sketch.png") }}">
                                         </span>
                                         <span class="d-block fs-12">Sketch</span>
                                     </div>
                                 </a>
                             </div>
                             <div class="col-4">
                                 <a href="javascript:void(0);">
                                     <div class="text-center p-3 related-app">
                                         <span class="avatar avatar-sm avatar-rounded">
                                             <img alt="" src="{{ asset("images/apps/google-docs.png") }}">
                                         </span>
                                         <span class="d-block fs-12">Docs</span>
                                     </div>
                                 </a>
                             </div>
                             <div class="col-4">
                                 <a href="javascript:void(0);">
                                     <div class="text-center p-3 related-app">
                                         <span class="avatar avatar-sm avatar-rounded">
                                             <img alt="" src="{{ asset("images/apps/google.png") }}">
                                         </span>
                                         <span class="d-block fs-12">Google</span>
                                     </div>
                                 </a>
                             </div>
                             <div class="col-4">
                                 <a href="javascript:void(0);">
                                     <div class="text-center p-3 related-app">
                                         <span class="avatar avatar-sm avatar-rounded">
                                             <img alt="" src="{{ asset("images/apps/translate.png") }}">
                                         </span>
                                         <span class="d-block fs-12">Translate</span>
                                     </div>
                                 </a>
                             </div>
                             <div class="col-4">
                                 <a href="javascript:void(0);">
                                     <div class="text-center p-3 related-app">
                                         <span class="avatar avatar-sm avatar-rounded">
                                             <img alt="" src="{{ asset("images/apps/google-sheets.png") }}">
                                         </span>
                                         <span class="d-block fs-12">Sheets</span>
                                     </div>
                                 </a>
                             </div>
                         </div>
                     </div>
                     <div class="p-3 border-top">
                         <div class="d-grid">
                             <a class="btn btn-primary" href="javascript:void(0);">View All</a>
                         </div>
                     </div>
                 </div>
                 <!-- End::main-header-dropdown -->
             </div>
             <!-- End::header-element -->

             <!-- Start::header-element -->
             <div class="header-element header-fullscreen">
                 <!-- Start::header-link -->
                 <a class="header-link" href="#" onclick="openFullscreen();">
                     <i class="bx bx-fullscreen full-screen-open header-link-icon"></i>
                     <i class="bx bx-exit-fullscreen full-screen-close header-link-icon d-none"></i>
                 </a>
                 <!-- End::header-link -->
             </div>
             <!-- End::header-element -->

             <!-- Start::header-element -->
             <div class="header-element">
                 <!-- Start::header-link|dropdown-toggle -->
                 <a aria-expanded="false" class="header-link dropdown-toggle" data-bs-auto-close="outside" data-bs-toggle="dropdown" href="#" id="mainHeaderProfile">
                     <div class="d-flex align-items-center">
                         <div class="me-sm-2 me-0">
                             <img alt="img" class="rounded-circle" height="32" src="{{ asset("images/faces/9.jpg") }}" width="32">
                         </div>
                         <div class="d-sm-block d-none">
                             <p class="fw-semibold mb-0 lh-1">{{ Auth::user()->name ?? "" }}</p>
                             <span class="op-7 fw-normal d-block fs-11">{{ Auth::user()->section->name ?? "" }}</span>
                         </div>
                     </div>
                 </a>
                 <!-- End::header-link|dropdown-toggle -->
                 <ul aria-labelledby="mainHeaderProfile" class="main-header-dropdown dropdown-menu pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end">
                     <li><a class="dropdown-item d-flex" href="profile.html"><i class="ti ti-user-circle fs-18 me-2 op-7"></i>Profile</a></li>
                     <li><a class="dropdown-item d-flex" href="mail.html"><i class="ti ti-inbox fs-18 me-2 op-7"></i>Inbox <span class="badge bg-success-transparent ms-auto">25</span></a></li>
                     <li><a class="dropdown-item d-flex border-block-end" href="to-do-list.html"><i class="ti ti-clipboard-check fs-18 me-2 op-7"></i>Task Manager</a></li>
                     <li><a class="dropdown-item d-flex" href="mail-settings.html"><i class="ti ti-adjustments-horizontal fs-18 me-2 op-7"></i>Settings</a></li>
                     <li><a class="dropdown-item d-flex border-block-end" href="javascript:void(0);"><i class="ti ti-wallet fs-18 me-2 op-7"></i>Bal: $7,12,950</a></li>
                     <li><a class="dropdown-item d-flex" href="chat.html"><i class="ti ti-headset fs-18 me-2 op-7"></i>Support</a></li>
                     <li>
                         <form action="{{ route("logout") }}" method="POST">
                             @csrf
                             <button class="dropdown-item d-flex border-0 bg-transparent w-100" type="submit">
                                 <i class="ti ti-logout fs-18 me-2 op-7"></i>Log Out
                             </button>
                         </form>
                     </li>
                 </ul>
             </div>
             <!-- End::header-element -->

             <!-- Start::header-element -->
             <div class="header-element">
                 <!-- Start::header-link|switcher-icon -->
                 <a class="header-link switcher-icon" data-bs-target="#switcher-canvas" data-bs-toggle="offcanvas" href="#">
                     <i class="bx bx-cog header-link-icon"></i>
                 </a>
                 <!-- End::header-link|switcher-icon -->
             </div>
             <!-- End::header-element -->

         </div>
         <!-- End::header-content-right -->

     </div>
     <!-- End::main-header-container -->

 </header>
 <!-- /app-header -->
