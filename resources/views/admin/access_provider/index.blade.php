@extends('layouts.master')


@section('page_title')
    Access Provider Module
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
                    Access Provider Lists
                    <a class="btn btn-sm btn-primary float-end" href="{{route('admin_access_providers.create')}}"><i class="bi bi-plus"></i> Create Access Provider</a>
                </div>
                <div class="card-body">
                    <x-from-to></x-from-to>
                    <x-table >
                        <thead>
                        <x-th hidden>#</x-th>
                        <x-th>Transactions</x-th>
                        <x-th>CompleteName</x-th>
                        <x-th>Email</x-th>
                        <x-th>Account Name</x-th>
                        <x-th>Account Address</x-th>
                        <x-th>Phone Number</x-th>
                        <x-th>Provider Type</x-th>
                        <x-th>Date Started</x-th>
                        <x-th>Edit</x-th>
                        <x-th>Delete</x-th>

                        </thead>
                        <tbody>
                        @if($providers->count() > 0)
                            @foreach($providers as $key => $provider)
                                <tr>
                                    <x-td hidden>{{$key+1}}</x-td>
                                    <x-td>
                                        <a class="btn btn-sm btn-outline-primary" href="{{route('admin_access_providers.all_providers', [$provider->id])}}"> <i class="bi bi-envelope-dash"></i> Record</a>
                                    </x-td>
                                    <x-td>{{$provider->user->name}}</x-td>
                                    <x-td>{{$provider->user->email}}</x-td>
                                    <x-td>{{$provider->account_name}}</x-td>
                                    <x-td>{{$provider->account_address}}</x-td>
                                    <x-td>{{$provider->phone_number}}</x-td>
                                    <x-td>{{$provider->provider_types->type_description}}</x-td>
                                    <x-td>{{$provider->date_started}}</x-td>

                                    <x-td>
                                        <a href="{{route('admin_access_providers.edit', [$provider->id])}}">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </x-td>
                                    <x-td>
                                        <a href="" data-bs-toggle="modal" data-bs-target="#edit{{$provider->id}}">
                                            <i class="bi bi-trash"></i>
                                        </a>

                                        <form action="{{route('admin_access_providers.destroy', [$provider->id])}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal fade" id="edit{{$provider->id}}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            Delete
                                                            <i class="bi bi-question text-danger fa-1x"></i>
                                                        </div>
                                                        <div class="modal-body">
                                                            <span>Are you sure you want to delete this <b class="text-warning">{{$provider->account_name}}</b> provider?</span>
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
                        @endif
                        </tbody>
                    </x-table>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('datatable')
    @php
        $title = "Access Providers";
        $columns = "2,3,4,5,6,7,8";
        $target = "8";
        $orientation = "landscape";
        $pageSize = "LEGAL";
    @endphp
    <x-datatable :title="$title" :columns="$columns" :target="$target" :orientation="$orientation" :pageSize="$pageSize"></x-datatable>
@endsection


