@extends('layouts.app')
@section('title', 'Edit Learning Feature')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">Edit</h1></div>
            </div>
            <div class="col-lg-12">
                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{ route('learning-features.store-edit', $learningFeature->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <div class="mb-3 row">
                                    <label for="image" class="col-sm-12 col-lg-2 col-form-label">Image: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12 d-flex align-items-center">
                                        <input type="file" class="form-control" id="image" name="image"/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="title" class="col-sm-12 col-lg-2 col-form-label">Title: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12 d-flex align-items-center">
                                        <input type="text" class="form-control" id="title" name="title" value="{{ $learningFeature->title }}"/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="description" class="col-sm-12 col-lg-2 col-form-label">Description: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12 d-flex align-items-center">
                                        <textarea class="form-control" id="description" name="description" rows="10">{{ $learningFeature->description }}</textarea>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mt-5 mb-4">
                                    <button class="btn btn-success" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection