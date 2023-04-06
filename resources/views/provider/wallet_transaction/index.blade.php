


@extends('layouts.master')


@section('page_title')
    Wallet Transaction Module
@endsection

@section('header')
    <x-navbar></x-navbar>
    <x-sidebar></x-sidebar>
@endsection


@section('main')
    <div class="row">

        <div class="col-lg-12 offset-lg-0">
            @if (Session::has('message'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="alert alert-success" role="alert">
                    {{ Session('message') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                   Wallet Transaction
                </div>
                <div class="card-body">
                    <x-from-to></x-from-to>
                    <x-table>
                        <thead>
                        <x-th hidden>#</x-th>
                        <x-th>Date</x-th>
                        <x-th>Uploaded</x-th>
                        <x-th>Transaction</x-th>
                        <x-th>Reference</x-th>
                        <x-th>Amount</x-th>
                        <x-th>ApprovedBy</x-th>
                        <x-th>Status</x-th>
                        {{--                                    <x-th>Action</x-th>--}}
                        </thead>
                        <tbody>
                        @foreach($wallet_transactions as $key => $wallet_transaction)
                            <tr style="@if($wallet_transaction->trans_status == 'DECLINE') background: linear-gradient(to right, rgba(222,222,222,0.5), rgb(175,246,145)) @endif" >
                                <x-td hidden>{{$key+1}}</x-td>
                                <x-td>{{\Carbon\Carbon::parse($wallet_transaction->trans_date)->format('Y-m-d')}}</x-td>
                                <x-td>
                                    <img class="rounded rounded-circle" width="50" height="50" src="{{asset('storage/wallet_attachments/'.$wallet_transaction->wallet_transaction_attachment->attachment)}}" alt="">
                                </x-td>
                                <x-td>{{$wallet_transaction->wallet_transaction_type->trans_description}}</x-td>
                                <x-td>{{$wallet_transaction->trans_reference}}</x-td>
                                <x-td>{{$wallet_transaction->trans_amount}}</x-td>
                                <x-td>
                                    @if($wallet_transaction->approver)
                                        {{$wallet_transaction->approver->name}}
                                    @endif
                                </x-td>
                                <x-td>
                                    @if($wallet_transaction->trans_status == 'pending')
                                        <div class="badge bg-warning">
                                            {{$wallet_transaction->trans_status}}
                                        </div>
                                    @elseif($wallet_transaction->trans_status == 'approved')
                                        <div class="badge bg-success">
                                            {{$wallet_transaction->trans_status}}
                                        </div>
                                    @else
                                        <div class="badge bg-danger">
                                            {{$wallet_transaction->trans_status}}
                                        </div>
                                    @endif

                                </x-td>

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
        $title = "Wallet Transactions";
        $columns = "1,3,4,5,6,7";
        $target = "1";
        $orientation = "portrait";
        $pageSize = "LEGAL";
    @endphp
    <x-datatable :title="$title" :columns="$columns" :target="$target" :orientation="$orientation" :pageSize="$pageSize"></x-datatable>
@endsection


