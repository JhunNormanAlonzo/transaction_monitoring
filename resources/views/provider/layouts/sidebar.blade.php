<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{route('provider_ledger')}}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->



        @if(Auth()->user()->role->name == 'access provider')
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('provider_wallet_transactions.index')}}">
                    <i class="bi bi-hand-index"></i>
                    <span>Wallet Transaction</span>
                </a>
            </li><!-- End Profile Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('provider_wallet_transactions.create')}}">
                    <i class="bi bi-wifi"></i>
                    <span>Cash In Transaction</span>
                </a>
            </li><!-- End Profile Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('provider_load_transactions.create')}}">
                    <i class="bi bi-send"></i>
                    <span>Cash Out Transaction</span>
                </a>
            </li><!-- End Profile Page Nav -->


        @endif
    </ul>

</aside>
