<div class="navbar navbar-expand-lg changeTheme navbar-static">
    <div class="d-flex flex-1 d-lg-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-paragraph-justify3"></i>
        </button>
    </div>

    <div class="navbar-brand ">
        <a href="{{ route('user-dashboard') }}" class="d-inline-block">
            <img src={{ asset('merchant') . '/logo/logo2.png' }} class="rounded-pill mx-auto d-block" height="34"
                alt="">
            <span class="d-none d-sm-block" style="font-size: 20px; font-weight: 700;color: rgb(150, 214, 150);">User
                Dashboard</span>
        </a>
    </div>

    <div class="collapse navbar-collapse order-2 order-lg-1" id="navbar-mobile">
        {{-- <li class="nav-item dropdown"> --}}
        <div class="dropdown-menu dropdown-menu-right dropdown-content wmin-lg-300">
            <div class="dropdown-content-header">
                <span class="font-weight-semibold">Users online</span>
                <a href="#" class="text-body"><i class="icon-search4 font-size-base"></i></a>
            </div>

            <div class="dropdown-content-body dropdown-scrollable">
                <ul class="media-list">
                    <li class="media">
                        <div class="mr-3">
                            <img src="{{ asset('admin') }}/images/logo/user_logo.png" width="36" height="36"
                                class="rounded-circle" alt="">
                        </div>
                        <div class="media-body">
                            <a href="#" class="media-title font-weight-semibold">Vanessa Aurelius</a>
                            <span class="d-block text-muted font-size-sm">UX expert</span>
                        </div>
                        <div class="ml-3 align-self-center"><span class="badge badge-mark border-secondary"></span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        {{-- </li> --}}
        </ul>
    </div>

    <ul class="navbar-nav flex-row order-1 order-lg-2 flex-1 flex-lg-0 justify-content-end align-items-center">
        <li class="nav-item nav-item-dropdown-lg dropdown dropdown-user h-100">
            <a href="#"
                class="navbar-nav-link navbar-nav-link-toggler  nav-link  dropdown-toggle d-inline-flex align-items-center h-100"
                data-toggle="dropdown">
                <img src={{ \Auth::user()->image ?? asset('admin') . '/logo/user_logo.png' }}
                    class="rounded-pill mr-lg-2" height="34" alt="">
                <span class="d-none d-lg-inline-block">{{ Auth::user()->name ?? '' }}</span>
            </a>

            <div class="dropdown-menu dropdown-menu-left" style="min-width: 9.5rem;">
                <a href="{{ route('user-logout') }}" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
            </div>
        </li>
    </ul>
</div>
<!-- /main navbar -->
