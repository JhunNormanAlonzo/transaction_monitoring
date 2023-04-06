@extends('admin.layouts.master')

@section('content')

    <main id="main" class="main justify-content-center">

        <div class="pagetitle">
            <h1>Users</h1>
        </div>

        <div class="row">
            <div class="col-lg-12 offset-lg-0">
                @if (Session::has('message'))
                    <div class="alert alert-success" role="alert">
                        {{ Session('message') }}
                    </div>
                @endif
                <div class="row">
                    <div class="col-12 my-2">
                        <a class="btn btn-sm btn-primary float-end" href="{{route('admin_users.create')}}"><i class="bi bi-plus"></i> Create User</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        Users
                    </div>
                    <div class="card-body">
                        @if($users->count() > 0)
                            <x-table  >
                                <thead>
                                <x-th hidden>#</x-th>
                                <x-th>Name</x-th>
                                <x-th>Email</x-th>
                                <x-th>Municipality</x-th>
                                <x-th>Province</x-th>
                                <x-th>Gender</x-th>
                                <x-th>Age</x-th>
                                <x-th>Role</x-th>
                                {{--                                    <x-th>Edit</x-th>--}}
                                {{--                                    <x-th>Delete</x-th>--}}
                                </thead>
                                <tbody>

                                @foreach($users as $key => $user)
                                    <tr>
                                        <x-td>{{$key+1}}</x-td>
                                        <x-td>{{$user->name}}</x-td>
                                        <x-td>{{$user->email}}</x-td>
                                        <x-td>{{$user->municipality}}</x-td>
                                        <x-td>{{$user->province}}</x-td>
                                        <x-td>{{$user->gender}}</x-td>
                                        <x-td>{{$user->age}}</x-td>
                                        <x-td>{{$user->role->name ?? ''}}</x-td>

                                        {{--                                            <x-td>--}}
                                        {{--                                                <a href="{{route('users.edit', [$user->id])}}">--}}
                                        {{--                                                    <i class="bi bi-pencil"></i>--}}
                                        {{--                                                </a>--}}
                                        {{--                                            </td>--}}
                                        {{--                                            <x-td>--}}
                                        {{--                                                <a href="" data-bs-toggle="modal" data-bs-target="#edit{{$user->id}}">--}}
                                        {{--                                                    <i class="bi bi-trash"></i>--}}
                                        {{--                                                </a>--}}

                                        {{--                                                <form action="{{route('users.destroy', [$user->id])}}" method="POST">--}}
                                        {{--                                                    @csrf--}}
                                        {{--                                                    @method('DELETE')--}}
                                        {{--                                                    <div class="modal fade" id="edit{{$user->id}}">--}}
                                        {{--                                                        <div class="modal-dialog">--}}
                                        {{--                                                            <div class="modal-content">--}}
                                        {{--                                                                <div class="modal-header">--}}
                                        {{--                                                                    Delete--}}
                                        {{--                                                                    <i class="bi bi-question text-danger fa-1x"></i>--}}
                                        {{--                                                                </div>--}}
                                        {{--                                                                <div class="modal-body">--}}
                                        {{--                                                                    <span>Are you sure you want to delete this <b class="text-warning">{{$user->name}}</b> provider?</span>--}}
                                        {{--                                                                </div>--}}
                                        {{--                                                                <div class="modal-footer">--}}
                                        {{--                                                                    <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-secondary">Cancel</button>--}}
                                        {{--                                                                    <button  type="submit" class="btn btn-sm btn-danger">Delete</button>--}}
                                        {{--                                                                </div>--}}
                                        {{--                                                            </div>--}}
                                        {{--                                                        </div>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                </form>--}}
                                        {{--                                            </td>--}}

                                    </tr>
                                @endforeach
                                </tbody>

                            </x-table>
                        @else

                        @endif

                    </div>
                </div>
            </div>
        </div>

    </main>

@endsection
