<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1"
         data-menu-dropdown-timeout="500">
        <ul class="menu-nav">
            <li class="menu-item" aria-haspopup="true">
                <a href="{{ route('admin.admins.index') }}" class="menu-link">
                    @include('admin.sidebar-svgs.services')
                    <span class="menu-text">ادمین ها</span>
                </a>
            </li>
            <li class="menu-item" aria-haspopup="true">
                <a href="{{ route('admin.application-features.index') }}" class="menu-link">
                    @include('admin.sidebar-svgs.services')
                    <span class="menu-text">ویژگی های اپلیکیشن</span>
                </a>
            </li>
            <li class="menu-item" aria-haspopup="true">
                <a href="{{ route('admin.instructions.index') }}" class="menu-link">
                    @include('admin.sidebar-svgs.services')
                    <span class="menu-text">راهنما های اپلیکیشن</span>
                </a>
            </li>
            <li class="menu-item" aria-haspopup="true">
                <a href="{{ route('admin.avatars.index') }}" class="menu-link">
                    @include('admin.sidebar-svgs.services')
                    <span class="menu-text">آواتار ها</span>
                </a>
            </li>
            <li class="menu-item" aria-haspopup="true">
                <a href="{{ route('admin.days.index') }}" class="menu-link">
                    @include('admin.sidebar-svgs.services')
                    <span class="menu-text">روز ها</span>
                </a>
            </li>
            <li class="menu-item" aria-haspopup="true">
                <a href="{{ route('admin.goals.index') }}" class="menu-link">
                    @include('admin.sidebar-svgs.services')
                    <span class="menu-text">اهداف</span>
                </a>
            </li>
            <li class="menu-item" aria-haspopup="true">
                <a href="{{ route('admin.plans.index') }}" class="menu-link">
                    @include('admin.sidebar-svgs.services')
                    <span class="menu-text">اشتراک ها</span>
                </a>
            </li>
            <li class="menu-item" aria-haspopup="true">
                <a href="{{ route('admin.users.index') }}" class="menu-link">
                    @include('admin.sidebar-svgs.services')
                    <span class="menu-text">کاربر ها</span>
                </a>
            </li>
            <li class="menu-item" aria-haspopup="true">
                <a href="{{ route('admin.transactions.index') }}" class="menu-link">
                    @include('admin.sidebar-svgs.services')
                    <span class="menu-text">تراکنش ها</span>
                </a>
            </li>
            <li class="menu-item" aria-haspopup="true">
                <a href="{{ route('admin.day-exercises.index') }}" class="menu-link">
                    @include('admin.sidebar-svgs.services')
                    <span class="menu-text">تمرین ها</span>
                </a>
            </li>
        </ul>
    </div>
</div>
