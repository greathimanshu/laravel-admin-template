
<style>
    .nav-link {
             color: rgb(150, 214, 150);
         }
  
         .nav-item>a:hover {
             color: rgb(247, 253, 247);
         }
  
         /*code to change background color*/
         .navbar-nav> .active>a {
             background-color: #C0C0C0;
             color: rgb(11, 83, 117);
         }
 </style>

<!-- Main sidebar -->

<div class="sidebar changeTheme sidebar-main sidebar-expand-lg ">
    <!-- Sidebar content -->
    <div class="sidebar-content">
<!-- Main navigation -->
<div class="sidebar-section">
    <ul class="nav nav-sidebar" data-nav-type="accordion">
        <!-- Main -->
        <li class="nav-item-header">
            <div class="text-uppercase font-size-xs line-height-xs">Sidebar Menu</div> <i class="icon-menu" title="Main"></i>
        </li>
        <li class="nav-item">
            <a href="{{ route('user-dashboard') }}" class="nav-link {{ request()->is('user/dashboard*') ? 'active ' : '' }}">
                <i class="icon-pie-chart fa fa-fw"></i>
                <span>
                    Dashboard
                </span>
            </a>
        </li>
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