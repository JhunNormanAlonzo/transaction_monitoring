@extends('layouts.master')


@section('page_title')
    Wifi Site Module
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
                    Wifi Site Lists
                    <a class="btn btn-primary btn-sm float-end" href="{{route('superadmin_wifi_sites.create')}}"><i class="bi bi-plus"></i> Create</a>
                </div>
                <div class="card-body ">
                    <x-from-to></x-from-to>
                    <x-table >
                        <thead >
                        <x-th>Site Name</x-th>
                        <x-th>Equipment</x-th>
                        <x-th>Mac Address</x-th>
                        <x-th>Area</x-th>
                        <x-th>CreatedAt</x-th>
                        <x-th>Edit</x-th>
                        <x-th>Delete</x-th>
                        </thead>
                        <tbody>

                        @foreach($wifi_sites as $wifi_site)
                            <tr>
                                <x-td>{{$wifi_site->site_name}}</x-td>
                                <x-td>{{$wifi_site->equipment}}</x-td>
                                <x-td>{{$wifi_site->macaddress}}</x-td>
                                <x-td>{{$wifi_site->areas->name}}</x-td>
                                <x-td>{{$wifi_site->created_at->format('Y-m-d')}}</x-td>
                                <x-td>
                                    <a href="{{route('superadmin_wifi_sites.edit', [$wifi_site->id])}}">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </x-td>
                                <x-td>
                                    <a href="" data-bs-toggle="modal" data-bs-target="#edit{{$wifi_site->id}}">
                                        <i class="bi bi-trash"></i>
                                    </a>

                                    <form action="{{route('superadmin_wifi_sites.destroy', [$wifi_site->id])}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal fade" id="edit{{$wifi_site->id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        Confirm Delete
                                                        <i class="bi bi-question text-danger fa-1x"></i>
                                                    </div>
                                                    <div class="modal-body">
                                                        <span>Are you sure you want to delete this <b class="text-warning">{{$wifi_site->site_name}}</b> ?</span>
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

@section('script')

@endsection




@section('datatable')
    @php
        $title = "Wifi Sites";
        $columns = "0,1,2,3,4";
        $target = "4";
        $orientation = "portrait";
        $pageSize = "LEGAL";
    @endphp
    <x-datatable :title="$title" :columns="$columns" :target="$target" :orientation="$orientation" :pageSize="$pageSize"></x-datatable>
@endsection
