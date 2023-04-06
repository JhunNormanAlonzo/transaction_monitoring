
@extends('layouts.master')


@section('page_title')
    Images
@endsection

@section('header')
    <x-navbar></x-navbar>
    <x-sidebar></x-sidebar>
@endsection


@section('main')
    <div class="row">
        <div class="col-lg-12  ">
            @if (Session::has('message'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="alert alert-success" role="alert">
                    {{ Session('message') }}
                </div>
            @endif

                <div class="row">
                    <div class="col-12 mb-3">
                        <a class="btn btn-sm btn-primary" href="{{route('superadmin_uploads.create')}}"><i class="bi bi-upload"></i> Upload Image</a>
                    </div>
                @forelse($uploads as $key => $file)
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Image {{$key+1}}
                                <div class="float-end d-flex">

                                    <a href="{{route('superadmin_uploads.edit', [$file->id])}}" class="btn btn-sm btn-info">Change</a>
                                    <form action="{{route('superadmin_uploads.destroy', [$file->id])}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>

                                </div>

                            </h5>

                            <img src="{{asset('storage/login/'.$file->file_name)}}" width="100%" height="200" class="d-block" alt="...">
                        </div>
                    </div>
                </div>
                    @empty
                    <div class="col-12">
                        <h5 class="text-center">No Uploaded files.</h5>
                    </div>
                    @endforelse
                <div class="col-12">
                    <div class="d-flex">{{$uploads->links()}}</div>
                </div>
            </div>


        </div>
    </div>
@endsection








