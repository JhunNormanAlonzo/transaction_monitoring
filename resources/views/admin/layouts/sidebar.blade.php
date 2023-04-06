<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{route('admin_ledger')}}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->


        @if(Auth()->user()->role->name == 'admin')

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('admin_wallet_transactions.index')}}">
                    <i class="bi bi-send"></i>
                    <span>Wallet Request</span>
                </a>
            </li><!-- End Profile Page Nav -->

        @endif



        @if(Auth()->user()->role->name == 'admin')
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#access_provider" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-hand-index"></i><span>Access Provider</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="access_provider" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{route('admin_access_providers.index')}}">
                            <i class="bi bi-circle"></i><span>View Access Provider</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endif


        @if(Auth()->user()->role->name == 'admin')
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#reports" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-record"></i><span>Reports</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="reports" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{route('admin_access_providers.index')}}">
                            <i class="bi bi-circle"></i><span>View Access Provider</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endif



    </ul>

</aside>
