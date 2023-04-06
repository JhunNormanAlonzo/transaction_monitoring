
@extends('layouts.master')


@section('page_title')
    File Upload  Module
@endsection

@section('header')
    <x-navbar></x-navbar>
    <x-sidebar></x-sidebar>
@endsection


@section('main')
    <div class="row">
        <div class="col-lg-8 offset-md-2 ">
            @if (Session::has('message'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="alert alert-success" role="alert">
                    {{ Session('message') }}
                </div>
            @endif
            <form action="{{route('superadmin_uploads.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card mt-3">
                    <div class="card-header">
                        Multiple Image Upload
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="file_name" class=" col-form-label text-md-end">{{ __('Upload File') }}</label>

                                <input type="file" accept=".jpg, .jpeg, .png" multiple class="form-control form-control-sm  @error('file_name') is-invalid @enderror" name="file_name[]"  autocomplete="file_name" autofocus>

                                @error('file_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="col-lg-12 col-sm-12">
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="{{route('superadmin_uploads.index')}}" class="float-end">Back</a>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('script')

@endsection





