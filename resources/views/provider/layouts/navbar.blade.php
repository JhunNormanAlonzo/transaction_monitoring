<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <a href="{{route('provider_ledger')}}" class="logo d-flex align-items-center">
            <img src="assets/img/logo.png" alt="">
            <span class="d-none d-lg-block">{{ 'FiberGigaBandWifi' }}</span>
        </a>
        @auth
        <i class="bi bi-list toggle-sidebar-btn"></i>
        @endauth
    </div><!-- End Logo -->

{{--    <div class="search-bar">--}}
{{--        <form class="search-form d-flex align-items-center" method="POST" action="#">--}}
{{--            <input type="text" name="query" placeholder="Search" title="Enter search keyword">--}}
{{--            <button type="submit" title="Search"><i class="bi bi-search"></i></button>--}}
{{--        </form>--}}
{{--    </div><!-- End Search Bar -->--}}

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">


            <li class="nav-item dropdown pe-3">
                @auth
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="{{asset('NiceAdmin/assets/img/profile-img.jpg')}}" alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{isset(Auth()->user()->name) ? Auth()->user()->name : "Guest"}}</span>
                </a><!-- End Profile Iamge Icon -->
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{isset(auth()->user()->name) ? auth()->user()->name : "Guest"}}</h6>
                        <span>{{isset(auth()->user()->role->name) ? ucwords(Auth()->user()->role->name) : "No Role"}}</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                            <i class="bi bi-person"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                            <i class="bi bi-gear"></i>
                            <span>Account Settings</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                            <i class="bi bi-question-circle"></i>
                            <span>Need Help?</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>{{ __('Sign Out') }}</span>
                        </a>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
                @else
                    <a href="{{ route('login') }}" class="btn btn-sm btn-primary">Log in</a>
                @endauth
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->
