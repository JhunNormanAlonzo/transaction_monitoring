@extends('layouts.master')


@section('page_title')
    Import Log Module
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
                    Import Lists
                    <a class="btn btn-sm btn-primary float-end" href="{{route('superadmin_access_codes.index')}}"><i class="bi bi-plus"></i> Import</a>
                </div>
                <div class="card-body">
                    <x-from-to></x-from-to>
                    <x-table>
                        <thead>
                        <x-th hidden>ID</x-th>
                        <x-th>Wifi Site</x-th>
                        <x-th>Batch</x-th>
                        <x-th>ImportBy</x-th>
                        <x-th>Total</x-th>
                        </thead>
                        <tbody>

                        @foreach($import_logs as $key => $log)
                            <tr>
                                <x-td hidden>{{$key+1}}</x-td>
                                <x-td>{{$log->wifi_site->site_name}}</x-td>
                                <x-td>{{$log->batch}}</x-td>
                                <x-td>{{$log->user->FullName}}</x-td>
                                <x-td>{{ \App\Models\AccessCode::where('import_log_id', $log->id)->count()}}</x-td>

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
        $title = "Import Logs";
        $columns = "1,2,3,4";
        $target = "2";
        $orientation = "portrait";
        $pageSize = "LEGAL";
    @endphp
    <x-datatable :title="$title" :columns="$columns" :target="$target" :orientation="$orientation" :pageSize="$pageSize"></x-datatable>
@endsection






