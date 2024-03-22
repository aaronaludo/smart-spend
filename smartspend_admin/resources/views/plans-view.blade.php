@extends('layouts.app')
@section('title', 'Plan View')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">View</h1></div>
            </div>
            <div class="col-lg-12">
                <div class="alert alert-success">
                    <img src="{{ asset('storage/' . $plan->image) }}" alt="hey" width="500" class="img-fluid mb-4"/>
                    <h4 class="alert-heading color-kabarkadogs">Title: <span class="fw-bold ms-2">{{ $plan->title }}</span></h4>
                    <p class="color-kabarkadogs">Description: <span class="fw-bold ms-2">{{ $plan->description }}</span></p>
                    <p class="color-kabarkadogs">Minimum Salary: <span class="fw-bold ms-2">{{ $plan->minimum_salary }}</span></p>
                    <p class="color-kabarkadogs">Minimum Salary: <span class="fw-bold ms-2">{{ $plan->minimum_age }}</span></p>
                    <p class="color-kabarkadogs">Cost: <span class="fw-bold ms-2">{{ $plan->cost }}</span></p>
                    <p class="color-kabarkadogs">Months: <span class="fw-bold ms-2">{{ $plan->months }}</span></p>
                </div>
            </div>                    
        </div>
    </div>
@endsection