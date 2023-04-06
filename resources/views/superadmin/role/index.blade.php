@extends('layouts.master')


@section('page_title')
    Role Module
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
                    Roles Lists

                    <a class="btn btn-sm btn-primary float-end" href="{{route('superadmin_roles.create')}}"><i class="bi bi-plus"></i> Create</a>
                </div>
                <div class="card-body">
                    <x-from-to></x-from-to>
                    <x-table >
                        <thead>
                        <x-th hidden>#</x-th>
                        <x-th>Name</x-th>
                        <x-th>Description</x-th>
                        <x-th>CreatedAt</x-th>
                        <x-th>Edit</x-th>
                        <x-th>Delete</x-th>
                        </thead>
                        <tbody>

                        @foreach($roles as $key => $role)
                            <tr>
                                <x-td hidden>{{$key+1}}</x-td>
                                <x-td>{{$role->name}}</x-td>
                                <x-td>{{$role->description}}</x-td>
                                <x-td>{{$role->created_at->format('Y-m-d')}}</x-td>
                                <x-td>
                                    <a href="{{route('superadmin_roles.edit', [$role->id])}}">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </x-td>
                                <x-td>
                                    <a href="" data-bs-toggle="modal" data-bs-target="#edit{{$role->id}}">
                                        <i class="bi bi-trash"></i>
                                    </a>

                                    <form action="{{route('superadmin_roles.destroy', [$role->id])}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal fade" id="edit{{$role->id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        Delete
                                                        <i class="bi bi-question text-danger fa-1x"></i>
                                                    </div>
                                                    <div class="modal-body">
                                                        <span>Are you sure you want to delete this <b class="text-warning">{{$role->name}}</b> role?</span>
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
        $title = "Roles";
        $columns = "1,2,3";
        $target = "3";
        $orientation = "portrait";
        $pageSize = "LEGAL";
    @endphp
    <x-datatable :title="$title" :columns="$columns" :target="$target" :orientation="$orientation" :pageSize="$pageSize"></x-datatable>
@endsection


