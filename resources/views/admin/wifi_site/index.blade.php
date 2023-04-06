@extends('admin.layouts.master')

@section('content')

    <main id="main" class="main justify-content-center">

        <div class="pagetitle">
            <h1>Role</h1>
        </div>

        <div class="row">
            <div class="col-lg-12 offset-lg-0">
                @if (Session::has('message'))
                    <div class="alert alert-success" role="alert">
                        {{ Session('message') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        Roles Lists
                    </div>
                    <div class="card-body">
                        <x-table  >
                            <thead>
                                <x-th hidden>#</x-th>
                                <x-th>Name</x-th>
                                <x-th>Description</x-th>
                                <x-th>Edit</x-th>
                                <x-th>Delete</x-th>
                            </thead>
                            <tbody>

                                @forelse($roles as $key => $role)
                                    <tr>
                                        <x-td>{{$key+1}}</x-td>
                                        <x-td>{{$role->name}}</x-td>
                                        <x-td>{{$role->description}}</x-td>
                                        <x-td>
                                            <a href="{{route('roles.edit', [$role->id])}}">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                        </x-td>
                                        <x-td>
                                            <a href="" data-bs-toggle="modal" data-bs-target="#edit{{$role->id}}">
                                                <i class="bi bi-trash"></i>
                                            </a>

                                            <form action="{{route('roles.destroy', [$role->id])}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal fade" id="edit{{$role->id}}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                Delete
                                                                <i class="bi bi-question text-danger fa-1x"></i>
                                                            </div>
                                                            <div class="modal-body">
                                                                <span>Are you sure you want to delete this <b class="text-warning">{{$role->name}}</b> role?</span>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-secondary">Cancel</button>
                                                                <button  type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </x-td>

                                    </tr>
                                @empty
                                    <p class="text-center mt-1">No Record Found!</p>
                                @endforelse

                            </tbody>

                        </x-table>
                        <div class="d-flex">
                            {{$roles->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

@endsection
