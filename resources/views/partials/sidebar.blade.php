<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Dashtrans</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="javascript:;" class="">
                <a href="{{ route('dashboard') }}">
                    <div class="parent-icon"><i class='bx bx-home-alt'></i>
                    </div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </a>
        </li>
        <li class="menu-label">Applications</li>
        <li>
            <a href="{{ route('all-vps-servers') }}">
                <Iconify-icon icon="qlementine-icons:server-16" class="flex-shrink-0" width="20"
                    height="20"></Iconify-icon>
                <div class="menu-title">VPS Servers</div>
            </a>
        </li>
        <li>
            <a href="{{ route('all-vpn-servers') }}">
                <Iconify-icon icon="ic:baseline-vpn-lock" class="flex-shrink-0" width="20"
                    height="20"></Iconify-icon>
                <div class="menu-title">VPN Servers</div>
            </a>
        </li>
        <li>
            <a href="{{ route('all-plans') }}">
                <Iconify-icon icon="mdi:currency-usd" class="flex-shrink-0" width="20"
                    height="20"></Iconify-icon>
                <div class="menu-title">Plans</div>
            </a>
        </li>
        <li>
            <a href="{{ route('all-purchases') }}">
                <Iconify-icon icon="streamline:receipt" class="flex-shrink-0" width="20"
                    height="20"></Iconify-icon>
                <div class="menu-title">Purchases</div>
            </a>
        </li>
        <li>
            <a href="{{ route('feedbacks') }}">
                <Iconify-icon icon="fluent:person-feedback-32-regular" class="flex-shrink-0" width="20"
                    height="20"></Iconify-icon>
                <div class="menu-title">Feedbacks</div>
            </a>
        </li>
        <li>
            <a href="{{ route('all-users') }}">
                <Iconify-icon icon="ri:user-line" class="flex-shrink-0" width="20" height="20"></Iconify-icon>
                <div class="menu-title">Users</div>
            </a>
        </li>
        <li>
            <a href="{{ route('all-admins') }}">
                <Iconify-icon icon="ri:admin-line" class="flex-shrink-0" width="20" height="20"></Iconify-icon>
                <div class="menu-title">Admins</div>
            </a>
        </li>
        <li>
            <a href="{{ route('smpt') }}">
                <Iconify-icon icon="fluent:mail-20-regular" class="flex-shrink-0" width="20"
                    height="20"></Iconify-icon>
                <div class="menu-title">SMTP</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>
