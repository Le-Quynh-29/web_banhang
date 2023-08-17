<div class="header-section">
    <div class="top_menu">
        <div class="profile_details_left">
            <ul class="notifications-dropdown">
                <li class="dropdown note dra-down">
                    <div id="dd" class="wrapper-dropdown-3" tabindex="1">
                        <span>{{ auth()->user()->username }}</span>
                        <ul class="dropdown">
                            <li><a href="javascript:;"><i class="lnr lnr-user"></i>Thông tin cá nhân</a></li>
                            <li><a href="javascript:;"><i class="lnr lnr-cog"></i>Cài đặt</a></li>
                            <li><a href="{{ route('admin.logout') }}">Đăng xuất<i class="lnr lnr-power-switch"></i></a>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
