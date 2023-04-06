@extends('layouts.master')


@section('page_title')
    Send Load Module
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
                <div class="card-header">{{ __('Send Load') }}</div>

                <div class="card-body">
                    <x-from-to></x-from-to>
                    <x-table>
                        <thead>
                            <x-th hidden>#</x-th>
                            <x-th>Loader</x-th>
                            <x-th>loadType</x-th>
                            <x-th>Amount</x-th>
                            <x-th>VoucherCode</x-th>
                            <x-th>Duration</x-th>
                            <x-th>LoadedAt</x-th>
                        </thead>
                        <tbody>
                        @foreach($access_codes as $key => $access_code)
                            <tr>
                                <x-td hidden>{{$key+1}}</x-td>
                                <x-td>{{$access_code->users->access_providers->account_name}}</x-td>
                                <x-td>{{$access_code->load_types->load_name}}</x-td>
                                <x-td>{{$access_code->wallet_transaction->trans_amount}}</x-td>
                                <x-td>{{$access_code->voucher_code}}</x-td>
                                <x-td>{{$access_code->duration_mins}}</x-td>
                                <x-td>{{\Carbon\Carbon::parse($access_code->loaded_at)->format('Y-m-d')}}</x-td>
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
        $title = "Send Load";
        $columns = "1,2,3,4,5,6";
        $target = "6";
        $orientation = "portrait";
        $pageSize = "LEGAL";
    @endphp
    <x-datatable :title="$title" :columns="$columns" :target="$target" :orientation="$orientation" :pageSize="$pageSize"></x-datatable>
@endsection


