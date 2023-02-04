<!-- Main sidebar -->
<style>
   .nav-link {
            color: rgb(150, 214, 150);
        }
 
    .nav-item>a:hover {
        color: rgb(99, 143, 99);
    }
 
    /*code to change background color*/
    .active {
        background-color:  rgb(220, 236, 220);
        color: rgb(2, 13, 19);
    }

</style>
<div class="sidebar changeTheme sidebar-main sidebar-expand-lg ">
    <!-- Sidebar content -->
    <div class="sidebar-content">
        <!-- Main navigation -->
        <div class="sidebar-section">
            <ul class="nav nav-sidebar" data-nav-type="accordion">
                <!-- Main -->
                <li class="nav-item-header">
                    <div class="text-uppercase font-size-xs line-height-xs">Sidebar Menu</div> <i class="icon-menu"
                        title="Main"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin-dashboard') }}"
                        class="nav-link {{ request()->is('admin/dashboard*') ? 'active ' : '' }}">
                        <i class="icon-pie-chart fa fa-fw"></i>
                        <span>
                            Dashboard
                        </span>
                    </a>
                </li>
                </li>
                <li class="nav-item">
                    <a href="{{ route('users') }}"
                        class="nav-link {{ request()->is('admin/users*') ? 'active ' : '' }}">
                        <i class="icon-users4 fa fa-fw"></i>
                        <span>
                            Users
                        </span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('settings')}}"
                        class="nav-link {{ request()->is('admin/settings*') ? 'active' : '' }}">
                        <i class="icon-equalizer fa fa-fw"></i>
                        <span>
                            Settings
                        </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('terms-conditions') }}"
                        class="nav-link {{ request()->is('admin/terms-conditions*') ? 'active' : '' }}">
                        <i class="icon-clipboard fa fa-fw"></i>
                        <span>
                            Terms & Conditions
                        </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('faq') }}"
                        class="nav-link {{ request()->is('admin/add-faq*','admin/faq*' ) ? 'active' : '' }}">
                        <i class="icon-clipboard fa fa-fw"></i>
                        <span>
                            FAQ
                        </span>
                    </a>
                </li>
                
            </ul>
        </div>
        <!-- /main navigation -->
    </div>
    <!-- /sidebar content -->
</div>
<style>
</style>
<!-- /main sidebar -->
