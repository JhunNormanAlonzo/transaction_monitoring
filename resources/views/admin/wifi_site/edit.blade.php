@extends('admin.layouts.master')

@section('content')




    <main id="main" class="main justify-content-center">

        <div class="pagetitle">
            <h1>Role</h1>
        </div>

        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                @if (Session::has('message'))
                    <div class="alert alert-success" role="alert">
                        {{ Session('message') }}
                    </div>
                @endif
                <form action="{{route('roles.update', [$role->id])}}" method="POST">
                    @method('PATCH')
                    @csrf
                    <div class="card mt-3">
                        <div class="card-header">
                            Update Role
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="">Name</label>
                                <input type="text" name="name" value="{{$role->name}}" class="form-control @error('name') is-invalid @enderror" >
                                @error('name')
                                <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">Description</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" id=""  rows="2">{{$role->description}}</textarea>
                                @error('description')
                                <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{route('roles.index')}}" class="float-end">Back</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </main>


@endsection
