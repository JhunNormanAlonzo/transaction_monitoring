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
        <div class="col-lg-6 offset-lg-3">
            @if (Session::has('message'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="alert alert-success" role="alert">
                    {{ Session('message') }}
                </div>
            @endif
            <form action="{{route('superadmin_wifi_sites.store')}}" method="POST">
                @csrf
                <div class="card mt-3">
                    <div class="card-header">
                        Create Wifi Site
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="">Name</label>
                            <input type="text" name="site_name" value="{{old('site_name')}}" class="form-control @error('site_name') is-invalid @enderror" >
                            @error('site_name')
                            <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">Equipment</label>
                            <input type="text" name="equipment" value="{{old('equipment')}}" class="form-control @error('equipment') is-invalid @enderror" >
                            @error('equipment')
                            <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">MAC Address</label>
                            {{--                                @php--}}
                            {{--                                    $mac = exec('getmac');--}}
                            {{--                                    $mac = strtok($mac, ' ');--}}
                            {{--                                @endphp--}}
                            <input type="text"  name="macaddress" value="{{old('macaddress')}}" class="form-control @error('macaddress') is-invalid @enderror" >
                            @error('macaddress')
                            <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">Area ID</label>

                            <select name="area_id" id="" class="form-control @error('area_id') is-invalid @enderror">
                                <option value="">Choose Area</option>
                                @foreach($areas as $area)
                                    <option @if(old('area_id') == $area->id) selected @endif value="{{$area->id}}">{{$area->name}}</option>
                                @endforeach
                            </select>
                            @error('area_id')
                            <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{route('superadmin_wifi_sites.index')}}" class="float-end">Back</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('script')

@endsection


