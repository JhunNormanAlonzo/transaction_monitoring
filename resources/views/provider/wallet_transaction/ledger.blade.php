@extends('layouts.master')


@section('page_title')
    Dashboard
@endsection

@section('header')

    <x-navbar></x-navbar>
    <x-sidebar></x-sidebar>
@endsection


@section('main')
    <div class="row">

        <!-- Wallet Balance Card -->
        <livewire:wallet-balance></livewire:wallet-balance>

        <!-- Send Load Card -->
        <livewire:send-load></livewire:send-load>

        <!-- Total Cash in Card -->
        <livewire:cash-in></livewire:cash-in>


        <div class="col-12">
            <div class="card recent-sales overflow-auto">

                {{--                            <div class="filter">--}}
                {{--                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>--}}
                {{--                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">--}}
                {{--                                    <li class="dropdown-header text-start">--}}
                {{--                                        <h6>Filter</h6>--}}
                {{--                                    </li>--}}

                {{--                                    <li><a class="dropdown-item" href="#">Today</a></li>--}}
                {{--                                    <li><a class="dropdown-item" href="#">This Month</a></li>--}}
                {{--                                    <li><a class="dropdown-item" href="#">This Year</a></li>--}}
                {{--                                </ul>--}}
                {{--                            </div>--}}

                <div class="card-body">
                    <h5 class="card-title">Ledger
                        {{--                                    <span>| Today</span>--}}
                    </h5>
                    <x-from-to></x-from-to>
                    <x-table >
                        <thead>
                        <x-th hidden>#</x-th>
                        <x-th>Date</x-th>
                        <x-th>Type</x-th>
                        <x-th>Load</x-th>
                        <x-th>Reference</x-th>
                        <x-th>Cellphone</x-th>
                        <x-th>Amount</x-th>
                        <x-th>Remarks</x-th>
                        <x-th>Status</x-th>
                        </thead>
                        <tbody>
                        @foreach($provider_wallet_ledgers as $key => $provider_wallet_ledger)
                            <tr>
                                <x-td hidden>{{$key +1}}</x-td>
                                <x-td>{{\Carbon\Carbon::parse($provider_wallet_ledger->trans_date)->format('Y-m-d')}}</x-td>
                                <x-td>{{$provider_wallet_ledger->trans_description}}</x-td>
                                <x-td>{{$provider_wallet_ledger->load_name}}</x-td>
                                <x-td>{{$provider_wallet_ledger->reference}}</x-td>
                                <x-td>{{$provider_wallet_ledger->cellphone}}</x-td>
                                <x-td>{{number_format($provider_wallet_ledger->amount, 2)}}</x-td>
                                <x-td>{{$provider_wallet_ledger->remarks}}</x-td>
                                <x-td>{{$provider_wallet_ledger->status}}</x-td>
                            </tr>
                        @endforeach
                        </tbody>
                    </x-table>

                </div>

            </div>
        </div>

    </div>
@endsection



@section('datatable')
    @php
        $title = "Ledger" ;
        $columns = "1,2,3,4,5,6,7,8";
        $target = "1";
        $orientation = "portrait";
        $pageSize = "LEGAL";
    @endphp
    <x-datatable :title="$title" :columns="$columns" :target="$target" :orientation="$orientation" :pageSize="$pageSize"></x-datatable>
@endsection

