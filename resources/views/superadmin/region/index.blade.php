@extends('layouts.master')


@section('page_title')
    Region Module
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
                    Region Lists
                    <a class="btn btn-sm btn-primary float-end" href="{{route('superadmin_regions.create')}}"><i class="bi bi-plus"></i> Create</a>
                </div>
                <div class="card-body">
                    <x-from-to></x-from-to>
                    <x-table >
                        <thead>
                        <x-th hidden>ID</x-th>
                        <x-th>Region</x-th>
                        <x-th>CreatedAt</x-th>
                        <x-th>Edit</x-th>
                        <x-th>Delete</x-th>
                        </thead>
                        <tbody>

                        @foreach($regions as $key => $region)
                            <tr>
                                <x-td hidden>{{$region->id}}</x-td>
                                <x-td>{{$region->name}}</x-td>
                                <x-td>{{$region->created_at->format('Y-m-d')}}</x-td>
                                <x-td>
                                    <a href="{{route('superadmin_regions.edit', [$region->id])}}">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </x-td>
                                <x-td>
                                    <a href="" data-bs-toggle="modal" data-bs-target="#edit{{$region->id}}">
                                        <i class="bi bi-trash"></i>
                                    </a>

                                    <form action="{{route('superadmin_regions.destroy', [$region->id])}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal fade" id="edit{{$region->id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        Delete
                                                        <i class="bi bi-question text-danger fa-1x"></i>
                                                    </div>
                                                    <div class="modal-body">
                                                        <span>Are you sure you want to delete this <b class="text-warning">{{$region->name}}</b> role?</span>
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
        $title = "Regions";
        $columns = "1,2";
        $target = "2";
        $orientation = "portrait";
        $pageSize = "LEGAL";
    @endphp
    <x-datatable :title="$title" :columns="$columns" :target="$target" :orientation="$orientation" :pageSize="$pageSize"></x-datatable>
@endsection



