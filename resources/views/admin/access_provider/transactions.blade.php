


@extends('layouts.master')


@section('page_title')
    Access Provider Transactions
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
                <div class="card-header text-primary">
                    <b style="font-size: 20px">
                        @if($wallet_transactions->count() > 0)
                            {{$wallet_transactions->first()->access_providers->account_name ?? 'Empty'}} <br> {{ __('Wallet Transaction') }}
                        @else
                            {{'Empty'}} <br> {{ __('Wallet Transaction') }}
                        @endif
                    </b>
                </div>
                <div class="card-body">
                    <x-from-to></x-from-to>
                    <x-table >
                        <thead>
                        <x-th hidden>#</x-th>
                        <x-th>Date</x-th>
                        <x-th>Uploaded</x-th>
                        <x-th>Transaction</x-th>
                        <x-th>Reference</x-th>
                        <x-th>Amount</x-th>
                        <x-th>ApprovedBy</x-th>
                        <x-th>Status</x-th>
                        </thead>
                        <tbody>
                        @foreach($wallet_transactions as $key => $wallet_transaction)
                            <tr>
                                <x-td hidden>{{$key+1}}</x-td>
                                <x-td>{{\Carbon\Carbon::parse($wallet_transaction->trans_date)->format('Y-m-d')}}</x-td>
                                <x-td>
                                    <a data-bs-toggle="modal" data-bs-target="#thumbnail{{$wallet_transaction->id}}">
                                        @if($wallet_transaction->wallet_transaction_attachment)
                                            <img width="100" height="100"  src="{{asset('storage/wallet_attachments/'.$wallet_transaction->wallet_transaction_attachment->attachment)}}" alt="">
                                        @endif
                                    </a>
                                    <div class="modal fade" id="thumbnail{{$wallet_transaction->id}}">
                                        <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">
                                                        Uploaded File
                                                    </h5>
                                                    <button type="button" data-bs-dismiss="modal" class="btn btn-dark btn-sm">close</button>
                                                </div>
                                                <div class="modal-body">
                                                    @if($wallet_transaction->wallet_transaction_attachment)
                                                        <img width="100%" src="{{asset('storage/wallet_attachments/'.$wallet_transaction->wallet_transaction_attachment->attachment)}}" alt="">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </x-td>
                                {{--                                            <x-td>{{$wallet_transaction->wallet_transaction_attachment->attachment}}</td>--}}

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
                                    @else
                                        <div class="badge bg-success">
                                            {{$wallet_transaction->trans_status}}
                                        </div>
                                    @endif
                                {{-- Its because i spent 10 years learning how to do that in 30 minutes --}}
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
        $title = $wallet_transactions->count() > 0 ? $wallet_transactions->first()->access_providers->account_name." Transactions" : 'Empty';
        $columns = "1,3,4,5,6,7";
        $target = "1";
        $orientation = "portrait";
        $pageSize = "LEGAL";
    @endphp
    <x-datatable :title="$title" :columns="$columns" :target="$target" :orientation="$orientation" :pageSize="$pageSize"></x-datatable>
@endsection








