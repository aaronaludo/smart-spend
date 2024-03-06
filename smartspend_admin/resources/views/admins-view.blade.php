@extends('layouts.app')
@section('title', 'Admin View')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">View</h1></div>
            </div>
            <div class="col-lg-12">
                <div class="alert alert-success">
                    <img src="{{ route('image', ['imageName' => $admin->image == '' ? 'hey' : $admin->image]) }}" alt="User" title="User" class="round mb-5" height="150" width="150"/>
                    <h4 class="alert-heading color-kabarkadogs">Name: <span class="fw-bold ms-2">{{ $admin->first_name .' '. $admin->last_name }}</span></h4>
                    <p class="color-kabarkadogs">Email: <span class="fw-bold ms-2">{{ $admin->email }}</span></p>
                    <p class="color-kabarkadogs">Created Date: <span class="fw-bold ms-2">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $admin->created_at)->format('F d, Y h:i A') }}</span></p>
                </div>
            </div>                    
        </div>
    </div>
@endsection