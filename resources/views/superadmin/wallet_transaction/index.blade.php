@extends('layouts.master')


@section('page_title')
    Wallet Transaction Module
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
                <div class="card-header">{{ __('Wallet Transaction') }}</div>

                <div class="card-body">
                    <x-table >
                        <thead>
                        <x-th>Date</x-th>
                        {{--                                    <x-th>Uploaded</x-th>--}}
                        <x-th>Transaction</x-th>
                        <x-th>Reference</x-th>
                        <x-th>Amount</x-th>
                        <x-th>Status</x-th>
                        <x-th>Action</x-th>
                        </thead>
                        <tbody>
                        @foreach($wallet_transactions as $wallet_transaction)
                            <tr>
                                <x-td>{{$wallet_transaction->trans_date}}</x-td>
                                {{--                                            <x-td><img width="100" height="100" src="{{asset('storage/wallet_attachments/'.$wallet_transaction->wallet_transaction_attachment->attachment)}}" alt=""></td>--}}
                                {{--                                            <x-td>{{$wallet_transaction->wallet_transaction_attachment->attachment}}</td>--}}
                                <x-td>{{$wallet_transaction->wallet_transaction_type->trans_description}}</x-td>
                                <x-td>{{$wallet_transaction->trans_reference}}</x-td>
                                <x-td>{{$wallet_transaction->trans_amount}}</x-td>
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

                                </x-td>
                                <x-td>
                                    @if($wallet_transaction->trans_status == 'pending')
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#showconfirmation{{$wallet_transaction->id}}">
                                            <i>approve</i>
                                        </button>
                                    @endif

                                    <form action="{{ route('wallet_transactions.update_request') }}" method="POST">
                                        @csrf
                                        {{--                                                    @method('PATCH')--}}
                                        <div class="modal fade" id="showconfirmation{{$wallet_transaction->id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">
                                                            Approve Confirmation
                                                        </h5>
                                                        <input type="text" hidden value="{{$wallet_transaction->id}}" name="wallet_id">
                                                    </div>
                                                    <div class="modal-body">
                                                        <b class="text-danger"> Are you sure to approve this load request ?</b>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary btn-danger" >Yes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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


@section('script')
    <script>
        $("#table").DataTable();
    </script>
@endsection


