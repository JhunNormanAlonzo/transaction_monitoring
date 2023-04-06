@extends('layouts.master')

@section('header')
    <x-navbar></x-navbar>
    <x-sidebar></x-sidebar>
@endsection

@section('page_title')
    Wallet Transaction
@endsection
@section('main')
    @if (Session::has('message'))
        <div class="alert alert-success" role="alert">
            {{ Session('message') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">{{ __('Wallet Transaction') }}</div>
        <div class="card-body">
            <x-table >
                <thead>
                <x-th hidden>#</x-th>
                <x-th>Date</x-th>
                <x-th>Uploaded</x-th>
                <x-th>Account Name</x-th>
                <x-th>Transaction</x-th>
                <x-th>Reference</x-th>
                <x-th>Amount</x-th>
                <x-th>ApprovedBy</x-th>
                <x-th>Status</x-th>
                <x-th>Action</x-th>
                </thead>
                <tbody>
                @foreach($wallet_transactions as $key => $wallet_transaction)
                    <tr>
                        <x-td hidden>{{$key+1}}</x-td>
                        <x-td>{{$wallet_transaction->trans_date}}</x-td>
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
                                                <img width="100%"   src="{{asset('storage/wallet_attachments/'.$wallet_transaction->wallet_transaction_attachment->attachment)}}" alt="">
                                            @endif
                                            {{--                                                                <img width="100%" src="{{asset('storage/wallet_attachments/'.$wallet_transaction->wallet_transaction_attachment->attachment)}}" alt="">--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </x-td>
                        {{--                                            <x-td>{{$wallet_transaction->wallet_transaction_attachment->attachment}}</td>--}}
                        <x-td>
                            @if($wallet_transaction->access_providers)
                                {{$wallet_transaction->access_providers->account_name}}
                            @endif
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
                                <div class="badge bg-primary">
                                    {{$wallet_transaction->trans_status}}
                                </div>
                            @endif

                        </x-td>
                        <x-td>
                            @if($wallet_transaction->trans_status == 'pending')
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#showconfirmation{{$wallet_transaction->id}}">
                                        <i>approve</i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#showdecline{{$wallet_transaction->id}}">
                                        <i>decline</i>
                                    </button>
                                </div>

                            @endif

                            <form action="{{ route('admin_wallet_transactions.decline_request') }}" method="POST">
                                @csrf
                                {{--                                                    @method('PATCH')--}}
                                <div class="modal fade" id="showdecline{{$wallet_transaction->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">
                                                    Decline Confirmation
                                                </h5>
                                                <input type="text" hidden value="{{$wallet_transaction->id}}" name="wallet_id">
                                                <input type="text" hidden name="email" value="{{$wallet_transaction->users->email}}">
                                            </div>
                                            <div class="modal-body">
                                                <b class="text-dark"> Are you sure to decline this load request ?</b>
                                                <textarea name="approval_comment" id="" required class="form-control form-text" rows="3" placeholder="Unsa ba gyud rason!"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary btn-danger" >Yes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <form action="{{ route('admin_wallet_transactions.approve_request') }}" method="POST">
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
                                                <input type="text" hidden name="email" value="{{$wallet_transaction->users->email}}">
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

    <script>
        $("#table").DataTable({
            scrollY: "",
            scrollX: true,
            paging: true,
            fixedColumns: true
        });
    </script>


@endsection
