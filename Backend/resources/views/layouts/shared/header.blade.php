<header class="header header-sticky mb-4">
    <div class="container-fluid header-top">
        <button class="header-toggler px-md-0 me-md-3" type="button"
                onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
            <i class="icon icon-lg fas fa-bars"></i>
        </button>
        <ul class="header-nav ms-3">
            <li class="nav-item dropdown">
                <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button"
                                             aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-md">
                        <img class="avatar-img" id="avatar" alt="user@email.com"
                             onerror="this.src='{{route('content.show', base64_encode(\App\Models\User::IMAGE_DEFAULT))}}'"
                             src="{{route('content.show', base64_encode('app/'. auth()->user()->image))}}">
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end p-0 ov-hidden">
                    <div class="dropdown-header bg-light py-2">
                        <div class="fw-semibold">{{ auth()->user()->username }}</div>
                    </div>
                    <a class="dropdown-item" href="javascript:;">
                        <i class="far fa-user-cog"></i>
                        Thông tin cá nhân
                    </a>
                    <a class="dropdown-item" href="javascript:;">
                        <i class="far fa-key"></i>
                        Đổi mật khẩu
                    </a>
                    <a class="dropdown-item" href="{{ route('logout') }}">
                        <i class="fas fa-sign-out"></i>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
    </div>
    @yield('header')
</header>
