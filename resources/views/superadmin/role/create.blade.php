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
        <div class="col-lg-6 offset-lg-3">
            @if (Session::has('message'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="alert alert-success" role="alert">
                    {{ Session('message') }}
                </div>
            @endif
            <form action="{{route('superadmin_roles.store')}}" method="POST">
                @csrf
                <div class="card mt-3">
                    <div class="card-header">
                        Create Role
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
                            <label for="">Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" id=""  rows="2">{{old('description')}}</textarea>
                            @error('description')
                            <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{route('superadmin_roles.index')}}" class="float-end">Back</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('script')

@endsection



