<div class="sidebar-brand d-md-flex">
    <img src="" class="sidebar-brand-full navbar-image" alt="QUEEN SHOP"
         height="46">
    <img src="" class="sidebar-brand-narrow navbar-image" alt="QUEEN SHOP"
         height="46">
    {{--    <svg class="sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">--}}
    {{--        <use xlink:href="assets/brand/coreui.svg#full"></use>--}}
    {{--    </svg>--}}
    {{--    <svg class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">--}}
    {{--        <use xlink:href="assets/brand/coreui.svg#signet"></use>--}}
    {{--    </svg>--}}
</div>
<ul class="sidebar-nav simplebar-scrollable-y" data-coreui="navigation" data-simplebar="init">
    <div class="simplebar-wrapper" style="margin: 0px;">
        <div class="simplebar-height-auto-observer-wrapper">
            <div class="simplebar-height-auto-observer"></div>
        </div>
        <div class="simplebar-mask">
            <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content"
                     style="height: 100%;">
                    <div class="simplebar-content" style="padding: 0px;">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('dashboard')}}" data-id="dashboard">
                                <i class="nav-icon fas fa-tachometer-alt-average"></i>
                                Dashboard</a></li>
                        <li class="nav-title">Hệ thống</li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('user.index')}}" data-id="user">
                                <i class="nav-icon fas fa-user"></i>
                                Quản lý người dùng</a></li>
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:;" data-id="log">
                                <i class="nav-icon fas fa-history"></i>
                                Quản lý log</a></li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('category.index')}}" data-id="category">
                                <i class="nav-icon fas fa-folder"></i> 
                                Quản lý danh mục</a></li>
                    </div>
                </div>
            </div>
        </div>
        <div class="simplebar-placeholder" style="width: 256px; height: 841px;"></div>
    </div>
    <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
        <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
    </div>
    <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
        <div class="simplebar-scrollbar"
             style="height: 135px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
    </div>
</ul>
<button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
