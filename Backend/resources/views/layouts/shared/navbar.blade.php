<div class="sidebar-brand d-md-flex">
    <img src="" class="sidebar-brand-full navbar-image" alt="QUEEN SHOP" height="46">
    <img src="" class="sidebar-brand-narrow navbar-image" alt="QUEEN SHOP" height="46">
</div>
<ul class="sidebar-nav simplebar-scrollable-y" data-coreui="navigation" data-simplebar="init">
    <div class="simplebar-wrapper m-0">
        <div class="simplebar-height-auto-observer-wrapper">
            <div class="simplebar-height-auto-observer"></div>
        </div>
        <div class="simplebar-mask">
            <div class="simplebar-offset" style="right: 0; bottom: 0;">
                <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content"
                     style="height: 100%;">
                    <div class="simplebar-content p-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('dashboard')}}" data-id="dashboard">
                                <i class="nav-icon fas fa-tachometer-alt-average"></i>
                                Dashboard</a>
                        </li>

                        @if (Gate::allows('pmss--user-index') || Gate::allows('pmss--log-index') ||
                                Gate::allows('pmss--permission-index'))
                            <li class="nav-title">Hệ thống</li>
                        @endif
                        @if (Gate::allows('pmss--user-index'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('user.index')}}" data-id="user">
                                    <i class="nav-icon fas fa-user"></i>
                                    Quản lý người dùng</a>
                            </li>
                        @endif
                        @if (Gate::allows('pmss--log-index'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('log.index') }}" data-id="log">
                                    <i class="nav-icon fas fa-history"></i>
                                    Quản lý log</a>
                            </li>
                        @endif
                        @if(Gate::allows('pmss--permission-index'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('permission.index') }}" data-id="permission">
                                    <i class="nav-icon far fa-users-cog"></i>
                                    {{ __('Phân quyền') }}
                                </a>
                            </li>
                        @endif
                        @if (Gate::allows('pmss--category-index'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('category.index') }}" data-id="log">
                                <i class="nav-icon fas fa-folder"></i>
                                Quản lý danh mục</a>
                        </li>
                    @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="simplebar-placeholder" style="width: 256px; height: 841px;"></div>
    </div>
    <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
        <div class="simplebar-scrollbar" style="width: 0; display: none;"></div>
    </div>
    <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
        <div class="simplebar-scrollbar"
             style="height: 135px; transform: translate3d(0, 0, 0); display: block;"></div>
    </div>
</ul>
<button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
