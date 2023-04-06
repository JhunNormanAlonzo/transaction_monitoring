@extends('layouts.master')


@section('page_title')
    Ledger Module
@endsection

@section('header')
    <x-navbar></x-navbar>
    <x-sidebar></x-sidebar>
@endsection


@section('main')
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            @if (Session::has('message'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="alert alert-success" role="alert">
                    {{ Session('message') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Ledger') }}</div>
                <div class="card-body">
                    <x-from-to></x-from-to>
                    <x-table>
                        <thead>
                        <x-th>trans_date</x-th>
                        <x-th>access_provider</x-th>
                        <x-th>trans_description</x-th>
                        <x-th>load_name</x-th>
                        <x-th>reference</x-th>
                        <x-th>cellphone</x-th>
                        <x-th>amount</x-th>
                        <x-th>remarks</x-th>
                        <x-th>status</x-th>
                        <x-th>encoded_by</x-th>
                        <x-th>approved_by</x-th>
                        </thead>
                        <tbody>
                        @foreach($provider_wallet_ledgers as $provider_wallet_ledger)
                            <tr>
                                <x-td>{{\Carbon\Carbon::parse($provider_wallet_ledger->trans_date)->format('Y-m-d')}}</x-td>
                                <x-td>{{$provider_wallet_ledger->access_providers->account_name}}</x-td>
                                <x-td>{{$provider_wallet_ledger->trans_description}}</x-td>
                                <x-td>{{$provider_wallet_ledger->load_name}}</x-td>
                                <x-td>{{$provider_wallet_ledger->reference}}</x-td>
                                <x-td>{{$provider_wallet_ledger->cellphone}}</x-td>
                                <x-td>{{$provider_wallet_ledger->amount}}</x-td>
                                <x-td>{{$provider_wallet_ledger->remarks}}</x-td>
                                <x-td>{{$provider_wallet_ledger->status}}</x-td>
                                <x-td>{{$provider_wallet_ledger->encoded_by}}</x-td>
                                <x-td>{{$provider_wallet_ledger->approved_by}}</x-td>
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
        $title = "Ledger Transactions";
        $columns = "0,1,2,3,4,5,6,7,8,9,10";
        $target = "0";
        $orientation = "landscape";
        $pageSize = "LEGAL";
    @endphp
    <x-datatable :title="$title" :columns="$columns" :target="$target" :orientation="$orientation" :pageSize="$pageSize"></x-datatable>
@endsection
