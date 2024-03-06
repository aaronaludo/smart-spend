@extends('layouts.app')
@section('title', 'User View')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">View</h1></div>
            </div>
            <div class="col-lg-12">
                <div class="alert alert-success">
                    <img src="{{ route('image', ['imageName' => $user->image == '' ? 'hey' : $user->image]) }}" alt="User" title="User" class="round mb-5" height="150" width="150"/>
                    <h4 class="alert-heading color-kabarkadogs">Name: <span class="fw-bold ms-2">{{ $user->first_name .' '. $user->last_name }}</span></h4>
                    <p class="color-kabarkadogs">Email: <span class="fw-bold ms-2">{{ $user->email }}</span></p>
                    <p class="color-kabarkadogs">Phone: <span class="fw-bold ms-2">{{ $user->phone }}</span></p>
                    <p class="color-kabarkadogs">Address: <span class="fw-bold ms-2">{{ $user->address }}</span></p>
                    <p class="color-kabarkadogs">Date of birth: <span class="fw-bold ms-2">{{ $user->date_of_birth }}</span></p>
                    <p class="color-kabarkadogs">Age: <span class="fw-bold ms-2">{{ $user->age }}</span></p>
                    <p class="color-kabarkadogs">Work: <span class="fw-bold ms-2">{{ $user->work }}</span></p>
                </div>
            </div>                    
        </div>
    </div>
@endsection