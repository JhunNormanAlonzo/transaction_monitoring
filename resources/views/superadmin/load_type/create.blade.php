@extends('layouts.master')


@section('page_title')
    Load Type Module
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
            <form action="{{route('superadmin_load_types.store')}}" method="POST">
                @csrf
                <div class="card mt-3">
                    <div class="card-header">
                        Create Load Type
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="">Load Name</label>
                            <input type="text" name="load_name" value="{{old('load_name')}}" class="form-control @error('load_name') is-invalid @enderror" >
                            @error('load_name')
                            <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="">Load Credits</label>
                            <input type="text" name="load_credits" value="{{old('load_credits')}}" class="form-control @error('load_credits') is-invalid @enderror" >
                            @error('load_credits')
                            <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="">Comments</label>
                            <textarea name="comments" id="" class="form-control @error('comments') is-invalid @enderror" rows="3"></textarea>

                            @error('comments')
                            <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{route('superadmin_load_types.index')}}" class="float-end">Back</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('script')

@endsection






