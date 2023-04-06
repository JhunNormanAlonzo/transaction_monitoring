@extends('layouts.master')


@section('page_title')
    Provider Type Module
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
            <form action="{{route('superadmin_provider_types.store')}}" method="POST">
                @csrf
                <div class="card mt-3">
                    <div class="card-header">
                        Create Provider Type
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="">Type Description</label>
                            <input type="text" name="type_description" value="{{old('type_description')}}" class="form-control @error('type_description') is-invalid @enderror" >
                            @error('type_description')
                            <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="">Discount Rate</label>
                            <input type="number" step=".01" name="discount_rate" value="{{old('discount_rate')}}" class="form-control @error('discount_rate') is-invalid @enderror" >
                            @error('discount_rate')
                            <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{route('superadmin_provider_types.index')}}" class="float-end">Back</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('script')

@endsection





