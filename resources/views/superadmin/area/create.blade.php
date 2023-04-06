@extends('layouts.master')


@section('page_title')
    Area Module
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
            <form action="{{route('superadmin_areas.store')}}" method="POST">
                @csrf
                <div class="card mt-3">
                    <div class="card-header">
                        Create Area
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="">Name</label>
                            <input type="text" name="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror" >
                            @error('name')
                            <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="">Region</label>
                            <select name="region_id" class="form-control @error('name') is-invalid @enderror" id="">
                                <option value="">Choose Region</option>
                                @foreach($regions as $region)
                                    <option @if(old('region_id') == $region->id) selected @endif value="{{$region->id}}">{{$region->name}}</option>
                                @endforeach
                            </select>
                            @error('region_id')
                            <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{route('superadmin_areas.index')}}" class="float-end">Back</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('script')

@endsection



