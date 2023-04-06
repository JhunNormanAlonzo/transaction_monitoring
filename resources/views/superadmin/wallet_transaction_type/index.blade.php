@extends('layouts.master')


@section('page_title')
    Wallet Transaction Type Module
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
                <div class="card-header">
                    {{ __('Wallet Transaction Type') }}
                    <a class="btn btn-primary btn-sm float-end" href="{{route('superadmin_transaction_types.create')}}"><i class="bi bi-plus"></i> Create</a>
                </div>

                <div class="card-body">
                    <x-table >
                        <thead>
                        <x-th>Description</x-th>
                        <x-th>Type</x-th>
                        <x-th>Approval</x-th>
                        <x-th>E-Wallet</x-th>
                        <x-th>ProviderTag</x-th>
                        <x-th>CreatedAt</x-th>
                        <x-th>Edit</x-th>
                        <x-th>Delete</x-th>
                        </thead>
                        <tbody>
                        @foreach($wallet_transaction_types as $wallet_transaction_type)
                            <tr>
                                <x-td>{{$wallet_transaction_type->trans_description}}</x-td>
                                <x-td>{{$wallet_transaction_type->trans_type}}</x-td>
                                <x-td>
                                    @if($wallet_transaction_type->approval)
                                        <span class="bg-success badge">yes</span>
                                    @else
                                        <span class="bg-dark badge">no</span>
                                    @endif
                                </x-td>
                                <x-td>
                                    @if($wallet_transaction_type->ewalletrans)
                                        <span class="bg-success badge">yes</span>
                                    @else
                                        <span class="bg-dark badge">no</span>
                                    @endif
                                </x-td>
                                <x-td>
                                    @if($wallet_transaction_type->providertag)
                                        <span class="bg-success badge">yes</span>
                                    @else
                                        <span class="bg-dark badge">no</span>
                                    @endif
                                </x-td>
                                <x-td>{{$wallet_transaction_type->created_at->format('Y-m-d')}}</x-td>
                                <x-td>
                                    <a href="{{route('superadmin_transaction_types.edit', [$wallet_transaction_type->id])}}">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </x-td>
                                <x-td>
                                    <a href="" data-bs-toggle="modal" data-bs-target="#delete{{$wallet_transaction_type->id}}">
                                        <i class="bi bi-trash"></i>
                                    </a>

                                    <form action="{{route('superadmin_transaction_types.destroy', [$wallet_transaction_type->id])}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal fade" id="delete{{$wallet_transaction_type->id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        Delete
                                                        <i class="bi bi-question text-danger fa-1x"></i>
                                                    </div>
                                                    <div class="modal-body">
                                                        <span>Are you sure you want to delete this <b class="text-warning">{{$wallet_transaction_type->trans_description}}</b> role?</span>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-secondary">Cancel</button>
                                                        <button  type="submit" class="btn btn-sm btn-danger">Delete</button>
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



@section('datatable')
    @php
        $title = "Wallet Transaction Types";
        $columns = "0,1,2,3,4,5";
        $target = "5";
        $orientation = "portrait";
        $pageSize = "LEGAL";
    @endphp
    <x-datatable :title="$title" :columns="$columns" :target="$target" :orientation="$orientation" :pageSize="$pageSize"></x-datatable>
@endsection


