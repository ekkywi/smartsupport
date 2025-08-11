<!-- Start Switcher -->
<div aria-labelledby="offcanvasRightLabel" class="offcanvas offcanvas-end" id="switcher-canvas" tabindex="-1">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title text-default" id="offcanvasRightLabel">Switcher</h5>
        <button aria-label="Close" class="btn-close" data-bs-dismiss="offcanvas" type="button"></button>
    </div>
    <div class="offcanvas-body">
        <nav class="border-bottom border-block-end-dashed">
            <div class="nav nav-tabs nav-justified" id="switcher-main-tab" role="tablist">
                <button aria-controls="switcher-home" aria-selected="true" class="nav-link active" data-bs-target="#switcher-home" data-bs-toggle="tab" id="switcher-home-tab" role="tab" type="button">Theme Styles</button>
                <button aria-controls="switcher-profile" aria-selected="false" class="nav-link" data-bs-target="#switcher-profile" data-bs-toggle="tab" id="switcher-profile-tab" role="tab" type="button">Theme Colors</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div aria-labelledby="switcher-home-tab" class="tab-pane fade show active border-0" id="switcher-home" role="tabpanel" tabindex="0">
                <div class="">
                    <p class="switcher-style-head">Theme Color Mode:</p>
                    <div class="row switcher-style gx-0">
                        <div class="col-4">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-light-theme">
                                    Light
                                </label>
                                <input checked class="form-check-input" id="switcher-light-theme" name="theme-style" type="radio">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-dark-theme">
                                    Dark
                                </label>
                                <input class="form-check-input" id="switcher-dark-theme" name="theme-style" type="radio">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <p class="switcher-style-head">Directions:</p>
                    <div class="row switcher-style gx-0">
                        <div class="col-4">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-ltr">
                                    LTR
                                </label>
                                <input checked class="form-check-input" id="switcher-ltr" name="direction" type="radio">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-rtl">
                                    RTL
                                </label>
                                <input class="form-check-input" id="switcher-rtl" name="direction" type="radio">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <p class="switcher-style-head">Navigation Styles:</p>
                    <div class="row switcher-style gx-0">
                        <div class="col-4">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-vertical">
                                    Vertical
                                </label>
                                <input checked class="form-check-input" id="switcher-vertical" name="navigation-style" type="radio">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-horizontal">
                                    Horizontal
                                </label>
                                <input class="form-check-input" id="switcher-horizontal" name="navigation-style" type="radio">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="navigation-menu-styles">
                    <p class="switcher-style-head">Vertical & Horizontal Menu Styles:</p>
                    <div class="row switcher-style gx-0 pb-2 gy-2">
                        <div class="col-4">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-menu-click">
                                    Menu Click
                                </label>
                                <input class="form-check-input" id="switcher-menu-click" name="navigation-menu-styles" type="radio">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-menu-hover">
                                    Menu Hover
                                </label>
                                <input class="form-check-input" id="switcher-menu-hover" name="navigation-menu-styles" type="radio">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-icon-click">
                                    Icon Click
                                </label>
                                <input class="form-check-input" id="switcher-icon-click" name="navigation-menu-styles" type="radio">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-icon-hover">
                                    Icon Hover
                                </label>
                                <input class="form-check-input" id="switcher-icon-hover" name="navigation-menu-styles" type="radio">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sidemenu-layout-styles">
                    <p class="switcher-style-head">Sidemenu Layout Styles:</p>
                    <div class="row switcher-style gx-0 pb-2 gy-2">
                        <div class="col-sm-6">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-default-menu">
                                    Default Menu
                                </label>
                                <input checked class="form-check-input" id="switcher-default-menu" name="sidemenu-layout-styles" type="radio">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-closed-menu">
                                    Closed Menu
                                </label>
                                <input class="form-check-input" id="switcher-closed-menu" name="sidemenu-layout-styles" type="radio">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-icontext-menu">
                                    Icon Text
                                </label>
                                <input class="form-check-input" id="switcher-icontext-menu" name="sidemenu-layout-styles" type="radio">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-icon-overlay">
                                    Icon Overlay
                                </label>
                                <input class="form-check-input" id="switcher-icon-overlay" name="sidemenu-layout-styles" type="radio">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-detached">
                                    Detached
                                </label>
                                <input class="form-check-input" id="switcher-detached" name="sidemenu-layout-styles" type="radio">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-double-menu">
                                    Double Menu
                                </label>
                                <input class="form-check-input" id="switcher-double-menu" name="sidemenu-layout-styles" type="radio">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <p class="switcher-style-head">Page Styles:</p>
                    <div class="row switcher-style gx-0">
                        <div class="col-4">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-regular">
                                    Regular
                                </label>
                                <input checked class="form-check-input" id="switcher-regular" name="page-styles" type="radio">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-classic">
                                    Classic
                                </label>
                                <input class="form-check-input" id="switcher-classic" name="page-styles" type="radio">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-modern">
                                    Modern
                                </label>
                                <input class="form-check-input" id="switcher-modern" name="page-styles" type="radio">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <p class="switcher-style-head">Layout Width Styles:</p>
                    <div class="row switcher-style gx-0">
                        <div class="col-4">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-full-width">
                                    Full Width
                                </label>
                                <input checked class="form-check-input" id="switcher-full-width" name="layout-width" type="radio">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-boxed">
                                    Boxed
                                </label>
                                <input class="form-check-input" id="switcher-boxed" name="layout-width" type="radio">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <p class="switcher-style-head">Menu Positions:</p>
                    <div class="row switcher-style gx-0">
                        <div class="col-4">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-menu-fixed">
                                    Fixed
                                </label>
                                <input checked class="form-check-input" id="switcher-menu-fixed" name="menu-positions" type="radio">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-menu-scroll">
                                    Scrollable
                                </label>
                                <input class="form-check-input" id="switcher-menu-scroll" name="menu-positions" type="radio">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <p class="switcher-style-head">Header Positions:</p>
                    <div class="row switcher-style gx-0">
                        <div class="col-4">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-header-fixed">
                                    Fixed
                                </label>
                                <input checked class="form-check-input" id="switcher-header-fixed" name="header-positions" type="radio">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-header-scroll">
                                    Scrollable
                                </label>
                                <input class="form-check-input" id="switcher-header-scroll" name="header-positions" type="radio">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div aria-labelledby="switcher-profile-tab" class="tab-pane fade border-0" id="switcher-profile" role="tabpanel" tabindex="0">
                <div>
                    <div class="theme-colors">
                        <p class="switcher-style-head">Menu Colors:</p>
                        <div class="d-flex switcher-style pb-2">
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-white" data-bs-placement="top" data-bs-toggle="tooltip" id="switcher-menu-light" name="menu-colors" title="Light Menu" type="radio">
                            </div>
                            <div class="form-check switch-select me-3">
                                <input checked class="form-check-input color-input color-dark" data-bs-placement="top" data-bs-toggle="tooltip" id="switcher-menu-dark" name="menu-colors" title="Dark Menu" type="radio">
                            </div>
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-primary" data-bs-placement="top" data-bs-toggle="tooltip" id="switcher-menu-primary" name="menu-colors" title="Color Menu" type="radio">
                            </div>
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-gradient" data-bs-placement="top" data-bs-toggle="tooltip" id="switcher-menu-gradient" name="menu-colors" title="Gradient Menu" type="radio">
                            </div>
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-transparent" data-bs-placement="top" data-bs-toggle="tooltip" id="switcher-menu-transparent" name="menu-colors" title="Transparent Menu" type="radio">
                            </div>
                        </div>
                        <div class="px-4 pb-3 text-muted fs-11">Note:If you want to change color Menu dynamically change from below Theme Primary color picker</div>
                    </div>
                    <div class="theme-colors">
                        <p class="switcher-style-head">Header Colors:</p>
                        <div class="d-flex switcher-style pb-2">
                            <div class="form-check switch-select me-3">
                                <input checked class="form-check-input color-input color-white" data-bs-placement="top" data-bs-toggle="tooltip" id="switcher-header-light" name="header-colors" title="Light Header" type="radio">
                            </div>
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-dark" data-bs-placement="top" data-bs-toggle="tooltip" id="switcher-header-dark" name="header-colors" title="Dark Header" type="radio">
                            </div>
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-primary" data-bs-placement="top" data-bs-toggle="tooltip" id="switcher-header-primary" name="header-colors" title="Color Header" type="radio">
                            </div>
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-gradient" data-bs-placement="top" data-bs-toggle="tooltip" id="switcher-header-gradient" name="header-colors" title="Gradient Header" type="radio">
                            </div>
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-transparent" data-bs-placement="top" data-bs-toggle="tooltip" id="switcher-header-transparent" name="header-colors" title="Transparent Header" type="radio">
                            </div>
                        </div>
                        <div class="px-4 pb-3 text-muted fs-11">Note:If you want to change color Header dynamically change from below Theme Primary color picker</div>
                    </div>
                    <div class="theme-colors">
                        <p class="switcher-style-head">Theme Primary:</p>
                        <div class="d-flex flex-wrap align-items-center switcher-style">
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-primary-1" id="switcher-primary" name="theme-primary" type="radio">
                            </div>
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-primary-2" id="switcher-primary1" name="theme-primary" type="radio">
                            </div>
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-primary-3" id="switcher-primary2" name="theme-primary" type="radio">
                            </div>
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-primary-4" id="switcher-primary3" name="theme-primary" type="radio">
                            </div>
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-primary-5" id="switcher-primary4" name="theme-primary" type="radio">
                            </div>
                            <div class="form-check switch-select ps-0 mt-1 color-primary-light">
                                <div class="theme-container-primary"></div>
                                <div class="pickr-container-primary"></div>
                            </div>
                        </div>
                    </div>
                    <div class="theme-colors">
                        <p class="switcher-style-head">Theme Background:</p>
                        <div class="d-flex flex-wrap align-items-center switcher-style">
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-bg-1" id="switcher-background" name="theme-background" type="radio">
                            </div>
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-bg-2" id="switcher-background1" name="theme-background" type="radio">
                            </div>
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-bg-3" id="switcher-background2" name="theme-background" type="radio">
                            </div>
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-bg-4" id="switcher-background3" name="theme-background" type="radio">
                            </div>
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-bg-5" id="switcher-background4" name="theme-background" type="radio">
                            </div>
                            <div class="form-check switch-select ps-0 mt-1 tooltip-static-demo color-bg-transparent">
                                <div class="theme-container-background"></div>
                                <div class="pickr-container-background"></div>
                            </div>
                        </div>
                    </div>
                    <div class="menu-image mb-3">
                        <p class="switcher-style-head">Menu With Background Image:</p>
                        <div class="d-flex flex-wrap align-items-center switcher-style">
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input bgimage-input bg-img1" id="switcher-bg-img" name="theme-background" type="radio">
                            </div>
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input bgimage-input bg-img2" id="switcher-bg-img1" name="theme-background" type="radio">
                            </div>
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input bgimage-input bg-img3" id="switcher-bg-img2" name="theme-background" type="radio">
                            </div>
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input bgimage-input bg-img4" id="switcher-bg-img3" name="theme-background" type="radio">
                            </div>
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input bgimage-input bg-img5" id="switcher-bg-img4" name="theme-background" type="radio">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="canvas-footer d-grid">
                <a class="btn btn-danger m-1" href="javascript:void(0);" id="reset-all">Reset</a>
            </div>
        </div>
    </div>
</div>
<!-- End Switcher -->
