<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <a href="#" class="logo d-flex align-items-center">
            <img src="assets/img/logo.png" alt="">
            <span class="d-none d-lg-block">{{ 'FiberGigaBandWifi' }}</span>
        </a>
        @auth
        <i class="bi bi-list toggle-sidebar-btn"></i>
        @endauth
    </div>
    @php
        $wallet_transaction_notifications = \App\Models\WalletTransaction::where('trans_status', 'pending')
            ->where('load_type_id', null)
            ->latest()
            ->get();
    @endphp
    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item dropdown">

                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-bell"></i>
                    @if($wallet_transaction_notifications->count() > 0)
                    <span class="badge bg-primary badge-number">{{$wallet_transaction_notifications->count()}}</span>
                    @endif
                </a><!-- End Notification Icon -->

                @if($wallet_transaction_notifications->count() > 0)
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications " style="@if($wallet_transaction_notifications->count() > 5) height: 400px; @endif  overflow-y: scroll;">
                    <li class="dropdown-header sticky-top bg-white" >

                        You have {{$wallet_transaction_notifications->count()}} new {{$wallet_transaction_notifications->count() > 1 ? 'notifications' : 'notification'}}
{{--                        <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>--}}
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    @foreach($wallet_transaction_notifications as $wtn)
                    <li class="notification-item">
                        <i class="bi bi-exclamation-circle text-warning"></i>
                        <div>
                            <h4>{{$wtn->access_providers->account_name}}</h4>
                            <p>{{$wtn->wallet_transaction_type->trans_description}}</p>
                            <p>{{$wtn->created_at->diffForHumans()}}</p>
                        </div>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    @endforeach

{{--                    <li class="dropdown-footer">--}}
{{--                        <a href="#">Show all notifications</a>--}}
{{--                    </li>--}}

                </ul><!-- End Notification Dropdown Items -->
                @endif
            </li>




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
