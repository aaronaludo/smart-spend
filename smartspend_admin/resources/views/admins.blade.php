@extends('layouts.app')
@section('title', 'Admins')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">Admins</h1></div>
                @if (auth()->guard('admin')->user()->role_id === 1)
                    <div class="d-flex align-items-center"><a class="btn btn-success" href="{{ route('admins.add') }}"><i class="fa-solid fa-plus"></i>&nbsp;&nbsp;&nbsp;Add Admin</a></div>
                @endif
            </div>
            <div class="col-lg-12 mb-20">
                <div class="box">
                    <div class="row">
                        <div class="col-lg-10">
                        <form action="{{ route('admins.search') }}" method="GET">
                                <div class="input-group mb-3 mb-lg-0">
                                    <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                                    <input type="text" class="form-control" name="search" placeholder="Search by email"/>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <button type="submit" class="btn btn-success w-100">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Created Date</th>
                                        <th>Actions</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($admins as $admin)
                                        <tr>
                                            <td>{{ $admin->id }}</td>
                                            <td>{{ $admin->first_name .' '. $admin->last_name }}</td>
                                            <td>{{ $admin->email }}</td>
                                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $admin->created_at)->format('F d, Y h:i A') }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="action-button"><a href="{{ route('admins.view', $admin->id) }}" title="View"><i class="fa-solid fa-eye"></i></a></div>
                                                    @if (auth()->guard('admin')->user()->role_id === 1)
                                                        <div class="action-button">
                                                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#delete-modal-{{ $admin->id }}" title="Delete">
                                                                <i class="fa-solid fa-trash color-red"></i>
                                                            </button>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="delete-modal-{{ $admin->id }}" tabindex="-1" aria-labelledby="delete-modal-{{ $admin->id }}-label" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="delete-modal-{{ $admin->id }}-label">Confirm Deletion</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this {{ $admin->id }} account?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <form method="POST" action="{{ route('admins.destroy', $admin->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection