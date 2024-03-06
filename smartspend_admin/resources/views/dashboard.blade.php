@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 d-flex justify-content-between">
            <div><h2 class="title">Dashboard</h2></div>
        </div>
        <div class="col-lg-12">
            <div class="row">
                <div class="col-sm-6 col-lg-6">
                    <div class="tile tile-primary">
                        <div class="tile-heading">Total Users</div>
                        <div class="tile-body">
                            <i class="fa-solid fa-users"></i>
                            <h2 class="float-end">{{ $users }}</h2>
                        </div>
                        <div class="tile-footer"><a href="{{ route('users.index') }}">View more...</a></div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-6">
                    <div class="tile tile-primary">
                        <div class="tile-heading">Total Admins</div>
                        <div class="tile-body">
                            <i class="fa-solid fa-users"></i>
                            <h2 class="float-end">{{ $admins }}</h2>
                        </div>
                        <div class="tile-footer"><a href="{{ route('admins.index') }}">View more...</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="box">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="div d-flex justify-content-between align-items-center">
                            <h5>Latest Users</h5>
                            <a href="{{ route('users.index') }}">see more</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody>
                                    @foreach ($latestUsers as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->first_name .' '. $user->last_name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('F d, Y h:i A') }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="action-button"><a href="{{ route('users.view', $user->id) }}" title="View"><i class="fa-solid fa-eye"></i></a></div>
                                                </div>
                                            </td>
                                        </tr>
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