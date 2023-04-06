<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{url('/')}}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->





        @if(Auth()->user()->role->name == 'superadmin')
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#users" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-people"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="users" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{route('superadmin_users.index')}}">
                            <i class="bi bi-circle"></i><span>View User</span>
                        </a>
                    </li>
{{--                    <li>--}}
{{--                        <a href="">--}}
{{--                            <i class="bi bi-circle"></i><span>Create User</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}

                </ul>
            </li><!-- End Forms Nav -->
        @endif


        @if(Auth()->user()->role->name == 'superadmin')
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#wifi_site" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-wifi"></i><span>Wifi Sites</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="wifi_site" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{route('superadmin_wifi_sites.index')}}">
                            <i class="bi bi-circle"></i><span>View Site</span>
                        </a>
                    </li>

                </ul>
            </li><!-- End Forms Nav -->
        @endif


        @if(Auth()->user()->role->name == 'superadmin')
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#roles" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-shield"></i><span>Roles</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="roles" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{route('superadmin_roles.index')}}">
                            <i class="bi bi-circle"></i><span>View Roles</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Forms Nav -->
        @endif




    @if(Auth()->user()->role->name == 'superadmin')
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#access_provider" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-hand-index"></i><span>Access Provider</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="access_provider" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{route('superadmin_access_providers.index')}}">
                            <i class="bi bi-circle"></i><span>View Access Provider</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Forms Nav -->
        @endif



        @if(Auth()->user()->role->name == 'superadmin')
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#areas" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-globe"></i><span>Areas</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="areas" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{route('superadmin_areas.index')}}">
                            <i class="bi bi-circle"></i><span>View Areas</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Forms Nav -->
        @endif


        @if(Auth()->user()->role->name == 'superadmin')
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#regions" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-map"></i><span>Regions</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="regions" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{route('superadmin_regions.index')}}">
                            <i class="bi bi-circle"></i><span>View Region</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Forms Nav -->
        @endif


        @if(Auth()->user()->role->name == 'superadmin')
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#load_types" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-telephone"></i><span>Load Type</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="load_types" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{route('superadmin_load_types.index')}}">
                            <i class="bi bi-circle"></i><span>View Load Type</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Forms Nav -->
        @endif

        @if(Auth()->user()->role->name == 'superadmin')
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#provider_types" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-nut"></i><span>Provider Type</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="provider_types" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{route('superadmin_provider_types.index')}}">
                            <i class="bi bi-circle"></i><span>View Provider Type</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Forms Nav -->
        @endif


        @if(Auth()->user()->role->name == 'superadmin')
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#wallet_transaction_type" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-nut"></i><span>Wallet Transaction Type</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="wallet_transaction_type" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{route('superadmin_transaction_types.index')}}">
                            <i class="bi bi-circle"></i><span>View Transaction Type</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Forms Nav -->
        @endif

        @if(Auth()->user()->role->name == 'superadmin')
            <li class="nav-item">
                <a class="nav-link" href="{{route('superadmin_access_codes.send_load')}}">
                    <i class="bi bi-nut"></i><span>Loaded Transaction</span>
                </a>
            </li><!-- End Forms Nav -->
        @endif












    </ul>

</aside>
